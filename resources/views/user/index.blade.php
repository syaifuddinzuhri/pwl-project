@extends('layouts.main')

@section('title', 'Manajemen User')

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
                        <li class="breadcrumb-item">Data User</li>
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
                        <div class="col-12 mb-3">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addUserModal" id="btn-add-user-modal">
                                <i class="fas fa-plus"></i> Tambah User Baru
                            </button>
                        </div>
                        <div class="col-12">
                            <div class="card users">
                                <div class="card-header">
                                    <h5>Data Users</h5>
                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li><i class="fa fa fa-wrench open-card-option"></i></li>
                                            <li><i class="fa fa-window-maximize full-card"></i></li>
                                            <li><i class="fa fa-refresh reload-table"></i></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table id="table-users" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nama</th>
                                                <th>Email</th>
                                                <th>Nomor HP</th>
                                                <th>Alamat</th>
                                                <th>Role</th>
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
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Tambah User Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-material" id="form-add-user">
                <div class="modal-body">
                    <div class="form-group form-primary ">
                        <input type="text" class="form-control" name="name" id="name" value="{{ old('name')}}">
                        <span class="form-bar"></span>
                        <label class="float-label" for="name">Nama Lengkap</label>
                    </div>
                    <div class="form-group form-primary ">
                        <input type="email" class="form-control" name="email" id="email" value="{{ old('email')}}">
                        <span class="form-bar"></span>
                        <label class="float-label" for="email">Email</label>
                    </div>
                    <div class="form-group form-primary ">
                        <input type="number" class="form-control" name="phone" id="phone" value="{{ old('phone')}}">
                        <span class="form-bar"></span>
                        <label class="float-label" for="phone">Nomor HP</label>
                    </div>
                    <div class="form-group form-primary ">
                        <textarea class="form-control" name="address" rows="3" id="address"></textarea>
                        <span class="form-bar"></span>
                        <label class="float-label" for="address">Alamat</label>
                    </div>
                    <div class="form-group form-primary ">
                        <input type="password" class="form-control" id="password" name="password">
                        <span class="form-bar"></span>
                        <label class="float-label" for="password">Password</label>
                    </div>
                    <div class="form-group form-primary ">
                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
                        <span class="form-bar"></span>
                        <label class="float-label" for="password_confirmation">Konfirmasi Password</label>
                    </div>
                    <div class="form-group form-primary ">
                        <select class="form-control" name="role" id="role">
                            <option selected disabled></option>
                            @foreach ($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name}}</option>
                            @endforeach
                        </select>
                        <span class="form-bar"></span>
                        <label class="float-label" for="role">Role</label>
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

<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-material" id="form-edit-user">
                <div class="modal-body">
                    <div class="text-primary" id="loading"><span>Loading...</span></div>
                    <div id="body-edit-user">
                        <div class="form-group form-default form-static-label ">
                            <input type="text" class="form-control" name="name_edit" id="name_edit" value="Hello">
                            <span class="form-bar"></span>
                            <label class="float-label" for="name">Nama Lengkap</label>
                        </div>
                        <div class="form-group form-default form-static-label ">
                            <input type="email" class="form-control" name="email_edit" id="email_edit">
                            <span class="form-bar"></span>
                            <label class="float-label" for="email">Email</label>
                        </div>
                        <div class="form-group form-default form-static-label ">
                            <input type="number" class="form-control" name="phone_edit" id="phone_edit">
                            <span class="form-bar"></span>
                            <label class="float-label" for="phone">Nomor HP</label>
                        </div>
                        <div class="form-group form-default form-static-label ">
                            <textarea class="form-control" name="address_edit" rows="3" id="address_edit"></textarea>
                            <span class="form-bar"></span>
                            <label class="float-label" for="address">Alamat</label>
                        </div>
                        <div class="form-group form-default form-static-label ">
                            <select class="form-control" name="role_edit" id="role_edit">
                            </select>
                            <span class="form-bar"></span>
                            <label class="float-label" for="role">Role</label>
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

<div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteUserModalLabel">Konfirmasi Hapus Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin mau menghapus data?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal"><i class="fa fa-mail-reply"></i>Close</button>
                <form class="md-float-material form-material" id="form-delete-user" method="POST">
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
<script src="{{ asset('js/user.js')}}" type="module"></script>
@endsection
