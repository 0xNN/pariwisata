@extends('layouts.app')

@section('content')
    @include('layouts.headers.header', [
        'title' => __('Paket'),
        'description' => __(''),
        'class' => 'col-lg-7'
    ])
    @include('paket.modal')
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-light border-0">
                        {{ __('Paket') }}
                        <a href="javascript:void(0)" class="d-sm-inline-block btn btn-sm btn-secondary shadow-sm" id="tombol-utama">
                            <i class="fas fa-plus"></i>
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="dt-paket" class="table table-bordered dt-responsive nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>ID</th>
                                        <th>Nama Paket</th>
                                        <th>Keterangan</th>
                                        <th>Bus</th>
                                        <th>Pesawat</th>
                                        <th>Harga</th>
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
        var table = $('#dt-paket').DataTable({
            language: {
                paginate: {
                    previous: "&lt;",
                    next: "&gt;",
                }
            },
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: "{{ route('paket.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'id', name: 'id'},
                {data: 'nama_paket', name: 'nama_paket'},
                {data: 'keterangan', name: 'keterangan'},
                {data: 'bus_id', name: 'bus_id'},
                {data: 'pesawat_id', name: 'pesawat_id'},
                {data: 'harga_paket', name: 'harga_paket'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            columnDefs: [ {
                className: 'dtr-control',
                orderable: false,
                targets:   0
            } ],
            order: [ 1, 'asc' ]
        });
        $('#tombol-utama').click(function () {
            $('#button-simpan').val("create-post"); //valuenya menjadi create-post
            $('#id').val(''); //valuenya menjadi kosong
            $('#form-tambah-edit').trigger("reset"); //mereset semua input dll didalamnya
            $('#modal-judul').html("Tambah Bank"); 
            $('#addUtamaModal').modal('show'); //modal tampil
        });

        if ($("#form-tambah-edit").length > 0) {
            $("#form-tambah-edit").validate({
                submitHandler: function (form) {
                    var actionType = $('#tombol-simpan').val();
                    $('#tombol-simpan').html('Sending..');
                    var f = $('#form-tambah-edit')[0];
                    var data = new FormData(f);
                    $.ajax({
                        data: data,
                        processData: false,
                        contentType: false,
                        cache: false,
                        timeout: 600000,
                        url: "{{ route('paket.store') }}", //url simpan data
                        type: "POST", //karena simpan kita pakai method POST
                        success: function (data) { //jika berhasil
                            $('#form-tambah-edit').trigger("reset"); //form reset
                            $('#addUtamaModal').modal('hide'); //modal hide
                            $('#tombol-simpan').html('Simpan'); //tombol simpan
                            var oTable = $('#dt-paket').dataTable(); //inialisasi datatable
                            oTable.fnDraw(false); //reset datatable
                            iziToast.success({ //tampilkan iziToast dengan notif data berhasil disimpan pada posisi kanan bawah
                                title: 'Successfully',
                                message: 'Berhasil menambah data',
                                position: 'bottomRight'
                            });
                        },
                        error: function (data) { //jika error tampilkan error pada console
                            console.log('Error:', data);
                            $('#tombol-simpan').html('Simpan');
                        }
                    });
                }
            })
        }

        $('body').on('click', '.edit-post', function () {
            var data_id = $(this).data('id');
            $.get('paket/' + data_id + '/edit', function (data) {
                $('#modal-judul').html("Edit Post");
                $('#tombol-simpan').val("edit-post");
                $('#addUtamaModal').modal('show');
                $('#form-tambah-edit')[0].reset;
                //set value masing-masing id berdasarkan data yg diperoleh dari ajax get request diatas
                $('#id').val(data.id);
                $('#nama_paket').val(data.nama_paket);
                $('#keterangan').val(data.keterangan);
                $('#harga_paket').val(data.harga_paket);
                if(data.bus_id === null)
                {
                    console.log(data.bus_id);
                    $(`select#bus_id option[value='tidak_memilih']`).prop('selected',true);
                } else {
                    $(`select#bus_id option[value='${data.bus_id}']`).prop('selected',true);
                }

                if(data.pesawat_id === null)
                {
                    $(`select#pesawat_id option[value='tidak_memilih']`).prop('selected',true);
                } else {
                    $(`select#pesawat_id option[value='${data.pesawat_id}']`).prop('selected',true);
                }
            })
        });

        $(document).on('click', '.delete', function () {
            dataId = $(this).attr('id');
            $('#deleteUtamaModal').modal('show');
        });

        $('#tombol-utama-hapus').click(function () {
            var url = "{{ route('paket.destroy', ":dataId") }}";
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
                    var oTable = $('#dt-paket').dataTable();
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