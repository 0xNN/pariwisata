function verify(id)
{
    var id = id;
    var url = "{{ route('user.update', ":id") }}";
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
        var oTable = $('#dt-user-management').dataTable(); //inialisasi datatable
        oTable.fnDraw(false); //reset datatable
        iziToast.success({ //tampilkan iziToast dengan notif data berhasil disimpan pada posisi kanan bawah
          title: 'Successfully',
          message: 'Berhasil menambah data',
          position: 'bottomRight'
        });
      }
    })
}