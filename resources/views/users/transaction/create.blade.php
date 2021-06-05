@extends('layouts.main')

@section('title', 'Sewa Mobil')

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
                        <li class="breadcrumb-item"><a href="#!">Dashboard</a>
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
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Data Mobil</h5>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-md-4">Merek Mobil</div>
                                                <div class="col-md-8 font-weight-bold">{{$data->car_type->name}}</div>
                                            </div>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-md-4">Nama Mobil</div>
                                                <div class="col-md-8 font-weight-bold">{{$data->merk }}</div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-md-4">Nomor Plat</div>
                                                <div class="col-md-8 font-weight-bold">{{$data->no_plat}}</div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-md-4">Warna Mobil</div>
                                                <div class="col-md-8 font-weight-bold">{{$data->color}}</div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-md-4">Tahun</div>
                                                <div class="col-md-8 font-weight-bold">{{$data->year}}</div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-md-4">Harga Sewa</div>
                                                <div class="col-md-8 font-weight-bold">Rp. {{ number_format($data->price, 0, ',', '.')}}</div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-md-4">Harga Denda</div>
                                                <div class="col-md-8 font-weight-bold">Rp. {{ number_format($data->fine, 0, ',', '.')}}</div>

                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-md-4">Gambar Mobil</div>
                                                <div class="col-md-8 font-weight-bold">
                                                    <img src="{{ asset('storage/car/' . $data->image)}}" class="img-responsive img-thumbnail w-100" alt="">
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Form Sewa Mobil</h5>
                                </div>
                                <div class="card-body">
                                    <form action="{{route('customer.transaction.store')}}" class="form-material" method="POST">
                                        @csrf
                                        <input type="hidden" name="car_id" value="{{$data->id}}">
                                        <input type="hidden" id="price_car" value="{{$data->price}}">
                                        <div class="form-group form-primary  ">
                                            <label for="lease_date">Tanggal Sewa</label>
                                            <input type="date" class="form-control" name="lease_date" id="lease_date" required>
                                            <span class="form-bar"></span>
                                        </div>
                                        <div class="form-group form-primary  ">
                                            <label for="return_date">Tanggal Kembali</label>
                                            <input type="date" class="form-control" name="return_date" id="return_date" required>
                                            <span class="form-bar"></span>
                                        </div>
                                        <div class="alert alert-dark text-center">
                                            <h5 class="m-0 font-weight-bold">TOTAL : Rp. <span id="show-total">0</span></h5>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
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
<script>
    var day = '';
    var cinValue = '';
    var coutValue = '';

    function parseDate(str) {
        var mdy = str.split('-');
        return new Date(mdy[0], mdy[1] - 1, mdy[2]);
    }

    function datediff(first, second) {
        return Math.round((second - first) / (1000 * 60 * 60 * 24));
    }

    function setPrice(days, price) {
        return days * price;
    }

    function cout(cout2) {
        return coutValue = cout2;
    }

    function cin(cin2) {
        return cinValue = cin2;
    }

    function getDays(cin, cout) {
        return datediff(parseDate(cin), parseDate(cout));
    }

    $('#lease_date').on('change', function() {
        cin(this.value)
        day = getDays(cinValue, coutValue)
        $('#show-total').html(setPrice(day, $('#price_car').val()))
    });
    $('#return_date').on('change', function() {
        cout(this.value)
        day = getDays(cinValue, coutValue)
        $('#show-total').html(setPrice(day, $('#price_car').val()))
    });

</script>
@endsection
