@extends('layouts.app', ['class' => 'bg-default'])

@section('content')
    <div class="header bg-gradient-primary py-7 py-lg-8">
        <div class="container">
            <div class="header-body text-center mt-7 mb-7">
                <div class="row justify-content-center">
                    <div class="col-lg-5 col-md-6">
                        <h1 class="text-white">{{ __('Selamat Datang di Website pemesanan paket pariwisata') }}</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="separator separator-bottom separator-skew zindex-100">
            <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
                <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
            </svg>
        </div>
    </div>

    <div class="container mt--10 pb-5">
        <div class="row">
            @foreach ($pakets as $item) 
            <div class="col-sm-6 mt-4">
                <div class="card">
                    <div class="card-header bg-light shadow">
                        <h3 class="text-black">{{ $item->nama_paket }}</h3>
                    </div>
                    <div class="card-body">
                        @if ($item->bus != null)
                        <table class="table table-sm table-bordered table-responsive" style="width:100%">
                          <tr>
                            <th>Keterangan</th>
                            <th>{{ $item->keterangan }}</th>
                          </tr>
                          <tr>
                            <th>Harga</th>
                            <th>Rp {{ number_format($item->harga_paket,0,',','.').',-/PAX' }}</th>
                          </tr>
                          <tr>
                            <th>Bus</th>
                            <th>{{ $item->bus->nama_bus }}</th>
                          </tr>
                          <tr>
                            <th>Min PAX</th>
                            <th>{{ $item->bus->minimum_pack }}</th>
                          </tr>
                          <tr>
                            <th>Max PAX</th>
                            <th>{{ $item->bus->maksimum_pack }}</th>
                          </tr>
                          <tr>
                            <th>Lokasi</th>
                            <th>
                              @foreach ($paket_lokasis as $lokasi)
                                @if ($lokasi->paket_id == $item->id)
                                  {{ $lokasi->lokasi->nama_lokasi }},
                                @endif
                              @endforeach
                            </th>
                          </tr>
                        </table>
                      @else
                        <table class="table table-sm table-bordered table-responsive" style="width:100%">
                          <tr>
                            <th>Keterangan</th>
                            <th>{{ $item->keterangan }}</th>
                          </tr>
                          <tr>
                            <th>Harga</th>
                            <th>Rp {{ number_format($item->harga_paket,0,',','.').',-/PAX' }}</th>
                          </tr>
                          <tr>
                            <th>Pesawat</th>
                            <th>{{ $item->pesawat->nama_pesawat }}</th>
                          </tr>
                          <tr>
                            <th>Min PAX</th>
                            <th>{{ __('-') }}</th>
                          </tr>
                          <tr>
                            <th>Max PAX</th>
                            <th>{{ __('-') }}</th>
                          </tr>
                          <tr>
                            <th>Lokasi</th>
                            <th>
                              @foreach ($paket_lokasis as $lokasi)
                                @if ($lokasi->paket_id == $item->id)
                                  {{ $lokasi->lokasi->nama_lokasi }},
                                @endif
                              @endforeach
                            </th>
                          </tr>
                        </table>
                      @endif
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('pemesanan.index') }}" class="d-sm-inline-block btn btn-sm btn-success shadow-sm">
                            <i class="fas fa-cart-plus"></i> PESAN
                        </a>
                        <a href="{{ route('info.index', $item->id) }}" class="d-sm-inline-block btn btn-sm btn-warning shadow-sm">
                            <i class="fas fa-info"></i> INFO PAKET
                        </a>
                    </div>
                </div>
            </div>               
            @endforeach
        </div>
    </div>
@endsection
