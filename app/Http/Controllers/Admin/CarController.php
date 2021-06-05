<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CarRequest;
use App\Models\Car;
use App\Models\CarType;
use App\Repositories\Repository;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

use function App\Helpers\deleteFile;
use function App\Helpers\updateFile;
use function App\Helpers\uploadFile;

class CarController extends Controller
{

    protected $model;

    public function __construct(Car $car)
    {
        $this->model = new Repository($car);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Car::with('car_type')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('status', function ($data) {
                    return $data->status == 1 ? '<a href="javascript:void(0)" data-toggle="modal" data-id="' . $data->id . '" data-target="#statusCarModal" class="badge badge-success btn-status-car">Tersedia</a>' : '<a href="javascript:void(0)" data-toggle="modal" data-id="' . $data->id . '" data-target="#statusCarModal" class="badge badge-danger btn-status-car">Tidak Tersedia</a>';
                })
                ->editColumn('car_type', function ($data) {
                    return $data->car_type->name;
                })
                ->addColumn('action', function ($data) {
                    $button = '<div class="btn-group" role="group">';
                    $button .= '<a href="/car/' . $data->id . '/edit" class="btn btn-sm btn-info">Edit</a>';
                    $button .= '<a href="javascript:void(0)" data-toggle="modal" data-id="' . $data->id . '" data-target="#showCarModal" class="btn btn-sm btn-success btn-show-car">Detail</a>';
                    $button .= '<a href="javascript:void(0)" data-toggle="modal" data-id="' . $data->id . '" data-target="#deleteCarModal" class="btn btn-sm btn-danger btn-delete-car">Hapus</a>';
                    $button .= '</div>';
                    return $button;
                })
                ->rawColumns(['action', 'status', 'car_type'])
                ->make(true);
        }
        $cars = Car::with('car_type')->get();
        $car_types = CarType::get();
        return view('car.index', compact('cars', 'car_types'));
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
    public function store(CarRequest $request)
    {
        $payload = $request->only(['car_type_id', 'merk', 'color', 'no_plat', 'year', 'price', 'fine']);
        if ($request->hasFile('image')) {
            $payload['image'] = uploadFile($request->file('image'), 'car');
        }
        $this->model->create($payload);
        return redirect()->route('car.index')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Car::with('car_type')->findOrFail($id);
        return response()->json(['success' => true, 'html' => view('car.show', compact('data'))->render()], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $car = Car::with('car_type')->findOrFail($id);
        $car_types = CarType::get();
        return view('car.edit', compact('car', 'car_types'));
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
        $car = $this->model->show($id);
        $payload = $request->only(['car_type_id', 'merk', 'color', 'no_plat', 'year', 'price', 'fine']);
        if ($request->hasFile('image')) {
            $payload['image'] = updateFile($car->image, 'car', $request->file('image'), 'car');
        } else {
            $payload['image'] = $car->image;
        }
        $this->model->update($payload, $id);
        return redirect()->route('car.index')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $car = $this->model->show($id);
        if ($car->image) {
            deleteFile($car->image, 'car');
        }
        $this->model->delete($id);
        return response()->json(['success' => true, 'messages' => 'Data berhasil dihapus'], 200);
    }

    public function getStatus($id)
    {
        $data = $this->model->getModel()->where('id', $id)->select('status', 'id')->first();
        return response()->json(['success' => true, 'html' => view('car.status', compact('data'))->render()], 200);
    }

    public function updateStatus(Request $request, $id)
    {
        $payload = $request->only(['status']);
        $this->model->update($payload, $id);
        return redirect()->route('car.index');
    }
}