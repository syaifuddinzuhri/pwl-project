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
                    @if (Session::has('error'))
                    <div class="row">
                        <div class="col-12">
                            <div class="alert bg-danger">
                                {{Session::get('error')}}
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Edit Mobil</h5>
                                </div>
                                <div class="card-body">
                                    <form class="form-material" action="{{route('car.update', $car->id)}}" method="POST" enctype="multipart/form-data" id="form-edit-car">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group form-primary ">
                                            <label for="car_type_id">Merek Mobil</label>
                                            <select class="form-control" name="car_type_id" id="car_type_id" required>
                                                <option selected disabled></option>
                                                @foreach ($car_types as $item)
                                                <option value="{{$item->id}}" {{ $car->car_type->id == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                            <span class="form-bar"></span>
                                            @error('car_type_id')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group form-primary  ">
                                            <label for="merk">Nama</label>
                                            <input type="text" class="form-control" name="merk" id="merk" value="{{ $car->merk }}" required>
                                            <span class="form-bar"></span>
                                            @error('merk')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group form-primary ">
                                            <label for="no_plat">Nomor Plat</label>
                                            <input type="text" class="form-control" name="no_plat" id="no_plat" value="{{$car->no_plat}}" required>
                                            <span class="form-bar"></span>
                                            @error('no_plat')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group form-primary ">
                                            <label for="color">Warna Mobil</label>
                                            <input type="text" class="form-control" name="color" id="color" value="{{ $car->color}}" required>
                                            <span class="form-bar"></span>
                                            @error('color')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group form-primary ">
                                            <label for="year">Tahun</label>
                                            <input type="number" class="form-control" name="year" id="year" value="{{ $car->year }}" required>
                                            <span class="form-bar"></span>
                                            @error('year')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group form-primary ">
                                            <label for="price">Harga Sewa</label>
                                            <input type="number" class="form-control" name="price" id="price" value="{{ $car->price }}" required>
                                            <span class="form-bar"></span>
                                            @error('price')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group form-primary ">
                                            <label for="fine">Harga Denda</label>
                                            <input type="number" class="form-control" name="fine" id="fine" value="{{ $car->fine }}" required>
                                            <span class="form-bar"></span>
                                            @error('fine')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group form-primary ">
                                            <label for="image">Gambar Mobil</label>
                                            <input type="file" class="form-control" name="image" id="image" accept="image/*">
                                            <span class="form-bar"></span>
                                            @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group" id="show-image">
                                            <img src="{{asset('storage/car/' . $car->image)}}" class="img-responsive w-50" alt="">
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-submit"><i class="fas fa-save"></i>Simpan</button>
                                    </form>
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

@section('pageScript')
<script src="{{ asset('js/car.js')}}" type="module"></script>
@endsection
