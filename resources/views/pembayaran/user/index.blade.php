@extends('layouts.app')

@section('content')
    @include('layouts.headers.header', [
        'title' => __('Riwayat'),
        'description' => __(''),
        'class' => 'col-lg-7'
    ])
    @include('pembayaran.admin.modal')
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-light border-0">
                        {{ __('Riwayat Pesanan/Pembayaran Anda') }}
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="dt-pembayaran" class="table table-bordered dt-responsive nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>ID</th>
                                        <th>Kode Pemesanan</th>
                                        <th>Kode Pembayaran</th>
                                        <th>Paket</th>
                                        <th>Pax</th>
                                        <th>Tgl Pesan</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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
        var table = $('#dt-pembayaran').DataTable({
            language: {
                paginate: {
                    previous: "&lt;",
                    next: "&gt;",
                }
            },
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: "{{ route('pembayaran.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'id', name: 'id'},
                {data: 'kode_pemesanan', name: 'kode_pemesanan'},
                {data: 'kode_pembayaran', name: 'kode_pembayaran'},
                {data: 'paket_id', name: 'paket_id'},
                {data: 'pax', name: 'pax'},
                {data: 'tgl_pemesanan', name: 'tgl_pemesanan'},
                {data: 'status', name: 'status'},
            ],
            columnDefs: [ {
                className: 'dtr-control',
                orderable: false,
                targets:   0
            } ],
            order: [ 1, 'asc' ]
        });

        function formatter(bil)
        {
          var bilangan = bil;
          var	reverse = bilangan.toString().split('').reverse().join(''),
          ribuan 	= reverse.match(/\d{1,3}/g);
          ribuan	= ribuan.join('.').split('').reverse().join('');

          return ribuan;
        }

        $('body').on('click', '.view', function(e) {
            e.preventDefault();
            var url = $(this).data('url');
            $('.message-modal').html(''); 
            $('#modal-loader').show();     
            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'html'
            })
            .done(function(data){
                var d = JSON.parse(data);
                text = '<table class="table table-sm table-bordered">';
                text += '<thead>';
                text += `
                  <tr>
                    <th>Pembayaran Ke</th>
                    <th>Tagihan</th>
                    <th>No Rek</th>
                    <th>Bukti Bayar</th>
                    <th>Aksi</th>
                  </tr>
                `;
                text += '</thead><tbody>';
                for(let i = 0; i < d.length; i++)
                {
                  text += '<tr>';
                    var img = d[i].bukti_bayar;
                    text += `
                      <th>${d[i].pembayaran_ke}</th>
                      <th>Rp ${formatter(d[i].dibayar)}</th>
                      <th>${d[i].no_rekening}</th>
                    `;
                    text += `<th><a target="_blank" href="{{ asset('images') }}/${img}"><img src="{{ asset('images') }}/${img}" style="height="80px"; width="110px"></a></th>`;
                    text += `<th>`;
                      if(d[i].status_dibayar == 1)
                      {
                        text += '<span class="badge badge-success"><i class="fas fa-check"></i> Selesai</span>';
                      } else {
                        text += `<a href="javascript:void(0)" name="setuju" data-id="${d[i].id}" class="setuju btn btn-info btn-sm"><i class="fas fa-check"></i></a>`;
                      }
                    text += `</th>`;

                  text += '</tr>';
                }
                text += '</tbody></table>';
                $('.message-modal').html('');
                $('.message-modal').append(text); // load response
                $('#modal-loader').hide(); // hide ajax loader
            })
            .fail(function(){
                $('#dynamic-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
                $('#modal-loader').hide();
            });
        });

        
        $('body').on('click', '.setuju', function () {
            var dataId = $(this).data('id');
            console.log(dataId);
            var url = "{{ route('pembayaran_detail.update', ":dataId") }}";
            url = url.replace(':dataId', dataId);
            $.ajax({
              url: url, //eksekusi ajax ke url ini
              type: 'put',
              beforeSend: function () {
                  $('#setuju').text('Setuju'); //set text untuk tombol hapus
              },
              success: function (data) { //jika sukses
                  iziToast.success({ //tampilkan izitoast success
                      title: 'Successfully',
                      message: 'Pembayaran disetujui',
                      position: 'bottomRight'
                  });

                  setTimeout(function() {
                    location.reload();
                  }, 2000);
              }
            })
        });

                
        $('body').on('click', '.edit-post', function () {
            var url = $(this).data('url');
            $.ajax({
                url: url, //eksekusi ajax ke url ini
                type: 'put',
                beforeSend: function () {
                    $('#edit-post').text('Check'); //set text untuk tombol hapus
                },
                success: function (data) { //jika sukses
                    var oTable = $('#dt-pembayaran').dataTable();
                    oTable.fnDraw(false);
                    iziToast.success({ //tampilkan izitoast success
                        title: 'Successfully',
                        message: 'Pembayaran disetujui',
                        position: 'bottomRight'
                    });
                }
            })
        });
    });
</script>
@endpush