@extends('layouts.app')

@section('content')
    @include('layouts.headers.header', [
      'title' => __('Info Paket'),
      'description' => __(''),
      'class' => 'col-lg-7'
    ])
    <div class="container-fluid mt--7">
      <div class="row">
        <div class="mt-4 col-xl-6 order-xl-1">
          <div class="card bg-secondary shadow">
            <div class="card-header bg-light">
              {{ $paket->nama_paket }}
            </div>
            <div class="card-body">
              <table class="table table-sm table-bordered">
                <tr>
                  <th>Keterangan</th>
                  <th>{{ $paket->keterangan }}</th>
                </tr>
                <tr>
                  <th>Bus/Pesawat</th>
                  <th>{{ ($paket->bus == null) ? $paket->pesawat->nama_pesawat : $paket->bus->nama_bus }}</th>
                </tr>
                <tr>
                  <th>Harga</th>
                  <th>Rp {{ number_format($paket->harga_paket, 0, ',', '.') }},-/PAX</th>
                </tr>
                <tr>
                  <th>Max</th>
                  <th>{{ ($paket->bus == null) ? '-': $paket->bus->minimum_pack }}</th>
                </tr>
                <tr>
                  <th>Min</th>
                  <th>{{ ($paket->bus == null) ? '-': $paket->bus->maksimum_pack }}</th>
                </tr>
              </table>
            </div>
            <div class="card-footer">
              <a href="{{ route('pemesanan.index') }}" class="d-sm-inline-block btn btn-sm btn-success shadow-sm">
                <i class="fas fa-cart-plus"></i> PESAN
              </a>
            </div>
          </div>
        </div>
        <div class="mt-4 col-lg-6 col-md-6">
          <div class="card">
            <div class="card-header bg-light shadow">
              Lokasi yang akan dikunjungi
            </div>
            <div class="card-body">
              <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                  @foreach ($paket_lokasis as $item)
                    <li data-target="#carouselExampleIndicators" data-slide-to="{{ $loop->iteration - 1 }}" class="{{ ($loop->iteration == 1) ? 'active': '' }}"></li>
                  @endforeach
                </ol>
                <div class="carousel-inner">
                  @foreach ($paket_lokasis as $item)    
                    <div class="carousel-item {{ ($loop->iteration == 1) ? 'active': '' }}">
                      <img class="d-block w-100" src="{{ asset('images/').'/'.str_replace('"','',$item->lokasi->foto) }}" height="300px" width="200px" alt="Image">
                      <div class="carousel-caption d-none d-md-block">
                        <h2 class="text-white">{{ $item->lokasi->nama_lokasi }}</h2>
                      </div>
                    </div>
                  @endforeach
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="mt-4 col-xl-6 order-xl-1">
          <div class="card bg-secondary shadow">
            <div class="card-header bg-light">{{ $paket->bus_id == null ? 'Pesawat': 'Bus' }}</div>
            <div class="card-body">
              <div id="carouselExampleIndicators1" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">   
                  @foreach ($details as $item)
                    <li data-target="#carouselExampleIndicators1" data-slide-to="{{ $loop->iteration - 1 }}" class="{{ ($loop->iteration == 1) ? 'active': '' }}"></li>
                  @endforeach
                </ol>
                <div class="carousel-inner">
                  @foreach ($details as $item)    
                    <div class="carousel-item {{ ($loop->iteration == 1) ? 'active': '' }}">
                      <img class="d-block w-100" src="{{ asset('images/').'/'.str_replace('"','',$item->foto) }}" height="300px" width="200px" alt="Image">
                      <div class="carousel-caption d-none d-md-block">
                        <h2 class="text-white">{{ ($item->pesawat == null) ? $item->bus->nama_bus: $item->pesawat->nama_pesawat }}</h2>
                      </div>
                    </div>
                  @endforeach
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators1" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators1" role="button" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>
              </div>
            </div>
          </div>
        </div>
        <div class="mt-4 col-lg-6 col-md-6">
          <div class="card bg-secondary shadow">
            <div class="card-header bg-light">Hotel</div>
            <div class="card-body">
              <div id="carouselExampleIndicators2" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">   
                  @foreach ($hotel_foto as $item)
                    <li data-target="#carouselExampleIndicators2" data-slide-to="{{ $loop->iteration - 1 }}" class="{{ ($loop->iteration == 1) ? 'active': '' }}"></li>
                  @endforeach
                </ol>
                <div class="carousel-inner">
                  @foreach ($hotel_foto as $hf)    
                    <div class="carousel-item {{ ($loop->iteration == 1) ? 'active': '' }}">
                      <img class="d-block w-100" src="{{ asset('images/').'/'.str_replace('"','',$hf['foto']) }}" height="300px" width="200px" alt="Image">
                      <div class="carousel-caption d-none d-md-block">
                        <h2 class="text-white">{{ $hf['nama_hotel'] }}</h2>
                      </div>
                    </div>  
                  @endforeach
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators2" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators2" role="button" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    @include('layouts.footers.auth')
@endsection