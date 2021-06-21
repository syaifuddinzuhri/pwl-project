<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Nota Penyewaan Mobil</title>

    <style>
        .invoice-box {
            width: 100%;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            /* text-align: right; */
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .invoice-box.rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .invoice-box.rtl table {
            text-align: right;
        }

        .invoice-box.rtl table tr td:nth-child(2) {
            text-align: left;
        }

    </style>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="6">
                    <table>
                        <tr>
                            <td class="title">
                                <h4>Premium <span style="color: blue;">RentCar</span></h4>
                            </td>
                            <td>
                                Created: {{date('Y-m-d', strtotime(now()))}}<br />
                                Due: {{ $data->return_date}}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="information">
                <td colspan="6">
                    <table>
                        <tr>
                            <td>
                                {{$data->user->name}}<br />
                                {{$data->user->no_ktp}}<br />
                                {{$data->user->phone}} |
                                {{$data->user->email}}
                            </td>

                            <td>
                                Administrator<br />
                                admin.premiumrentcar@gmail.com<br />
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>


            <tr class="heading">
                <td>Merek Mobil</td>
                <td>Nama</td>
                <td>Harga Sewa (Rp)</td>
                <td>Tanggal Sewa</td>
                <td>Tanggal Kembali</td>
                <td>Subtotal (Rp)</td>
            </tr>

            <tr class="item">
                <td>{{$data->car->car_type->name}}</td>
                <td>{{$data->car->merk}}</td>
                <td>{{$data->car->price}}</td>
                <td>{{$data->lease_date}}</td>
                <td>{{$data->return_date}}</td>
                <td>{{$sewa}}</td>
            </tr>


            {{-- <tr class="total">
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>TOTAL</td>
                <td>{{$sewa}}</td>
            </tr> --}}
            <hr>
            <tr>
                <td style="font-weight: bold;">Harga Denda/hari (Rp) : </td>
                <td>{{$data->car->fine}}</td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Tanggal Pengembalian : </td>
                <td>{{$data->date_of_return}}</td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Total Denda (Rp) : </td>
                <td>{{$denda}}</td>
            </tr>
            <tr class="total">
                <td>TOTAL (Rp) : </td>
                <td>{{$sewa + $denda}}</td>
            </tr>
        </table>
    </div>
</body>
</html>
