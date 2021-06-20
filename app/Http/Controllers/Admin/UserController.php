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
        if ($request->ajax()) {
            $data = User::with('roles')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('gender', function ($data) {
                    return $data->gender == "lk" ? 'Laki-laki' : 'Perempuan';
                })
                ->editColumn('role', function ($data) {
                    return '<span class="badge badge-dark mr-2 py-1 px-2">' . $data->roles[0]->name . '</span>';
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
        $roles = Role::all();
        $users = User::with('roles')->get();
        // return $users;
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
    public function store(RegisterRequest $request)
    {
        $data = $request->only(['name', 'email', 'address', 'phone', 'no_ktp', 'gender']);
        $password = Hash::make($request->password);
        $payload = array_merge($data, ['password' => $password]);
        $user = $this->model->create($payload);
        $user->assignRole($request->role);
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
        $roles = Role::all();
        $user = User::with('roles')->findOrFail($id);
        return view('user.edit', compact('user', 'roles'));
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
        $data = $request->only(['name', 'email', 'address', 'phone', 'no_ktp', 'gender']);
        $this->model->update($data, $id);
        $user = $this->model->show($id);
        $user->syncRoles($request->role);
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
        $user = User::with('roles')->findOrFail($id);
        $user->syncRoles($user->roles);
        $this->model->delete($id);
        return response()->json(['success' => true, 'messages' => 'Data berhasil dihapus'], 200);
    }
}