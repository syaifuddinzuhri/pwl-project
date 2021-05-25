<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Repository;
use App\Models\Menu;
use App\Models\SubMenu;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\MenuRequest;
use App\Http\Requests\SubMenuRequest;
use Yajra\DataTables\Facades\DataTables;

class MenuController extends Controller
{
    public function __construct(Menu $menu)
    {
        $this->model = new Repository($menu);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $permission = ['' => '-- Pilih Permission --'] + Permission::where('level', 'menu')->pluck('name', 'id')->toArray();
        $permission2 = ['' => '-- Pilih Permission --'] + Permission::where('level', 'submenu')->pluck('name', 'id')->toArray();
        $pilihmenu = ['' => '-- Pilih Menu --'] + Menu::pluck('name', 'id')->toArray();
        $menu = Menu::all();
        if ($request->ajax()) {
            return DataTables::of($menu)
                ->addIndexColumn()
                ->addColumn('action', function ($menu) {
                    $button = '<div class="btn-group" role="group">';
                    $button .= '<a  href="javascript:void(0)" data-toggle="modal" data-target="#editMenuModal" data-id="' . $menu->id . '" class="btn btn-sm btn-info btn-edit-menu">Edit</a>';
                    $button .= '<a href="javascript:void(0)" data-toggle="modal" data-target="#deleteMenuModal" data-id="' . $menu->id . '" class="btn btn-sm btn-danger btn-delete-menu">Hapus</a>';
                    $button .= '</div>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('menu.index', compact('pilihmenu','menu', 'permission', 'permission2'));
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
    public function store(MenuRequest $request)
    {
        $data = $request->all();
        $this->model->create($data);
        return response()->json(['success' => true, 'data' => $data, 'messages' => 'Data berhasil ditambahkan'], 201);
    }

    public function storeSubmenu(SubMenuRequest $request)
    {
        $data = $request->all();
        Submenu::create($data);
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

    public function editSubmenu($id)
    {
        $data = Submenu::findOrFail($id);
        return response()->json(['success' => true, 'data' => $data], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MenuRequest $request, $id)
    {
        $data = $request->all();
        $this->model->update($data, $id);
        return response()->json(['success' => true, 'data' => $data, 'messages' => 'Data berhasil diupdate'], 200);
    }

    public function updateSubmenu(SubMenuRequest $request, $id)
    {
        $data = $request->all();
        $query = Submenu::find($id);
        $query->update($data);
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

    public function submenu()
    {
        $data = Submenu::all();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                $button = '<div class="btn-group" role="group">';
                $button .= '<a  href="javascript:void(0)" data-toggle="modal" data-target="#editSubmenuModal" data-id="' . $data->id . '" class="btn btn-sm btn-info btn-edit-submenu">Edit</a>';
                $button .= '<a href="javascript:void(0)" data-toggle="modal" data-target="#deleteSubmenuModal" data-id="' . $data->id . '" class="btn btn-sm btn-danger btn-delete-submenu">Hapus</a>';
                $button .= '</div>';
                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
