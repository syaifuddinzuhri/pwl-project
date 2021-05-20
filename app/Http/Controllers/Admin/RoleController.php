<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RolePermissionRequest;
use App\Repositories\Repository;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
    public function __construct(Role $role)
    {
        $this->model = new Repository($role);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Role::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('permissions', function ($data) {
                    $badge = '';
                    foreach ($data->getAllPermissions() as $value) {
                        $badge .= '<span class="badge badge-dark mr-2 py-1 px-2">' . $value->name . '</span>';
                    }
                    return $badge;
                })
                ->addColumn('action', function ($data) {
                    $button = '<div class="btn-group" role="group">';
                    $button .= '<a href="/role/' . $data->id . '/edit" class="btn btn-sm btn-info">Edit</a>';
                    $button .= '<a href="javascript:void(0)" data-toggle="modal" data-target="#deleteRoleModal" data-id="' . $data->id . '" class="btn btn-sm btn-danger btn-delete-role">Hapus</a>';
                    $button .= '</div>';
                    return $button;
                })
                ->rawColumns(['permissions', 'action'])
                ->make(true);
        }
        $roles = Role::all();
        return view('role.index', compact('roles'));
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
    public function store(RolePermissionRequest $request)
    {
        $data = $this->model->create($request->only(['name']));
        return response()->json(['success' => true, 'data' => $data,  'messages' => 'Data berhasil ditambahkan'], 201);
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
        $role = $this->model->show($id);
        $roleHasPermissions = $role->getAllPermissions();;
        $permissions = Permission::all();
        return view('role.edit', compact('role', 'roleHasPermissions', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RolePermissionRequest $request, $id)
    {
        $this->model->update($request->only(['name']), $id);
        $role = $this->model->show($id);
        $role->syncPermissions($request->input('permissions'));
        return response()->json(['success' => true, 'data' => $role,  'messages' => 'Data berhasil diupdate'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = $this->model->show($id);
        $role->permissions()->detach();
        $this->model->delete($id);
        return response()->json(['success' => true, 'messages' => 'Data berhasil dihapus'], 200);
    }
}