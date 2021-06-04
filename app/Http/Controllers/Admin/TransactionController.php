<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Repository;
use App\Models\Transaction;
use App\Http\Requests\TransactionRequest;
use Yajra\DataTables\Facades\DataTables;

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
                ->addColumn('action', function ($transaction) {
                    $button = '<div class="btn-group" role="group">';
                    $button .= '<a  href="javascript:void(0)" data-toggle="modal" data-target="#editTransactionModal" data-id="' . $transaction->id . '" class="btn btn-sm btn-info btn-edit-transaction">Edit</a>';
                    $button .= '<a href="javascript:void(0)" data-toggle="modal" data-target="#deleteTransactionModal" data-id="' . $transaction->id . '" class="btn btn-sm btn-danger btn-delete-transaction">Hapus</a>';
                    $button .= '</div>';
                    return $button;
                })
                ->rawColumns(['action'])
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
        $data = $this->model->getModel()::with(['car','user'])->where('id', $id)->first();;
        return response()->json(['success' => true, 'data' => $data], 200);
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
        $data = $request->only(['payment_status', 'date_of_return']);
        $this->model->update($data, $id);
        return redirect()->route('transaction.index')->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->model->delete($id);
        return response()->json(['success' => true, 'messages' => 'Data berhasil dihapus'], 200);
    }
}
