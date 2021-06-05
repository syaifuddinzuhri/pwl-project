@extends('layouts.main')

@section('title', 'Manajemen Mobil')

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
                        <li class="breadcrumb-item">Data Mobil</li>
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
                    @if (Session::has('success'))
                    <div class="row">
                        <div class="col-12">
                            <div class="alert bg-success">
                                {{Session::get('success')}}
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Tambah Mobil</h5>
                                </div>
                                <div class="card-body">
                                    <form class="form-material" action="{{route('car.store')}}" method="POST" enctype="multipart/form-data" id="form-add-car">
                                        @csrf
                                        <div class="form-group form-primary ">
                                            <label for="car_type_id">Merek Mobil</label>
                                            <select class="form-control" name="car_type_id" id="car_type_id" required>
                                                <option selected disabled></option>
                                                @foreach ($car_types as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                            <span class="form-bar"></span>
                                            @error('car_type_id')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group form-primary  ">
                                            <label for="merk">Nama</label>
                                            <input type="text" class="form-control" name="merk" id="merk" value="{{ old('merk')}}" required>
                                            <span class="form-bar"></span>
                                            @error('merk')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group form-primary ">
                                            <label for="no_plat">Nomor Plat</label>
                                            <input type="text" class="form-control" name="no_plat" id="no_plat" value="{{ old('no_plat')}}" required>
                                            <span class="form-bar"></span>
                                            @error('no_plat')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group form-primary ">
                                            <label for="color">Warna Mobil</label>
                                            <input type="text" class="form-control" name="color" id="color" value="{{ old('color')}}" required>
                                            <span class="form-bar"></span>
                                            @error('color')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group form-primary ">
                                            <label for="year">Tahun</label>
                                            <input type="number" class="form-control" name="year" id="year" value="{{ old('year')}}" required>
                                            <span class="form-bar"></span>
                                            @error('year')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group form-primary ">
                                            <label for="price">Harga Sewa</label>
                                            <input type="number" class="form-control" name="price" id="price" value="{{ old('price')}}" required>
                                            <span class="form-bar"></span>
                                            @error('price')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group form-primary ">
                                            <label for="fine">Harga Denda</label>
                                            <input type="number" class="form-control" name="fine" id="fine" value="{{ old('fine')}}" required>
                                            <span class="form-bar"></span>
                                            @error('fine')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group form-primary ">
                                            <label for="image">Gambar Mobil</label>
                                            <input type="file" class="form-control" name="image" id="image" accept="image/*" required>
                                            <span class="form-bar"></span>
                                            @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group" id="show-image" style="display: none">
                                            <img src="" class="img-responsive w-100" alt="">
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-submit"><i class="fas fa-save"></i>Simpan</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="card cars">
                                <div class="card-header">
                                    <h5>Data Mobil</h5>
                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li><i class="fa fa fa-wrench open-card-option"></i></li>
                                            <li><i class="fa fa-window-maximize full-card"></i></li>
                                            <li><i class="fa fa-refresh reload-table"></i></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table id="table-cars" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Gambar</th>
                                                <th>Merek Mobil</th>
                                                <th>Nama</th>
                                                <th>No. Plat</th>
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

<div class="modal fade" id="deleteCarModal" tabindex="-1" aria-labelledby="deleteCarModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteCarModalLabel">Konfirmasi Hapus Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin mau menghapus data?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-outline-secondary" data-dismiss="modal"><i class="fa fa-mail-reply"></i>Close</button>
                <form class="md-float-material form-material" id="form-delete-car" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger btn-loading" type="button" disabled>Loading...</button>
                    <button type="submit" class="btn btn-sm btn-danger btn-submit"><i class="fas fa-trash-alt"></i>Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="showCarModal" tabindex="-1" aria-labelledby="showCarModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showCarModalLabel">Detail Mobil</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-primary" id="loading"><span>Loading...</span></div>
                <div class="body-show-car"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-outline-secondary" data-dismiss="modal"><i class="fa fa-mail-reply"></i>Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="statusCarModal" tabindex="-1" aria-labelledby="statusCarModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="statusCarModalLabel">Status Mobil</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="loading">
                <div class="text-primary"><span>Loading...</span></div>
            </div>
            <div class="body-status-car"></div>
        </div>
    </div>
</div>


@endsection

@section('pageScript')
<script src="{{ asset('admin-templates') }}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('admin-templates') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('admin-templates') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('admin-templates') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{ asset('js/car.js')}}" type="module"></script>
@endsection
