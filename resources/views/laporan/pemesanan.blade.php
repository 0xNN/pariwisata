<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Pemesanan</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
      *{
          box-sizing: border-box;
          -webkit-box-sizing: border-box;
          -moz-box-sizing: border-box;
      }
      body{
          font-family: Helvetica;
          -webkit-font-smoothing: antialiased;
          background: rgb(255, 255, 255);
      }
      h2{
          text-align: center;
          font-size: 18px;
          text-transform: uppercase;
          letter-spacing: 1px;
          color: rgb(0, 0, 0);
          padding: 0;
      }

      .text-success {
        color: #2dce89;
      }

      .text-warning {
        color: #fb6340;
      }

      .text-danger {
        color: #f5365c;
      }

      .text-primary {
        color: #5e72e4;
      }

      /* Table Styles */

      .table-wrapper{
          box-shadow: 0px 35px 50px rgba(121, 120, 120, 0.2);
      }

      .fl-table {
          border-radius: 5px;
          font-size: 12px;
          font-weight: normal;
          border: none;
          border-collapse: collapse;
          width: 100%;
          max-width: 100%;
          white-space: nowrap;
          background-color: white;
      }

      .fl-table td, .fl-table th {
          text-align: center;
          padding: 8px;
      }

      .fl-table td {
          border-right: 1px solid #f8f8f8;
          font-size: 12px;
      }

      .fl-table thead th {
          color: #ffffff;
          background: #324960;
      }

      .header {
        color: #ffffff;
        background: #324960;
        text-align: right !important;
      }

      .fl-table thead th:nth-child(odd) {
          color: #ffffff;
          background: #324960;
      }

      .fl-table tr:nth-child(even) {
          background: #F8F8F8;
      }

      /* Responsive */
/* 
      @media (max-width: 767px) {
          .fl-table {
              display: block;
              width: 100%;
          }
          .table-wrapper:before{
              content: "Scroll horizontally >";
              display: block;
              text-align: right;
              font-size: 11px;
              color: white;
              padding: 0 0 10px;
          }
          .fl-table thead, .fl-table tbody, .fl-table thead th {
              display: block;
          }
          .fl-table thead th:last-child{
              border-bottom: none;
          }
          .fl-table thead {
              float: left;
          }
          .fl-table tbody {
              width: auto;
              position: relative;
              overflow-x: auto;
          }
          .fl-table td, .fl-table th {
              padding: 20px .625em .625em .625em;
              height: 60px;
              vertical-align: middle;
              box-sizing: border-box;
              overflow-x: hidden;
              overflow-y: auto;
              width: 120px;
              font-size: 13px;
              text-overflow: ellipsis;
          }
          .fl-table thead th {
              text-align: left;
              border-bottom: 1px solid #f7f7f9;
          }
          .fl-table tbody tr {
              display: table-cell;
          }
          .fl-table tbody tr:nth-child(odd) {
              background: none;
          }
          .fl-table tr:nth-child(even) {
              background: transparent;
          }
          .fl-table tr td:nth-child(odd) {
              background: #F8F8F8;
              border-right: 1px solid #E6E4E4;
          }
          .fl-table tr td:nth-child(even) {
              border-right: 1px solid #E6E4E4;
          }
          .fl-table tbody td {
              display: block;
              text-align: center;
          }
      } */
    </style>
</head>
<body>
<h2>Laporan Pemesanan</h2>
<div class="table-wrapper">
  <table class="fl-table">
    <thead>
    <tr>
        <th>Kode Pemesanan</th>
        <th>Pemesan</th>
        <th>Paket</th>
        <th>PAX</th>
        <th>Tgl</th>
        <th>No HP</th>
        <th>Jadwal</th>
        <th>Kendaraan</th>
        <th>Status</th>
        <th>Pembayaran</th>
    </tr>
    </thead>
    <tbody>
      @php
        $total = 0;
        $lunas = 0;
        $belum_lunas = 0;
      @endphp
      @foreach ($pemesanans as $item)
        @php
          $total += $item->pembayaran->total_bayar
        @endphp
          @if ($item->status == 1) 
            @php $lunas += $item->pembayaran->total_bayar @endphp
          @else 
            @php $belum_lunas += $item->pembayaran->total_bayar @endphp
          @endif
        <tr>
          <td>{{ $item->kode_pemesanan }}</td>
          <td>{{ $item->user->name }}/{{ $item->user->institusi }}</td>
          <td>{{ $item->paket->nama_paket }}</td>
          <td>{{ $item->pax }}</td>
          <td>{{ $item->tgl_pemesanan }}</td>
          <td>{{ $item->no_hp }}</td>
          <td>{{ $item->jadwal->tgl_keberangkatan }}</td>
          <td>{{ ($item->paket->bus == null) ? $item->paket->pesawat->nama_pesawat: $item->paket->bus->nama_bus }}</td>
          <td class="{{ $item->status==1?'text-success': 'text-danger' }}">{{ ($item->status == 1) ? 'lunas': 'belum lunas' }}</td>
          <td>Rp {{ number_format($item->pembayaran->total_bayar,0,',','.') }}</td>
        </tr>
      @endforeach
      <tr>
        <th class="header" colspan="9">Total Lunas</th>
        <th class="text-success">Rp {{ number_format($lunas,0,',','.') }}</th>
      </tr>
      <tr>
        <th class="header" colspan="9">Total Belum Lunas</th>
        <th class="text-danger">Rp {{ number_format($belum_lunas,0,',','.') }}</th>
      </tr>
      <tr>
        <th class="header" colspan="9">Total Keseluruhan</th>
        <th class="text-primary">Rp {{ number_format($total,0,',','.') }}</th>
      </tr>
    <tbody>
</table>
</div>
</body>
</html>