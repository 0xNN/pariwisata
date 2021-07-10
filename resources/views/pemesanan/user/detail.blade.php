@extends('layouts.app')

@section('content')
    @include('layouts.headers.header', [
        'title' => __('Pembayaran Detail'),
        'description' => __(''),
        'class' => 'col-lg-7'
    ])
    @include('pemesanan.user.pembayaran')
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-light border-0">
                        <button name="print" id="print" data-url="{{ route('pemesanan.print', $pemesanan->id) }}" class="print btn btn-danger btn-sm"><i class="fas fa-print"></i> Cetak Invoice Pemesanan</button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <input type="hidden" name="pemesanan_id" id="pemesanan_id" value="{{ $pemesanan->id }}">
                            <table id="dt-pembayaran-detail" class="table table-bordered dt-responsive nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>ID</th>
                                        <th>Kode</th>
                                        <th>Pembayaran Ke</th>
                                        <th>Tagihan</th>
                                        <th>Status</th>
                                        <th>Bukti Bayar</th>
                                        <th>Bank</th>
                                        <th>No Rek</th>
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
        dataId = $('#pemesanan_id').val();
        var url = "{{ route('pemesanan.detail', ":dataId") }}";
        url = url.replace(':dataId', dataId);
        var table = $('#dt-pembayaran-detail').DataTable({
            language: {
                paginate: {
                    previous: "&lt;",
                    next: "&gt;",
                }
            },
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: url,
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'id', name: 'id'},
                {data: 'pembayaran_id', name: 'pembayaran_id'},
                {data: 'pembayaran_ke', name: 'pembayaran_ke'},
                {data: 'dibayar', name: 'dibayar'},
                {data: 'status_dibayar', name: 'status_dibayar'},
                {data: 'bukti_bayar', name: 'bukti_bayar'},
                {data: 'bank_id', name: 'bank_id'},
                {data: 'no_rekening', name: 'no_rekening'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            columnDefs: [ {
                className: 'dtr-control',
                orderable: false,
                targets:   0
            } ],
            order: [ 1, 'asc' ]
        });

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
                text = '<table class="table table-sm table-bordered"><tr>';
                for(let i = 0; i < d.length; i++)
                {
                    var img = d[i].replace(/^"(.+)"$/,'$1');
                    text += `<th><a href="{{ asset('images') }}/${img}"><img src="{{ asset('images') }}/${img}" style="height="80px"; width="110px"></a></th>`;
                }
                text += '</tr></table>';
                console.log(text);
                $('.message-modal').html('');
                $('.message-modal').append(text); // load response
                $('#modal-loader').hide(); // hide ajax loader
            })
            .fail(function(){
                $('#dynamic-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
                $('#modal-loader').hide();
            });
        });

        $('body').on('click', '#tombol-upload', function () {
            var id = $(this).data('id');
            console.log(id);
            $('#pembayaran_id').val(id);
            $('#form-upload').trigger('reset');
            $('#addUploadModal').modal('show');
        });

        $("#tombol-upload-image").click(function (event) {
            event.preventDefault();
            var form = $('#form-upload')[0];
            var data = new FormData(form);
            $("#tombol-upload-image").prop("disabled", true);
            $.ajax({
                type: "POST",
                enctype: 'multipart/form-data',
                url: "{{ route('pembayaran_detail.store') }}",
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                timeout: 600000,
                success: function (data) {
                    console.log("SUCCESS : ", data);
                    $("#tombol-upload-image").prop("disabled", false);
                    $('#form-upload').trigger("reset"); //form reset
                    $('#addUploadModal').modal('hide'); //modal hide
                    $('#tombol-upload-image').html('Upload'); //tombol simpan
                    var oTable = $('#dt-pembayaran-detail').dataTable(); //inialisasi datatable
                    oTable.fnDraw(false); //reset datatable
                    iziToast.success({ //tampilkan iziToast dengan notif data berhasil disimpan pada posisi kanan bawah
                        title: 'Successfully',
                        message: 'Berhasil upload data',
                        position: 'bottomRight'
                    });
                },
                error: function (e) {
                    console.log("ERROR : ", e);
                    $("#tombol-upload-image").prop("disabled", false);
                }
            });
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
                    $.ajax({
                        data: $('#form-tambah-edit')
                            .serialize(), //function yang dipakai agar value pada form-control seperti input, textarea, select dll dapat digunakan pada URL query string ketika melakukan ajax request
                        url: "{{ route('pembayaran_detail.store') }}", //url simpan data
                        type: "POST", //karena simpan kita pakai method POST
                        dataType: 'json', //data tipe kita kirim berupa JSON
                        success: function (data) { //jika berhasil
                            $('#form-tambah-edit').trigger("reset"); //form reset
                            $('#addUtamaModal').modal('hide'); //modal hide
                            $('#tombol-simpan').html('Simpan'); //tombol simpan
                            var oTable = $('#dt-pembayaran-detail').dataTable(); //inialisasi datatable
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

        $('#print').click(function() {
            var url = $(this).data('url');
            console.log(url);
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

        $('body').on('click', '.edit-post', function () {
            var data_id = $(this).data('id');
            $.get('pembayaran_detail/' + data_id + '/edit', function (data) {
                $('#modal-judul').html("Edit Post");
                $('#tombol-simpan').val("edit-post");
                $('#addUtamaModal').modal('show');
                $('#form-tambah-edit').trigger('reset');
                //set value masing-masing id berdasarkan data yg diperoleh dari ajax get request diatas
                $('#id').val(data.id);
                $('#nama_pesawat').val(data.nama_pesawat);
            })
        });

        $(document).on('click', '.delete', function () {
            dataId = $(this).attr('id');
            $('#deleteUtamaModal').modal('show');
        });

        $('#tombol-utama-hapus').click(function () {
            var url = "{{ route('pembayaran_detail.destroy', ":dataId") }}";
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
                    var oTable = $('#dt-pembayaran-detail').dataTable();
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