@extends('layouts.main')

@section('title', 'Transaksi')

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
                        <h5 class="m-b-10">Manajemen Transaksi</h5>
                        <p class="m-b-0">Selamat Datang di Premium RentCar</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html"> <i class="fa fa-home"></i> </a>
                        </li>
                        <li class="breadcrumb-item">Transaksi</li>
                        <li class="breadcrumb-item">Penyewaan</li>
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
                    <div class="col-md-12">
                        <div class="card cars">
                            <div class="card-header">
                                <h5>Data Transaksi</h5>
                                <div class="card-header-right">
                                    <ul class="list-unstyled card-option">
                                        <li><i class="fa fa fa-wrench open-card-option"></i></li>
                                        <li><i class="fa fa-window-maximize full-card"></i></li>
                                        <li><i class="fa fa-refresh reload-table"></i></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="table-transaction" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Penyewa</th>
                                            <th>Merk Mobil</th>
                                            <th>No. Plat</th>
                                            <th>Tanggal Sewa</th>
                                            <th>Tanggal Kembali</th>
                                            <th>Tanggal Pengembalian</th>
                                            <th>Bukti Pembayaran</th>
                                            <th>Status</th>
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

<div class="modal fade" id="deleteTransactionModal" tabindex="-1" aria-labelledby="deleteTransactionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteTransactionModalLabel">Konfirmasi Hapus Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin mau menghapus data?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-outline-secondary" data-dismiss="modal"><i class="fa fa-mail-reply"></i>Close</button>
                <form class="md-float-material form-material" id="form-delete-transaction" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger btn-loading" type="button" disabled>Loading...</button>
                    <button type="submit" class="btn btn-sm btn-danger btn-submit"><i class="fas fa-trash-alt"></i>Hapus</button>
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
<script src="{{ asset('js/transaction.js')}}" type="module"></script>
@endsection
