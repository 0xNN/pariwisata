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
              Invoice Pembayaran Ke-{{ $pembayaran_detail->pembayaran_ke }}
            </caption>
            <thead>
                <tr>
                    <th colspan="4">Invoice <strong>#{{ $pembayaran_detail->pembayaran->kode_pembayaran.'-'.$pembayaran_detail->pembayaran_ke }}</strong></th>
                    <th>{{ \App\Http\Controllers\IndonesiaFormat::hari(date('D', strtotime($pembayaran_detail->created_at))) }}, {{ \App\Http\Controllers\IndonesiaFormat::tanggal($pembayaran_detail->created_at->format('Y-m-d')) }}</th>
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
                        <h4>Pemesanan: </h4>
                        <p>{{ $pembayaran_detail->pembayaran->pemesanan->kode_pemesanan }}<br>
                        {{ $pembayaran_detail->pembayaran->pemesanan->user->institusi }}<br>
                        {{ $pembayaran_detail->bank->nama_bank }} <br>
                        {{ $pembayaran_detail->no_rekening }}
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
                    <th>Dibayar</th>
                </tr>
                <tr>
                    <td>{{ $pemesanan->paket->nama_paket }}</td>
                    <td>{{ $pemesanan->paket->keterangan }}</td>
                    <td>{{ ($pemesanan->paket->pesawat == null) ? $pemesanan->paket->bus->nama_bus: $pemesanan->paket->pesawat->nama_pesawat }}</td>
                    <td>{{ $pemesanan->pax }}</td>
                    <td>Rp {{ number_format($pembayaran_detail->dibayar, 0, ',', '.') }}</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="4">Total</th>
                    <td>Rp {{ number_format($pembayaran_detail->dibayar,0, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</body>
</html>