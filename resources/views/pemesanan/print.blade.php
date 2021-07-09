<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        body{
            font-family:'Gill Sans', 'Gill Sans MT', 'Calibri', 'Trebuchet MS', sans-serif;
            color:#333;
            text-align:left;
            font-size:18px;
            margin:0;
        }
        .container{
            margin:0 auto;
            margin-top:35px;
            width:100%;
            height:auto;
            background-color:#fff;
        }
        caption{
            font-size:28px;
            margin-bottom:15px;
        }
        table{
            border:1px solid #333;
            border-collapse:collapse;
            margin:0 auto;
            width:740px;
        }
        td, tr, th{
            padding:12px;
            border:1px solid #333;
            width:185px;
        }
        th{
            background-color: #f0f0f0;
        }
        h4, p{
            margin:0px;
        }
        .text-center {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <table>
            <caption>
                Invoice Bukti Pemesanan
            </caption>
            <thead>
                <tr>
                    <th colspan="4">Invoice <strong>#{{ $pemesanan->kode_pemesanan }}</strong></th>
                    <th>{{ \App\Http\Controllers\IndonesiaFormat::hari(date('D', strtotime($pemesanan->tgl_pemesanan))) }}, {{ \App\Http\Controllers\IndonesiaFormat::tanggal($pemesanan->tgl_pemesanan) }}</th>
                </tr>
                <tr>
                    <td colspan="2">
                        <h4>Perusahaan: </h4>
                        <p>{{ $perusahaan->nama_perusahaan }}.<br>
                            {{ $perusahaan->alamat_perusahaan }}<br>
                            {{ $perusahaan->no_telpon }}<br>
                            {{ $perusahaan->email }}
                        </p>
                    </td>
                    <td colspan="2">
                        <h4>Institusi / Pelanggan: </h4>
                        <p>{{ $pemesanan->user->name }}<br>
                        {{ $pemesanan->user->kartu_identitas }}<br>
                        {{ $pemesanan->user->institusi }} <br>
                        {{ $pemesanan->user->email }}
                        </p>
                    </td>
                    <td class="text-center">
                        <img src="data:image/png;base64, {!! $qrcode !!}">
                    </td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>Paket</th>
                    <th>Keterangan</th>
                    <th>Bus/Pesawat</th>
                    <th>PAX</th>
                    <th>Harga</th>
                </tr>
                <tr>
                    <td>{{ $pemesanan->paket->nama_paket }}</td>
                    <td>{{ $pemesanan->paket->keterangan }}</td>
                    <td>{{ ($pemesanan->paket->pesawat == null) ? $pemesanan->paket->bus->nama_bus: $pemesanan->paket->pesawat->nama_pesawat }}</td>
                    <td>{{ $pemesanan->pax }}</td>
                    <td>Rp {{ number_format($pemesanan->paket->harga_paket, 0, ',', '.') }}</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="4">Total</th>
                    @php
                      $total = $pemesanan->paket->harga_paket * $pemesanan->pax;
                    @endphp
                    <td>Rp {{ number_format($total,0, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</body>
</html>