<div class="modal-body">
    <ul class="list-group">
        @if ($data->return_date < now()) <div class="alert alert-danger text-danger">
            Durasi sewa sudah habis. Anda dikenakan denda. <br>Segera hubungi admin terkait.
</div>
@endif
<li class="list-group-item">
    <div class="row">
        <div class="col-md-5">Gambar Mobil</div>
        <div class="col-md-7 font-weight-bold">
            <img src="{{ asset('storage/car/' . $data->car->image)}}" class="img-responsive img-thumbnail w-100" alt="">
        </div>
    </div>
</li>

<li class="list-group-item">
    <div class="row">
        <div class="col-md-5">Merek Mobil</div>
        <div class="col-md-7 font-weight-bold">{{$data->car->car_type->name}}</div>
    </div>
<li class="list-group-item">
    <div class="row">
        <div class="col-md-5">Nama Mobil</div>
        <div class="col-md-7 font-weight-bold">{{$data->car->merk }}</div>
    </div>
</li>
<li class="list-group-item">
    <div class="row">
        <div class="col-md-5">Nomor Plat</div>
        <div class="col-md-7 font-weight-bold">{{$data->car->no_plat}}</div>
    </div>
</li>
<li class="list-group-item">
    <div class="row">
        <div class="col-md-5">Warna Mobil</div>
        <div class="col-md-7 font-weight-bold">{{$data->car->color}}</div>
    </div>
</li>
<li class="list-group-item">
    <div class="row">
        <div class="col-md-5">Tahun</div>
        <div class="col-md-7 font-weight-bold">{{$data->car->year}}</div>
    </div>
</li>
<li class="list-group-item">
    <div class="row">
        <div class="col-md-5">Tanggal Sewa</div>
        <div class="col-md-7 font-weight-bold">{{$data->lease_date}}</div>
    </div>
</li>
<li class="list-group-item">
    <div class="row">
        <div class="col-md-5">Tanggal Kembali</div>
        <div class="col-md-7 font-weight-bold">{{$data->return_date}}</div>
    </div>
</li>
<li class="list-group-item">
    <div class="row">
        <div class="col-md-5">Harga Sewa</div>
        <div class="col-md-7 font-weight-bold">Rp. {{ number_format($data->car->price, 0, ',', '.')}}</div>
    </div>
</li>
<li class="list-group-item list-group-item-info">
    <div class="row">
        <div class="col-md-5">Total Harga Sewa</div>
        <div class="col-md-7 font-weight-bold">Rp. {{ number_format($sewa, 0, ',', '.')}}</div>
    </div>
</li>
@if ($data->return_date < now()) <li class="list-group-item">
    <div class="row">
        <div class="col-md-5">Tanggal Pengembalian</div>
        <div class="col-md-7 font-weight-bold">{{$data->date_of_return}}</div>
    </div>
    </li>
    <li class="list-group-item">

        <div class="row">
            <div class="col-md-5">Harga Denda</div>
            <div class="col-md-7 font-weight-bold">Rp. {{ number_format($data->car->fine, 0, ',', '.')}}</div>
        </div>
    </li>
    <li class="list-group-item list-group-item-info">
        <div class="row">
            <div class="col-md-5">Total Bayar Denda</div>
            <div class="col-md-7 font-weight-bold">Rp. {{ number_format($denda, 0, ',', '.')}}</div>
        </div>
    </li>
    @endif
    </ul>
    <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-outline-secondary" data-dismiss="modal"><i class="fa fa-mail-reply"></i>Close</button>
    </div>

    </div>
