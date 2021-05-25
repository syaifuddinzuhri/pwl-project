@extends('layouts.main')

@section('title', 'Data Menu')

@section('pageCSS')
<link rel="stylesheet" href="{{ asset('admin-templates') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{ asset('admin-templates') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
@endsection

@section('content')
<div class="pcoded-content">
    <!-- Page-header start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Manajamen User</h5>
                        <p class="m-b-0">Selamat Datang di Premium RentCar</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html"> <i class="fa fa-home"></i> </a>
                        </li>
                        <li class="breadcrumb-item">Manajemen User</li>
                        <li class="breadcrumb-item">Data Menu & Submenu</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Page-header end -->
    <div class="pcoded-inner-content">
        <!-- Main-body start -->
        <div class="main-body">
            <div class="page-wrapper">
                <!-- Page-body start -->
                <div class="page-body">
                    <div class="row">
                        <div class="col-md-6 mb-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Tambah Menu</h5>
                                </div>
                                <div class="card-body">
                                    <form class="form-material" id="form-add-menu">
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="form-group form-primary ">
                                                    <input type="text" class="form-control" name="name" id="name" value="{{ old('name')}}">
                                                    <span class="form-bar"></span>
                                                    <label class="float-label" for="name">Nama Menu</label>
                                                </div>
                                                <div class="form-group form-primary ">
                                                    <input type="text" class="form-control" name="icon" id="icon" value="{{ old('icon')}}">
                                                    <span class="form-bar"></span>
                                                    <label class="float-label" for="icon">Icon</label>
                                                </div>
                                                {{ Form::select('permission_id', $permission, null, ['class' => 'form-control', 'style' => 'width:100%;', 'id' => 'permission_id_menu']) }}
                                                <span class="form-bar"></span>
                                            </div>
                                            <div class="col-4">
                                                <button class="btn btn-primary btn-loading" type="button" disabled>Loading...</button>
                                                <button type="submit" class="btn btn-primary btn-submit"><i class="fas fa-save"></i>Simpan</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Tambah Submenu</h5>
                                </div>
                                <div class="card-body">
                                    <form class="form-material" id="form-add-submenu">
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="form-group form-primary ">
                                                    <input type="text" class="form-control" name="name" id="name_submenu" value="{{ old('name')}}">
                                                    <span class="form-bar"></span>
                                                    <label class="float-label" for="name">Nama Submenu</label>
                                                </div>
                                                <div class="form-group form-primary ">
                                                    <input type="text" class="form-control" name="url" id="url" value="{{ old('url')}}">
                                                    <span class="form-bar"></span>
                                                    <label class="float-label" for="url">Url Submenu</label>
                                                </div>
                                                <div class="form-group form-primary ">
                                                    {{ Form::select('menu_id', $pilihmenu, null, ['class' => 'form-control', 'style' => 'width:100%;', 'id' => 'menu_id']) }}
                                                    <span class="form-bar"></span>
                                                </div>
                                                {{ Form::select('permission_id', $permission2, null, ['class' => 'form-control', 'style' => 'width:100%;', 'id' => 'permission_id_submenu']) }}
                                                <span class="form-bar"></span>
                                            </div>
                                            <div class="col-4">
                                                <button class="btn btn-primary btn-loading" type="button" disabled>Loading...</button>
                                                <button type="submit" class="btn btn-primary btn-submit"><i class="fas fa-save"></i>Simpan</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 menus">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Data Menu</h5>
                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li><i class="fa fa fa-wrench open-card-option"></i></li>
                                            <li><i class="fa fa-window-maximize full-card"></i></li>
                                            <li><i class="fa fa-refresh reload-table"></i></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table id="table-menus" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nama</th>
                                                <th>icon</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 submenus">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Data Submenu</h5>
                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li><i class="fa fa fa-wrench open-card-option"></i></li>
                                            <li><i class="fa fa-window-maximize full-card"></i></li>
                                            <li><i class="fa fa-refresh reload-table"></i></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table id="table-submenus" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nama</th>
                                                <th>URL</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Page-body end -->
            </div>
        </div>
    </div>
