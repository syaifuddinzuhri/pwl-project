@extends('layouts.main')

@section('title', 'Data Tipe Mobil ')

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
                        <h5 class="m-b-10">Manajamen Mobil</h5>
                        <p class="m-b-0">Selamat Datang di Premium RentCar</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html"> <i class="fa fa-home"></i> </a>
                        </li>
                        <li class="breadcrumb-item">Manajemen Mobil</li>
                        <li class="breadcrumb-item">Data Tipe Mobil</li>
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
                        <div class="col-md-4  mb-3">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Tambah Tipe Mobil</h5>
                                </div>
                                <div class="card-body">
                                    <form class="md-float-material form-material" id="form-add-car-type">
                                        <div class="form-group row">
                                            <label class="col-12 col-form-label">Nama</label>
                                            <div class="col-8">
                                                <input type="text" class="form-control" name="name" id="name" placeholder="Masukkan nama" value="{{ old('name')}}">
                                                @error('name')
                                                <span class="text-danger mt-1">{{ $message }}</span>
                                                @enderror
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
                        <div class="col-md-8">
                            <div class="card car-types">
                                <div class="card-header">
                                    <h5>Data Tipe Mobil</h5>
                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li><i class="fa fa fa-wrench open-card-option"></i></li>
                                            <li><i class="fa fa-window-maximize full-card"></i></li>
                                            <li><i class="fa fa-refresh reload-table"></i></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table id="table-car-types" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nama</th>
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
<div class="modal fade" id="editCarTypeModal" tabindex="-1" aria-labelledby="editCarTypeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCarTypeModalLabel">Edit Tipe Mobil</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="md-float-material form-material" id="form-edit-car-type">
                <div class="modal-body">
                    <div class="text-primary" id="loading"><span>Loading...</span></div>
                    <div class="form-group row" id="body-edit-car-type">
                        <label class="col-12 col-form-label">Nama</label>
                        <div class="col-12">
                            <input type="text" class="form-control" id="name-edit" placeholder="Masukkan nama">
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

<div class="modal fade" id="deleteCarTypeModal" tabindex="-1" aria-labelledby="deleteCarTypeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteCarTypeModalLabel">Konfirmasi Hapus Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin mau menghapus data?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal"><i class="fa fa-mail-reply"></i>Close</button>
                <form class="md-float-material form-material" id="form-delete-car-type" method="POST">
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
<script src="{{ asset('js/car_type.js')}}" type="module"></script>
@endsection
