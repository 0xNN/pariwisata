@extends('layouts.app')

@section('content')
    @include('layouts.headers.header', [
        'title' => __('Pemesanan'),
        'description' => __(''),
        'class' => 'col-lg-7'
    ])
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-light border-0">
                        {{ __('Pemesanan') }}
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="dt-pemesanan" class="table table-bordered dt-responsive nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>ID</th>
                                        <th>Kode</th>
                                        <th>Paket</th>
                                        <th>Instansi/Pemesan</th>
                                        <th>Tgl Pemesanan</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
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
        var table = $('#dt-pemesanan').DataTable({
            language: {
                paginate: {
                    previous: "&lt;",
                    next: "&gt;",
                }
            },
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: "{{ route('pemesanan.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'id', name: 'id'},
                {data: 'kode_pemesanan', name: 'kode_pemesanan'},
                {data: 'paket_id', name: 'paket_id'},
                {data: 'user_id', name: 'user_id'},
                {data: 'tgl_pemesanan', name: 'tgl_pemesanan'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            columnDefs: [ {
                className: 'dtr-control',
                orderable: false,
                targets:   0
            } ],
            order: [ 1, 'asc' ]
        });

                
        $('body').on('click', '.setuju', function () {
            var dataId = $(this).data('id');
            var url = "{{ route('pemesanan.update', ":dataId") }}";
            url = url.replace(':dataId', dataId);
            $.ajax({
                url: url, //eksekusi ajax ke url ini
                type: 'put',
                beforeSend: function () {
                    $('#setuju').text('Setuju'); //set text untuk tombol hapus
                },
                success: function (data) { //jika sukses
                    var oTable = $('#dt-pemesanan').dataTable(); //inialisasi datatable
                    oTable.fnDraw(false); //reset datatable
                    iziToast.success({ //tampilkan izitoast success
                        title: 'Successfully',
                        message: 'Pemesanan Lunas',
                        position: 'bottomRight'
                    });
                }
            })
        });
    });
</script>
@endpush