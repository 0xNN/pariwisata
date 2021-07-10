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
                        <button name="print" id="print" data-url="{{ route('laporan.pemesanan') }}" class="print btn btn-danger btn-sm"><i class="fas fa-print"></i> Cetak Laporan Pemesanan</button>
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
<link rel="stylesheet" href="{{ asset('argon') }}/css/responsive.dataTables.min.css">
<link rel="stylesheet" href="{{ asset('argon/dist/css/izitoast.min.css') }}">
<link rel="stylesheet" href="{{ asset('argon/css/style.css') }}">
@endpush

@push('js')
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
<script src="{{ asset('argon') }}/js/dataTables.responsive.min.js"></script>
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
            var id = $(this).data('id');
            let onOk = () => verify(id);
            let notifier = new AWN();
            notifier.confirm(
                'Yakin ingin menyelesaikan?', 
                onOk,
                null,
                {
                    labels: {
                        confirm: 'Konfirmasi?'
                    }
                }
            );
        });

        $('#print').click(function() {
            var url = $(this).data('url');
            $(this).prop('disabled', true);
            $.ajax({
                type: 'GET',
                url: url,
                xhrFields: {
                    responseType: 'blob'
                },
                success: function(response){
                    $('#print').prop('disabled', false);
                    const blob_file = response;
                    const file_url = URL.createObjectURL(blob_file);
                    window.open(file_url);
                },
                error: function(blob){
                    console.log(blob);
                }
            });
        });

        function verify(id)
        {
            var id = id;
            var url = "{{ route('pemesanan.update', ":id") }}";
            url = url.replace(':id', id);
            console.log(url);
            $.ajax({
                url: url, //eksekusi ajax ke url ini
                data: {
                    id: id,
                    _token:'{{ csrf_token() }}',
                },
                dataType: "json",
                type: 'PUT',
                error: function (data) {
                    console.log(data);
                },
                success: function (data) { //jika sukses
                    var oTable = $('#dt-pemesanan').dataTable(); //inialisasi datatable
                    oTable.fnDraw(false); //reset datatable
                        iziToast.success({ //tampilkan iziToast dengan notif data berhasil disimpan pada posisi kanan bawah
                        title: 'Successfully',
                        message: 'Disetujui',
                        position: 'bottomRight'
                    });
                }
            })
        }
    });
</script>
@endpush