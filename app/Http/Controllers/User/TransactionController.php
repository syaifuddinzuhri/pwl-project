<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Transaction;
use App\Repositories\Repository;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

use function App\Helpers\dateDiffInDays;
use function App\Helpers\deleteFile;
use function App\Helpers\updateFile;
use function App\Helpers\uploadFile;


class TransactionController extends Controller
{

    protected $model;

    public function __construct(Transaction $transaction)
    {
        $this->model = new Repository($transaction);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $transaction = Transaction::with(['user', 'car'])->get();
        if ($request->ajax()) {
            return DataTables::of($transaction)
                ->addIndexColumn()
                ->addColumn('car_type', function ($transaction) {
                    $html = '<span class="badge badge-info">' . $transaction->car->car_type->name . '</span><br/>';
                    $html .= $transaction->car->merk;
                    return $html;
                })
                ->addColumn('total', function ($transaction) {
                    $days = dateDiffInDays($transaction->return_date, $transaction->lease_date);
                    return $days * $transaction->car->price;
                })
                ->addColumn('payment_status', function ($transaction) {
                    if ($transaction->payment_status == 0) {
                        return '<span class="badge badge-danger">Belum Diverifikasi</span>';
                    } else {
                        if ($transaction->return_date < now()) {
                            return '<span class="badge badge-danger">Masa Sewa Sudah Habis</span>';
                        }
                        return '<span class="badge badge-success">Sudah Diverifikasi</span>';
                    }
                })
                ->addColumn('action', function ($transaction) {
                    $button = '<div class="btn-group" role="group">';
                    $button .= '<a href="javascript:void(0)" data-toggle="modal" data-target="#detailTransactionModal" data-id="' . $transaction->id . '" class="m-1 btn btn-sm btn-success btn-detail-transaction">Detail</a>';
                    if ($transaction->proof_of_payment == null) {
                        $button .= '<a href="javascript:void(0)" data-toggle="modal" data-target="#buktiTransactionModal" data-id="' . $transaction->id . '" class="m-1 btn btn-sm btn-success btn-bukti-transaction">Upload Bukti</a>';
                    }

                    if ($transaction->payment_status == 0) {
                        $button .= '<a  href="transaction/' . $transaction->id . '/edit"  class="m-1 btn btn-sm btn-info">Edit</a>';
                    } else {
                        $button .= '<a href="transaction/cetak-nota/' . $transaction->id . '" class="m-1 btn btn-sm btn-info">Cetak Nota</a>';
                    }

                    if ($transaction->return_date < now()) {
                        $button .= '<a href="javascript:void(0)" data-toggle="modal" data-target="#deleteTransactionModal" data-id="' . $transaction->id . '" class="m-1 btn btn-sm btn-danger btn-delete-transaction">Hapus</a>';
                    }
                    $button .= '</div>';
                    return $button;
                })
                ->rawColumns(['action', 'car_type', 'total', 'payment_status'])
                ->make(true);
        }
        return view('users.transaction.index', compact('transaction'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $payload = $request->only(['car_id', 'lease_date', 'return_date']);
        $payload['user_id'] = Auth::user()->id;
        $this->model->create($payload);
        return redirect()->route('customer.transaction.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = $this->model->getModel()::where('id', $id)->first();
        $denda = dateDiffInDays(now(), $data->return_date) * $data->car->fine;
        $sewa = dateDiffInDays($data->return_date, $data->lease_date) * $data->car->price;
        return response()->json(['success' => true, 'html' => view('users.transaction.show', compact('data', 'denda', 'sewa'))->render()], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->model->getModel()::where('id', $id)->first();
        $denda = dateDiffInDays(now(), $data->return_date) * $data->car->fine;
        $sewa = dateDiffInDays($data->return_date, $data->lease_date) * $data->car->price;
        return view('users.transaction.edit', compact('data', 'sewa', 'denda'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $payload = $request->only(['lease_date', 'return_date']);
        $this->model->update($payload, $id);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = $this->model->show($id);
        if ($data->proof_of_payment) {
            deleteFile($data->proof_of_payment, 'payment');
        }
        $this->model->delete($id);
        return response()->json(['success' => true, 'messages' => 'Data berhasil dihapus'], 200);
    }

    public function transaction($id)
    {
        $data = Car::with('car_type')->where('id', $id)->first();
        if ($data->status == 0) {
            return redirect()->route('customer.car.index');
        }
        return view('users.transaction.create', compact('data'));
    }

    public function showUploadBukti($id)
    {
        $data = $this->model->getModel()->where('id', $id)->select('proof_of_payment', 'id')->first();
        if ($data->proof_of_payment != null) {
            return redirect()->back();
        }
        return response()->json(['success' => true, 'html' => view('users.transaction.bukti', compact('data'))->render()], 200);
    }

    public function uploadBukti(Request $request, $id)
    {
        $data = $this->model->getModel()->where('id', $id)->select('proof_of_payment', 'id')->first();
        $payload = [];
        if ($data->proof_of_payment != null) {
            return 'ada';
            if ($request->hasFile('proof_of_payment')) {
                $payload['proof_of_payment'] = updateFile($data->proof_of_payment, 'payment', $request->file('proof_of_payment'), 'payment');
            } else {
                $payload['proof_of_payment'] = $data->proof_of_payment;
            }
        } else {
            if ($request->hasFile('proof_of_payment')) {
                $payload['proof_of_payment'] = uploadFile($request->file('proof_of_payment'), 'payment');
            }
        }
        $this->model->update($payload, $id);
        return redirect()->route('customer.transaction.index')->with('success', 'Upload bukti pembayaran berhasil');
    }

    public function cetakNota($id)
    {
        $data = $this->model->getModel()::with('car', 'user')->where('id', $id)->first();
        $denda = dateDiffInDays(now(), $data->return_date) * $data->car->fine;
        $sewa = dateDiffInDays($data->return_date, $data->lease_date) * $data->car->price;
        $pdf = PDF::loadview('users.transaction.cetak', ['data' => $data, 'denda' => $denda, 'sewa' => $sewa]);
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream();
    }
}