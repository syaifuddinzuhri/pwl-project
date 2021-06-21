@extends('layouts.main')

@section('title', 'Manajemen Transaksi')


@section('content')
<div class="pcoded-content">
    <!-- Page-header start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Manajamen Transaksi</h5>
                        <p class="m-b-0">Selamat Datang di Premium RentCar</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html"> <i class="fa fa-home"></i> </a>
                        </li>
                        <li class="breadcrumb-item">Manajemen Transaksi</li>
                        <li class="breadcrumb-item">Data Transaksi</li>
                        <li class="breadcrumb-item">Edit Transaksi</li>
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
                                    <h5>Edit Transaksi</h5>
                                </div>
                                <div class="card-body">
                                    <form class="form-material" action="{{route('transaction.update', $data->id)}}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group form-primary  ">
                                            <label for="name">Nama Customer</label>
                                            <input type="text" class="form-control" value=" {{ $data->user->name }}" required disabled>
                                            <span class="form-bar"></span>
                                        </div>
                                        <div class="form-group form-primary  ">
                                            <label for="car_type">Merek Mobil</label>
                                            <input type="text" class="form-control" name="car_type" id="car_type" value="{{ $data->car->car_type->name }}" required disabled>
                                            <span class="form-bar"></span>
                                        </div>
                                        <div class="form-group form-primary  ">
                                            <label for="name">Nama Mobil</label>
                                            <input type="text" class="form-control" value=" {{ $data->car->merk }}" required disabled>
                                            <span class="form-bar"></span>
                                        </div>
                                        <div class="form-group form-primary  ">
                                            <label for="lease_date">Tanggal Sewa</label>
                                            <input type="date" class="form-control" name="lease_date" id="lease_date" value="{{ $data->lease_date }}" required>
                                            <span class="form-bar"></span>
                                        </div>
                                        <div class="form-group form-primary  ">
                                            <label for="return_date">Tanggal Kembali</label>
                                            <input type="date" class="form-control" name="return_date" id="return_date" value="{{ $data->return_date }}" required>
                                            <span class="form-bar"></span>
                                        </div>
                                        <div class="form-group form-primary ">
                                            <label>Bukti Pembayaran</label>
                                            @if ($data->proof_of_payment)
                                            <div class="form-group" id="show-image">
                                                <img src="{{asset('storage/payment/' . $data->proof_of_payment)}}" class="img-responsive img-thumbnail w-50" alt="">
                                            </div>
                                            @endif
                                        </div>
                                        <div class="form-group form-primary ">
                                            <label for="payment_status">Status</label>
                                            <select class="form-control" name="payment_status" id="payment_status" required>
                                                <option selected disabled></option>
                                                <option value="0" {{$data->payment_status == 0 ? 'selected' : ''}}>Belum Verifikasi</option>
                                                <option value="1" {{$data->payment_status == 1 ? 'selected' : ''}}>Sudah Verifikasi</option>
                                            </select>
                                            <span class="form-bar"></span>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-submit"><i class="fas fa-save"></i>Simpan</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Edit Pengembalian</h5>
                                </div>
                                <div class="card-body">
                                    <form class="form-material" action="{{route('updatePengembalian', $data->id)}}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group form-primary  ">
                                            <label for="lease_date">Tanggal Sewa</label>
                                            <input type="date" class="form-control" name="lease_date" id="lease_date" value="{{ $data->lease_date }}" required disabled>
                                            <span class="form-bar"></span>
                                        </div>
                                        <div class="form-group form-primary  ">
                                            <label for="return_date">Tanggal Kembali</label>
                                            <input type="date" class="form-control" name="return_date" id="return_date" value="{{ $data->return_date }}" required disabled>
                                            <span class="form-bar"></span>
                                        </div>
                                        <div class="form-group form-primary  ">
                                            <label for="fine">Harga Denda/hari</label>
                                            <input type="text" class="form-control" name="fine" id="fine" value="{{ $data->car->fine }}" required disabled>
                                            <span class="form-bar"></span>
                                        </div>
                                        <div class="form-group form-primary  ">
                                            <label for="date_of_return">Tanggal Pengembalian</label>
                                            <input type="date" class="form-control" name="date_of_return" id="date_of_return" value="{{ $data->date_of_return }}" required>
                                            <span class="form-bar"></span>
                                        </div>
                                        <div class="alert alert-dark text-center">
                                            <h6 class="m-0 font-weight-bold">TOTAL DENDA: Rp. <span id="show-total">{{$denda}}</span></h6>
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
<script>
    var day = '';
    var cinValue = $('#return_date').val();
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

    $('#date_of_return').on('change', function() {
        cout(this.value)
        day = getDays(cinValue, coutValue)
        $('#show-total').html(setPrice(day, $('#fine').val()))
    });

</script>
@endsection