</div>

@endsection

@section('pageModal')
<div class="modal fade" id="editMenuModal" tabindex="-1" aria-labelledby="editMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editMenuModalLabel">Edit Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="md-float-material form-material" id="form-edit-menu">
                <div class="modal-body">
                    <div class="text-primary" id="loading"><span>Loading...</span></div>
                    <div class="form-group row" id="body-edit-menu">
                        <label class="col-12 col-form-label">Nama Menu</label>
                        <div class="col-12">
                            <input type="text" class="form-control" id="name-menu-edit" placeholder="Masukkan nama menu">
                        </div>
                        <label class="col-12 col-form-label">Icon Menu</label>
                        <div class="col-12">
                            <input type="text" class="form-control" id="icon-edit" placeholder="Masukkan icon menu">
                        </div>
                        <label class="col-12 col-form-label">Permission Menu</label>
                        <div class="col-12">
                            {{ Form::select('permission_id', $permission, null, ['class' => 'form-control', 'style' => 'width:100%;', 'id' => 'permission_id_menu-edit']) }}
                        </div>
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal"><i class="fa fa-mail-reply"></i>Close</button>
                    <button class="btn btn-primary btn-loading" type="button" disabled>Loading...</button>
                    <button type="submit" class="btn btn-primary btn-submit"><i class="fas fa-save"></i>Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editSubmenuModal" tabindex="-1" aria-labelledby="editSubmenuModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editSubmenuModalLabel">Edit Submenu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="md-float-material form-material" id="form-edit-submenu">
                <div class="modal-body">
                    <div class="text-primary" id="loading-submenu"><span>Loading...</span></div>
                    <div class="form-group row" id="body-edit-submenu">
                        <label class="col-12 col-form-label">Nama Submenu</label>
                        <div class="col-12">
                            <input type="text" class="form-control" id="name-submenu-edit" placeholder="Masukkan nama submenu">
                        </div>
                        <label class="col-12 col-form-label">Url Menu</label>
                        <div class="col-12">
                            <input type="text" class="form-control" id="url-edit" placeholder="Masukkan url submenu">
                        </div>
                        <label class="col-12 col-form-label">Menu</label>
                        <div class="col-12">
                            {{ Form::select('menu_id', $pilihmenu, null, ['class' => 'form-control', 'style' => 'width:100%;', 'id' => 'menu_id-edit']) }}
                        </div>
                        <label class="col-12 col-form-label">Permission Submenu</label>
                        <div class="col-12">
                            {{ Form::select('permission_id', $permission2, null, ['class' => 'form-control', 'style' => 'width:100%;', 'id' => 'permission_id_submenu-edit']) }}
                        </div>
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal"><i class="fa fa-mail-reply"></i>Close</button>
                    <button class="btn btn-primary btn-loading" type="button" disabled>Loading...</button>
                    <button type="submit" class="btn btn-primary btn-submit"><i class="fas fa-save"></i>Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteMenuModal" tabindex="-1" aria-labelledby="deleteMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteMenuModalLabel">Konfirmasi Hapus Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin mau menghapus data?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal"><i class="fa fa-mail-reply"></i>Close</button>
                <form class="md-float-material form-material" id="form-delete-menu" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-loading" type="button" disabled>Loading...</button>
                    <button type="submit" class="btn btn-danger btn-submit"><i class="fas fa-trash-alt"></i>Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('pageScript')
<script src="{{ asset('admin-templates') }}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('admin-templates') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('admin-templates') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('admin-templates') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{ asset('admin-templates') }}/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="{{ asset('admin-templates') }}/plugins/jquery-validation/additional-methods.min.js"></script>
<script src="{{ asset('js/menu.js')}}" type="module"></script>
@endsection
