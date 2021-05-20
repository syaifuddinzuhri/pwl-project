<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        if ($request->ajax()) {
            $data = User::with('roles')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('role', function ($data) {
                    return '<span class="badge badge-dark mr-2 py-1 px-2">' . $data->roles->pluck('name')[0] . '</span>';
                })
                ->addColumn('action', function ($data) {
                    $button = '<div class="btn-group" role="group">';
                    $button .= '<a href="javascript:void(0)" class="btn btn-sm btn-info btn-edit-user" data-toggle="modal" data-id="' . $data->id . '" data-target="#editUserModal">Edit</a>';
                    $button .= '<a href="javascript:void(0)" data-toggle="modal" data-id="' . $data->id . '" data-target="#deleteUserModal" class="btn btn-sm btn-danger btn-delete-user">Hapus</a>';
                    $button .= '</div>';
                    return $button;
                })
                ->rawColumns(['action', 'role'])
                ->make(true);
        }
        $roles = Role::all();
        $users = User::with('roles')->get();
        return view('user.index', compact('users', 'roles'));
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
        $data = $request->only(['name', 'email', 'address', 'phone']);
        $password = Hash::make($request->password);
        $payload = array_merge($data, ['password' => $password]);
        $user = $this->model->create($payload);
        $user->assignRole($request->role);
        return response()->json(['success' => true, 'data' => $user, 'messages' => 'Data berhasil disimpan'], 201);
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
        $roles = Role::all();
        $user = User::with('roles')->findOrFail($id);
        $payload = ['roles' => $roles, ['user' => $user]];
        return response()->json(['success' => true, 'data' => $payload], 200);
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
        $data = $request->only(['name', 'email', 'address', 'phone']);
        $this->model->update($data, $id);
        $user = $this->model->show($id);
        $user->syncRoles($request->role);
        return response()->json(['success' => true, 'data' => $user, 'messages' => 'Data berhasil diupdate'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::with('roles')->findOrFail($id);
        $user->syncRoles($user->roles);
        $this->model->delete($id);
        return response()->json(['success' => true, 'messages' => 'Data berhasil dihapus'], 200);
    }
}