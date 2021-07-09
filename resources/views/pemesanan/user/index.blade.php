@extends('layouts.app')

@section('content')
    @include('layouts.headers.header', [
        'title' => __('Pemesanan'),
        'description' => __(''),
        'class' => 'col-lg-7'
    ])
    @include('pemesanan.user.modal')
    <div class="container-fluid mt--7">
        @if ($pemesanan != null)
        <div class="row mt-4 col-xl-12 order-xl-1">
          <div class="card">
            <div class="card-body">
              Anda memiliki pemesanan paket yang belum Lunas!. Harap segera melunasi pesanan anda!. Kode Pemesanan: <a target="_blank" href="{{ route('pemesanan.detail', $pemesanan->id) }}">{{ $pemesanan->kode_pemesanan }}</a>
            </div>
          </div>
        </div>
        @else
        <div class="row">
          @foreach ($pakets as $item)            
            <div class="mt-4 col-xl-6 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-light border-0">
                      {{ $item->nama_paket }}
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
                      <a href="javascript:void(0)" class="d-sm-inline-block btn btn-sm btn-success shadow-sm" id="tombol-utama" data-id="{{ $item->id }}">
                        <i class="fas fa-cart-plus"></i> PESAN
                      </a>
                    </div>
                </div>
            </div>
          @endforeach
        </div>
        @endif
        @include('layouts.footers.auth')
    </div>
@endsection

@push('css')
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
<link rel="stylesheet" href="{{ asset('argon/dist/css/izitoast.min.css') }}">
<link rel="stylesheet" href="{{ asset('argon/css/style.css') }}">
@endpush

@push('js')
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('argon') }}/dist/js/izitoast.min.js"></script>
<script src="{{ asset('argon/js/index.var.js') }}"></script>
<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });

    $(document).ready(function() {
        var table = $('#dt-pesawat').DataTable({
            language: {
                paginate: {
                    previous: "&lt;",
                    next: "&gt;",
                }
            },
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: "{{ route('pesawat.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'id', name: 'id'},
                {data: 'nama_pesawat', name: 'nama_pesawat'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            columnDefs: [ {
                className: 'dtr-control',
                orderable: false,
                targets:   0
            } ],
            order: [ 1, 'asc' ]
        });

        if ($("#form-tambah-edit").length > 0) {
            $("#form-tambah-edit").validate({
                submitHandler: function (form) {
                    var actionType = $('#tombol-simpan').val();
                    $('#tombol-simpan').html('Sending..');
                    $.ajax({
                        data: $('#form-tambah-edit')
                            .serialize(), //function yang dipakai agar value pada form-control seperti input, textarea, select dll dapat digunakan pada URL query string ketika melakukan ajax request
                        url: "{{ route('pemesanan.store') }}", //url simpan data
                        type: "POST", //karena simpan kita pakai method POST
                        dataType: 'json', //data tipe kita kirim berupa JSON
                        success: function (data) { //jika berhasil
                            $('#form-tambah-edit').trigger("reset"); //form reset
                            $('#addUtamaModal').modal('hide'); //modal hide
                            $('#tombol-simpan').html('Simpan'); //tombol simpan
                            iziToast.success({ //tampilkan iziToast dengan notif data berhasil disimpan pada posisi kanan bawah
                                title: 'Successfully',
                                message: 'Berhasil menambah data',
                                position: 'bottomRight'
                            });
                            setTimeout(function(){ 
                              location.reload(); 
                            }, 2000);
                        },
                        error: function (data) { //jika error tampilkan error pada console
                            console.log('Error:', data);
                            $('#tombol-simpan').html('Simpan');
                        }
                    });
                }
            })
        }

        function formatter(bil)
        {
          var bilangan = bil;
          var	reverse = bilangan.toString().split('').reverse().join(''),
          ribuan 	= reverse.match(/\d{1,3}/g);
          ribuan	= ribuan.join('.').split('').reverse().join('');

          return ribuan;
        }

        $('body').on('click', '#tombol-utama', function () {
            var data_id = $(this).data('id');
            $.get('paket/' + data_id, function (data) {
                $('#modal-judul').html("Edit Post");
                $('#tombol-simpan').val("edit-post");
                $('#addUtamaModal').modal('show');
                $('#form-tambah-edit').trigger('reset');
                //set value masing-masing id berdasarkan data yg diperoleh dari ajax get request diatas
                $('#paket_id').val(data.id);
                $('#user_id').val({{ auth()->user()->id }});
                $('#nama_paket').val(data.nama_paket);
                $('#harga_paket').val('Rp ' + formatter(data.harga_paket) + ',-/PAX');
                $('#keterangan').val(data.keterangan);
                $('#kode_pemesanan').val('PM'+new Date().getTime()+'NN');
                if(data.bus_id == null)
                {
                  $('#pax').val(0);
                  $('#pax').attr({'min': 0, 'max': 0});
                } else {
                  $('#pax').val(data.minimum_pack);
                  $('#pax').attr({'min': data.minimum_pack, 'max': data.maksimum_pack});
                }
            })
        });

        $(document).on('click', '.delete', function () {
            dataId = $(this).attr('id');
            $('#deleteUtamaModal').modal('show');
        });

        $('#tombol-utama-hapus').click(function () {
            var url = "{{ route('pesawat.destroy', ":dataId") }}";
            url = url.replace(':dataId', dataId);
            $.ajax({
            url: url, //eksekusi ajax ke url ini
            type: 'delete',
            beforeSend: function () {
                $('#tombol-utama-hapus').text('Hapus Data'); //set text untuk tombol hapus
            },
            success: function (data) { //jika sukses
                setTimeout(function () {
                    $('#deleteUtamaModal').modal('hide'); //sembunyikan konfirmasi modal
                    var oTable = $('#dt-pesawat').dataTable();
                    oTable.fnDraw(false); //reset datatable
                });
                iziToast.warning({ //tampilkan izitoast warning
                    title: 'Successfully',
                    message: 'Berhasil menghapus data',
                    position: 'bottomRight'
                });
            }
            })
        });
    });
</script>
@endpush