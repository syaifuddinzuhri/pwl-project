<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Repository;
use App\Models\Transaction;
use App\Http\Requests\TransactionRequest;
use App\Models\Car;
use Yajra\DataTables\Facades\DataTables;

use function App\Helpers\dateDiffInDays;
use function App\Helpers\deleteFile;

class TransactionController extends Controller
{
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
                ->editColumn('date_of_return', function ($transaction) {
                    if ($transaction->date_of_return == null) {
                        return '<span class="badge badge-danger">Belum Update</span>';
                    } else {
                        return $transaction->date_of_return;
                    }
                })
                ->editColumn('payment_status', function ($transaction) {
                    if ($transaction->payment_status == 0) {
                        return '<span class="badge badge-danger">Belum Verifikasi</span>';
                    } else {
                        return '<span class="badge badge-success">Sudah Verifikasi</span>';
                    }
                })
                ->addColumn('action', function ($transaction) {
                    $button = '<div class="btn-group" role="group">';
                    $button .= '<a  href="/transaction/' . $transaction->id . '/edit" class="btn btn-sm btn-info">Edit</a>';
                    $button .= '<a href="javascript:void(0)" data-toggle="modal" data-target="#deleteTransactionModal" data-id="' . $transaction->id . '" class="btn btn-sm btn-danger btn-delete-transaction">Hapus</a>';
                    $button .= '</div>';
                    return $button;
                })
                ->rawColumns(['action', 'date_of_return', 'payment_status'])
                ->make(true);
        }
        return view('transaction.index', compact('transaction'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->model->getModel()::with(['car', 'user'])->where('id', $id)->first();
        $denda = is_null($data->date_of_return) ? 0 : dateDiffInDays($data->date_of_return, $data->return_date) * $data->car->fine;
        return view('transaction.edit', compact('data', 'denda'));
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
        $data = $request->only(['payment_status', 'return_date', 'lease_date']);
        $transaction = Transaction::findOrFail($id);
        $this->model->update($data, $id);
        if ($request->payment_status == 1) {
            Car::findOrFail($transaction->car_id)->update([
                'status' => 0
            ]);
        }
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

    public function updatePengembalian(Request $request, $id)
    {
        Transaction::findOrFail($id)->update([
            'date_of_return' => $request->date_of_return
        ]);
        return redirect()->back();
    }
}