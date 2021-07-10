@extends('layouts.app', ['title' => __('Perusahaan')])

@section('content')
  @include('layouts.headers.header', [
    'title' => __('Perusahaan'),
    'description' => __(''),
    'class' => 'col-lg-7'
  ])
  <div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-12 order-xl-1">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <h3 class="mb-0">{{ __('Data Perusahaan') }}</h3>
                    </div>
                </div>
                <div class="card-body">
                  @if ($perusahaan == null)
                    <form method="post" action="{{ route('perusahaan.store') }}" autocomplete="off">
                      @csrf
                      <h6 class="heading-small text-muted mb-4">{{ __('Informasi Perusahaan') }}</h6>
                      @if (session('status'))
                          <div class="alert alert-success alert-dismissible fade show" role="alert">
                              {{ session('status') }}
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                              </button>
                          </div>
                      @endif
                      <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('nama_perusahaan') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="nama_perusahaan">{{ __('Nama Perusahaan') }}</label>
                                <input type="text" name="nama_perusahaan" id="nama_perusahaan" class="form-control form-control-alternative{{ $errors->has('nama_perusahaan') ? ' is-invalid' : '' }}" placeholder="{{ __('Nama Perusahaan') }}" value="{{ old('nama_perusahaan') }}" required autofocus>
                                @if ($errors->has('nama_perusahaan'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nama_perusahaan') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('alamat_perusahaan') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="alamat_perusahaan">{{ __('Alamat Perusahaan') }}</label>
                                <textarea name="alamat_perusahaan" id="alamat_perusahaan" class="form-control form-control-alternative{{ $errors->has('alamat_perusahaan') ? ' is-invalid' : '' }}" placeholder="{{ __('Alamat Perusahaan') }}" value="{{ old('alamat_perusahaan') }}" required></textarea>
                                @if ($errors->has('alamat_perusahaan'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('alamat_perusahaan') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('no_telpon') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="no_telpon">{{ __('No Telpon') }}</label>
                                <input type="text" name="no_telpon" id="no_telpon" class="form-control form-control-alternative{{ $errors->has('no_telpon') ? ' is-invalid' : '' }}" placeholder="{{ __('No Telpon') }}" value="{{ old('no_telpon') }}" required>
                                @if ($errors->has('no_telpon'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('no_telpon') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-email">{{ __('Email') }}</label>
                                <input type="email" name="email" id="input-email" class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" value="{{ old('email') }}" required>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('bank') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="bank">{{ __('Bank') }}</label>
                                <input type="bank" name="bank" id="bank" class="form-control form-control-alternative{{ $errors->has('bank') ? ' is-invalid' : '' }}" placeholder="{{ __('Bank') }}" value="{{ $perusahaan->bank }}" required>
                                @if ($errors->has('bank'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('bank') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('no_rekening') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="no_rekening">{{ __('No Rekening') }}</label>
                                <input type="no_rekening" name="no_rekening" id="no_rekening" class="form-control form-control-alternative{{ $errors->has('no_rekening') ? ' is-invalid' : '' }}" placeholder="{{ __('No Rekening') }}" value="{{ $perusahaan->no_rekening }}" required>
                                @if ($errors->has('no_rekening'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('no_rekening') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('atas_nama') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="atas_nama">{{ __('Atas Nama') }}</label>
                                <input type="atas_nama" name="atas_nama" id="atas_nama" class="form-control form-control-alternative{{ $errors->has('atas_nama') ? ' is-invalid' : '' }}" placeholder="{{ __('Atas Nama') }}" value="{{ $perusahaan->atas_nama }}" required>
                                @if ($errors->has('atas_nama'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('atas_nama') }}</strong>
                                    </span>
                                @endif
                            </div>
                          <div class="text-center">
                              <button type="submit" class="btn btn-success mt-4">{{ __('Simpan') }}</button>
                          </div>
                      </div>
                    </form>
                  @else
                    <form method="post" action="{{ route('perusahaan.update', $perusahaan->id) }}" autocomplete="off">
                        @csrf
                        @method('put')
                        <h6 class="heading-small text-muted mb-4">{{ __('Informasi Perusahaan') }}</h6>
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('nama_perusahaan') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="nama_perusahaan">{{ __('Nama Perusahaan') }}</label>
                                <input type="text" name="nama_perusahaan" id="nama_perusahaan" class="form-control form-control-alternative{{ $errors->has('nama_perusahaan') ? ' is-invalid' : '' }}" placeholder="{{ __('Nama Perusahaan') }}" value="{{ $perusahaan->nama_perusahaan }}" required autofocus>
                                @if ($errors->has('nama_perusahaan'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nama_perusahaan') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('alamat_perusahaan') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="alamat_perusahaan">{{ __('Alamat Perusahaan') }}</label>
                                <textarea name="alamat_perusahaan" id="alamat_perusahaan" class="form-control form-control-alternative{{ $errors->has('alamat_perusahaan') ? ' is-invalid' : '' }}" placeholder="{{ __('Alamat Perusahaan') }}" required>{{ $perusahaan->alamat_perusahaan }}</textarea>
                                @if ($errors->has('alamat_perusahaan'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('alamat_perusahaan') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('no_telpon') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="no_telpon">{{ __('No Telpon') }}</label>
                                <input type="text" name="no_telpon" id="no_telpon" class="form-control form-control-alternative{{ $errors->has('no_telpon') ? ' is-invalid' : '' }}" placeholder="{{ __('No Telpon') }}" value="{{ $perusahaan->no_telpon }}" required>
                                @if ($errors->has('no_telpon'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('no_telpon') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-email">{{ __('Email') }}</label>
                                <input type="email" name="email" id="input-email" class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" value="{{ $perusahaan->email }}" required>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('bank') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="bank">{{ __('Bank') }}</label>
                                <input type="bank" name="bank" id="bank" class="form-control form-control-alternative{{ $errors->has('bank') ? ' is-invalid' : '' }}" placeholder="{{ __('Bank') }}" value="{{ $perusahaan->bank }}" required>
                                @if ($errors->has('bank'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('bank') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('no_rekening') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="no_rekening">{{ __('No Rekening') }}</label>
                                <input type="no_rekening" name="no_rekening" id="no_rekening" class="form-control form-control-alternative{{ $errors->has('no_rekening') ? ' is-invalid' : '' }}" placeholder="{{ __('No Rekening') }}" value="{{ $perusahaan->no_rekening }}" required>
                                @if ($errors->has('no_rekening'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('no_rekening') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('atas_nama') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="atas_nama">{{ __('Atas Nama') }}</label>
                                <input type="atas_nama" name="atas_nama" id="atas_nama" class="form-control form-control-alternative{{ $errors->has('atas_nama') ? ' is-invalid' : '' }}" placeholder="{{ __('Atas Nama') }}" value="{{ $perusahaan->atas_nama }}" required>
                                @if ($errors->has('atas_nama'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('atas_nama') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-success mt-4">{{ __('Simpan') }}</button>
                            </div>
                        </div>
                    </form>
                  @endif
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footers.auth')
  </div>
@endsection
