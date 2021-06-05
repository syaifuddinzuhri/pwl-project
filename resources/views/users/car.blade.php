@extends('layouts.main')

@section('title', 'Car')

@section('content')
<div class="pcoded-content">
    <!-- Page-header start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Dashboard</h5>
                        <p class="m-b-0">Selamat Datang di Premium RentCar</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html"> <i class="fa fa-home"></i> </a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">Mobil</a>
                        </li>
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
                    <div class="row" id="data-cars">
                        @if ($data->isEmpty())
                        <div class="col-12">
                            <div class="alert alert-danger">
                                Data mobil masih belum tersedia.
                            </div>
                        </div>
                        @else
                        @foreach ($data as $item)
                        <div class="col-md-4">
                            <div class="card">
                                <img src="{{ asset('storage/car/' . $item->image)}}" class="card-img-top" alt="{{$item->merk}}" style="height: 240px; object-fit: cover;">
                                <div class="card-body">
                                    <span class="badge badge-info mb-2">{{$item->car_type->name}}</span>
                                    <h5>{{$item->merk}}</h5>
                                    <h4 class="text-danger my-2 font-weight-bold"><sup>Rp</sup>{{number_format($item->price, 0, ',', '.')}}</h4>
                                    <hr>
                                    <div class="row">
                                        <div class="col d-flex justify-content-center align-items-center"><a href="javascript:void(0)" data-toggle="modal" data-id="{{$item->id}}" data-target="#showCarModal" class="text-secondary btn-show-car">Detail</a></div>
                                        @if ($item->status == 1)
                                        <div class="col"><a href="{{route('customer.transaction.new', $item->id)}}" class="btn btn-sm btn-primary d-block">Sewa</a></div>
                                        @else
                                        <div class="col"><button type="button" class="btn btn-sm btn-danger d-block" style="cursor: not-allowed" disabled>Mobil Sudah Disewa</button></div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>
                <!-- Page-body end -->
            </div>
        </div>
    </div>
</div>
@endsection

@section('pageModal')
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

@endsection

@section('pageScript')
<script src="{{ asset('js/user_car.js')}}" type="module"></script>
@endsection
