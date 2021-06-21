<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Repositories\Repository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    protected $model;

    public function __construct(User $user)
    {
        $this->model = new Repository($user);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = User::get();
        if ($request->ajax()) {
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('gender', function ($data) {
                    return $data->gender == "lk" ? 'Laki-laki' : 'Perempuan';
                })
                ->editColumn('role', function ($data) {
                    if ($data->role == "adm") {
                        return '<span class="badge badge-dark mr-2 py-1 px-2">Admin</span>';
                    } else {
                        return '<span class="badge badge-dark mr-2 py-1 px-2">Customer</span>';
                    }
                })
                ->addColumn('action', function ($data) {
                    $button = '<div class="btn-group" role="group">';
                    $button .= '<a href="/user/' . $data->id . '/edit" class="btn btn-sm btn-info">Edit</a>';
                    $button .= '<a href="javascript:void(0)" data-toggle="modal" data-id="' . $data->id . '" data-target="#deleteUserModal" class="btn btn-sm btn-danger btn-delete-user">Hapus</a>';
                    $button .= '</div>';
                    return $button;
                })
                ->rawColumns(['action', 'role', 'gender'])
                ->make(true);
        }
        return view('user.index', compact('data'));
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
    public function store(RegisterRequest $request)
    {
        $payload = $request->only(['name', 'email', 'address', 'phone', 'no_ktp', 'gender']);
        $payload['password'] = Hash::make($request->password);
        if ($request->role) {
            $payload['role'] = $request->role;
        }
        $this->model->create($payload);
        return redirect()->back();
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
        $user = User::findOrFail($id);
        return view('user.edit', compact('user'));
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
        $data = $request->only(['name', 'email', 'address', 'phone', 'no_ktp', 'gender', 'role']);
        $this->model->update($data, $id);
        return redirect()->route('user.index')->with('success', 'Data berhasil diupdate');
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