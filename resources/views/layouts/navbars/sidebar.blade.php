<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand pt-0" href="{{ route('home') }}">
            <i class="ni ni-planet"></i>
            <span>{{ __('Pariwisata') }}</span>
        </a>
        <!-- User -->
        <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                            <img alt="Image placeholder" src="{{ asset('argon') }}/img/theme/user.png">
                        </span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">{{ __('Welcome!') }}</h6>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="dropdown-item">
                        <i class="ni ni-single-02"></i>
                        <span>{{ __('My profile') }}</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="ni ni-user-run"></i>
                        <span>{{ __('Logout') }}</span>
                    </a>
                </div>
            </li>
        </ul>
        
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main" data-toggle="collapse" data-target=".navbar-collapse">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="{{ route('home') }}">
                            <i class="ni ni-planet"></i>
                            <span>{{ __('Pariwisata') }}</span>
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-collapse-main" aria-expanded="false" aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Navigation -->
            <ul class="navbar-nav">
            @if (auth()->user()->is_admin == 1)                
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="ni ni-tv-2 text-primary"></i> {{ __('Dashboard') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="#navbar-user" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-user">
                        <i class="fas fa-th-list" style="color: #f4645f;"></i>
                        <span class="nav-link-text" style="color: #f4645f;">{{ __('User') }}</span>
                    </a>

                    <div class="collapse show" id="navbar-user">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('profile.edit') }}">
                                    {{ __('User profile') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('user.index') }}">
                                    {{ __('User Management') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="#navbar-transaksi" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-transaksi">
                        <i class="fas fa-window-restore" style="color: rgb(191, 28, 185)"></i>
                        <span class="nav-link-text" style="color: rgb(191, 28, 185)">{{ __('Transaksi') }}</span>
                    </a>

                    <div class="collapse show" id="navbar-transaksi">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('pemesanan.index') }}">
                                    {{ __('Pemesanan') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('pembayaran.index') }}">
                                    {{ __('Pembayaran') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="#navbar-master" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-master">
                        <i class="fas fa-coins" style="color: #615ff4;"></i>
                        <span class="nav-link-text" style="color: #615ff4;">{{ __('Master') }}</span>
                    </a>

                    <div class="collapse show" id="navbar-master">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('bank.index') }}">
                                    {{ __('Data Bank') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('bus.index') }}">
                                    {{ __('Data Bus') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('hotel.index') }}">
                                    {{ __('Data Hotel') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('pesawat.index') }}">
                                    {{ __('Data Pesawat') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('jenis_bus.index') }}">
                                    {{ __('Data Jenis Bus') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('lokasi.index') }}">
                                    {{ __('Data Lokasi') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('paket.index') }}">
                                    {{ __('Data Paket') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('jadwal.index') }}">
                                    {{ __('Data Jadwal') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('paket_lokasi.index') }}" >
                                    {{ __('Data Paket/Lokasi')}}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('perusahaan.index') }}">
                                    {{ __('Data Perusahaan') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('note.index') }}">
                                    {{ __('Data Note') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link active" href="#navbar-laporan" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-laporan">
                        <i class="fas fa-clipboard" style="color: #f45f8c;"></i>
                        <span class="nav-link-text" style="color: #f45f8c;">{{ __('Laporan') }}</span>
                    </a>

                    <div class="collapse show" id="navbar-laporan">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('laporan.pemesanan') }}">
                                    {{ __('Laporan Pemesanan') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </li> --}}
            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="ni ni-tv-2 text-primary"></i> {{ __('Dashboard') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="#navbar-user" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-user">
                        <i class="fas fa-th-list" style="color: #f4645f;"></i>
                        <span class="nav-link-text" style="color: #f4645f;">{{ __('User') }}</span>
                    </a>

                    <div class="collapse show" id="navbar-user">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('profile.edit') }}">
                                    {{ __('User profile') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                @if (auth()->user()->email_verified_at != null)    
                    <li class="nav-item">
                        <a class="nav-link active" href="#navbar-transaksi" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-transaksi">
                            <i class="fas fa-coins" style="color: #615ff4;"></i>
                            <span class="nav-link-text" style="color: #615ff4;">{{ __('Transaksi') }}</span>
                        </a>
                        <div class="collapse show" id="navbar-transaksi">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('pemesanan.index') }}">
                                        {{ __('Pemesanan') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('pembayaran.index') }}">
                                        {{ __('Pembayaran') }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif
            @endif
            </ul>
        </div>
    </div>
</nav>
