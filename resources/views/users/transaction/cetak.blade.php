<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Bukti Sewa Mobil</title>
    <style>
        .container {
            text-align: center;
        }

        body {
            overflow-x: hidden;
            padding: 0 200px;
        }

        table {
            color: #232323;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            /* border: 1px solid #999; */
            text-align: left;
            padding: 8px 20px;
        }

        #table2,
        #table2 th,
        #table2 td {
            border: 1px solid #999;
        }

    </style>
</head>
<body>
    {{-- <div class="container">
        <h2>Bukti Sewa Mobil</h2>
        <h1>Premium RentCar</h1>
        <table>
            <tr>
                <td>No. KTP</td>
                <td>:</td>
                <th>{{$data->user->no_ktp}}</th>
    </tr>
    <tr>
        <td>Nama</td>
        <td>:</td>
        <th>{{$data->user->name}}</th>
    </tr>
    <tr>
        <td>Jenis Kelamin</td>
        <td>:</td>
        <th>{{ $data->user->gender == 'lk' ? 'Laki-laki' : 'Perempuan'}}</th>
    </tr>
    <tr>
        <td>Email</td>
        <td>:</td>
        <th>{{$data->user->email}}</th>
    </tr>
    <tr>
        <td>Alamat</td>
        <td>:</td>
        <th>{{$data->user->address}}</th>
    </tr>
    <tr>
        <td>Nomor HP</td>
        <td>:</td>
        <th>{{$data->user->phone}}</th>
    </tr>
    </table>
    <hr>
    <table style="border: 1px solid #999; width: 100%; margin: 20px 0; " id="table2">
        <tr>
            <th>Merek Mobil</th>
            <th>Nama Mobil</th>
            <th>Nomor Plat</th>
            <th>Tahun</th>
            <th>Warna</th>
        </tr>
        <tr>
            <td>{{$data->car->car_type->name}}</td>
            <td>{{$data->car->merk}}</td>
            <td>{{$data->car->no_plat}}</td>
            <td>{{$data->car->year}}</td>
            <td>{{$data->car->color}}</td>
        </tr>
    </table>
    <hr>
    <table>
        <tr>
            <td>Tanggal Sewa</td>
            <td>:</td>
            <th>{{date('d-m-Y', strtotime($data->lease_date))}}</th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <td>Tanggal Kembali</td>
            <td>:</td>
            <th>{{date('d-m-Y', strtotime($data->return_date))}}</th>
        </tr>
        <tr>
            <td>Harga Sewa Per Hari</td>
            <td>:</td>
            <th>Rp. {{ number_format($data->car->price, 0, ',', '.')}}</th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <td><strong>TOTAL HARGA SEWA</strong></td>
            <td>:</td>
            <th>Rp. {{ number_format($sewa, 0, ',', '.')}}</th>
        </tr>
    </table>
    @if ($data->return_date < now()) <hr>
        <table>
            <tr>
                <td>Tanggal Pengembalian</td>
                <td>:</td>
                <th>{{ $data->date_of_return}}</th>
            </tr>
            <tr>
                <td>Harga Denda Per Hari</td>
                <td>:</td>
                <th>Rp. {{ number_format($data->car->fine, 0, ',', '.')}}</th>
            </tr>
            <tr>
                <td><strong>TOTAL BAYAR DENDA</strong></td>
                <td>:</td>
                <th>Rp. {{ number_format($denda, 0, ',', '.')}}</th>
            </tr>

        </table>
        @endif
        </div> --}}
</body>
</html>
