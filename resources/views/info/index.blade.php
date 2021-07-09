@extends('layouts.app', ['class' => 'bg-default'])

@section('content')
    <div class="header bg-gradient-primary py-7 py-lg-8">
        <div class="container">
            <div class="header-body text-center mt-7 mb-7">
                <div class="row">
                    <div class="col-lg-4 col-md-4">
                      <div class="card">
                        <div class="card-header bg-light shadow">
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
                    <div class="col-lg-8 col-md-8">
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
                                  <img class="d-block w-100" src="{{ asset('images/').'/'.str_replace('"','',$item->lokasi->foto) }}" height="400px" width="200px" alt="Image">
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
            </div>
        </div>
        <div class="separator separator-bottom separator-skew zindex-100">
            <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
                <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
            </svg>
        </div>
    </div>
@endsection