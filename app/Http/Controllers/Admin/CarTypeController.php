<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CarTypeRequest;
use App\Models\CarType;
use App\Repositories\Repository;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CarTypeController extends Controller
{

    public function __construct(CarType $car_type)
    {
        $this->model = new Repository($car_type);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = CarType::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $button = '<div class="btn-group" role="group">';
                    $button .= '<a  href="javascript:void(0)" data-toggle="modal" data-target="#editCarTypeModal" data-id="' . $data->id . '" class="btn btn-sm btn-info btn-edit-car-type">Edit</a>';
                    $button .= '<a href="javascript:void(0)" data-toggle="modal" data-target="#deleteCarTypeModal" data-id="' . $data->id . '" class="btn btn-sm btn-danger btn-delete-car-type">Hapus</a>';
                    $button .= '</div>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $car_types = CarType::all();
        return view('car-type.index', compact('car_types'));
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
    public function store(CarTypeRequest $request)
    {
        $data = $this->model->create($request->only(['name']));
        return response()->json(['success' => true, 'data' => $data, 'messages' => 'Data berhasil ditambahkan'], 201);
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
        $data = $this->model->show($id);
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
        $data = $this->model->update($request->only(['name']), $id);
        return response()->json(['success' => true, 'data' => $data, 'messages' => 'Data berhasil diupdate'], 200);
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