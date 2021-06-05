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
