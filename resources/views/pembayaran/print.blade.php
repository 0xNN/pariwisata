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
        .text-left {
          text-align: left !important;
        }
        .text-success{color:#28a745!important}
        .text-danger{color:#dc3545!important}
        .text-warning{color:#ffc107!important}
    </style>
</head>
<body>
    <div class="container">
        <table>
            <caption>
              Invoice Pembayaran
            </caption>
            <thead>
                <tr>
                    <th colspan="4">Invoice <strong>#{{ $pembayaran->kode_pembayaran }}</strong></th>
                    <th>{{ \App\Http\Controllers\IndonesiaFormat::hari(date('D', strtotime($pembayaran->created_at))) }}, {{ \App\Http\Controllers\IndonesiaFormat::tanggal($pembayaran->created_at->format('Y-m-d')) }}</th>
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
                        <p>{{ $pembayaran->pemesanan->kode_pemesanan }}<br>
                        {{ $pembayaran->pemesanan->user->institusi }}<br>
                        {{ $pembayaran->pemesanan->user->name }}<br>
                        @if ($pembayaran->status_pembayaran == 1)                  
                          <span class="text-success">Lunas</span><br>
                        @else
                          <span class="text-danger">Belum Lunas</span><br>
                        @endif
                        </p>
                    </td>
                    <td class="text-center">
                        <img src="data:image/png;base64, {!! $qrcode !!}">
                    </td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>Pembayaran Ke</th>
                    <th>Bank</th>
                    <th>No Rek</th>
                    <th>Status</th>
                    <th>Dibayar</th>
                </tr>
                @php
                  $total_lunas = 0;
                  $total_belum_lunas = 0;
                @endphp
                @foreach ($pembayaran_detail as $item) 
                  <tr>
                    <td>{{ $item->pembayaran_ke }}</td>
                    <td>{{ ($item->bank == null) ? '' : $item->bank->nama_bank }}</td>
                    <td>{{ $item->no_rekening }}</td>
                    @if ($item->status_dibayar == 1)
                      <td class="text-success">Lunas</td>
                    @else
                      <td class="text-danger">Belum Lunas</td>
                    @endif
                    <td class="text-left">Rp {{ number_format($item->dibayar, 0, ',', '.') }}</td>
                  </tr>
                  @if ($item->status_dibayar == 0 || $item->status_dibayar == 2)
                    {{ $total_belum_lunas += $item->dibayar }}
                  @else
                    {{ $total_lunas += $item->dibayar }}
                  @endif
                @endforeach
                <tr>
                  <th colspan="4">Total Lunas</th>
                  <td class="text-left">Rp {{ number_format($total_lunas, 0, ',', '.') }}</td>
                </tr>
                <tr>
                  <th colspan="4">Total Belum Lunas</th>
                  <td class="text-left text-danger">Rp {{ number_format($total_belum_lunas, 0, ',', '.') }}</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="4">Total Dibayar</th>
                    <td>Rp {{ number_format($total,0, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</body>
</html>