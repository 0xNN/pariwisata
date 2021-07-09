<div class="modal fade" id="addUtamaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form id="form-tambah-edit" name="form-tambah-edit">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Pemesanan?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="id" id="id">
        <div class="row">
          <div class="col-sm-12">
            <div class="form-group">
              <input type="text" name="kode_pemesanan" id="kode_pemesanan" class="form-control" readonly>
            </div>
          </div>
        </div>
        <div class="row">
          <input type="hidden" name="paket_id" id="paket_id">
          <input type="hidden" name="user_id" id="user_id">
          <div class="col-sm-6">
            <div class="form-group">
              <input type="text" name="nama_paket" id="nama_paket" class="form-control" placeholder="Nama Paket" readonly>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <input type="text" name="harga_paket" id="harga_paket" class="form-control" placeholder="Harga Paket" readonly>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              <input type="text" name="keterangan" id="keterangan" class="form-control" placeholder="Keterangan" readonly>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <input type="number" name="pax" id="pax" class="form-control" placeholder="PAX">
            </div>
          </div>
        </div>
        <h3 class="font-italic text-danger">Note*</h3>
        <div class="row">
          <div class="col-sm-6">
            <small class="text-success">Harga Termasuk</small>
            <ul>
              @foreach ($harga_termasuk as $item)
                <li>{{ $item->penjelasan }}</li>
              @endforeach
            </ul>
          </div>
          <div class="col-sm-6">
            <small class="text-success">Harga Tidak Termasuk</small>
            <ul>
              @foreach ($harga_tidak_termasuk as $item)
                <li>{{ $item->penjelasan }}</li>
              @endforeach
            </ul>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12">
            <small class="text-danger">Pemesanan dilakukanPembayaran bisa dilakukan 3x dengan ketentuan: Pembayaran ke-1 sebesar 30%, Pembayaran ke-2 sebesar 50%, dan Pembayaran ke-3 sebesar 20%. Setelah melakukan pemesanan, selanjutnya anda akan mendapatkan kode pembayaran & kode pemesanan.</small>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-sm btn-success" id="tombol-simpan" value="create">Pesan</button>
      </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="deleteUtamaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Pemesanan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Apakah Anda Yakin Akan di Hapus?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" name="tombol-utama-hapus" id="tombol-utama-hapus" class="btn btn-danger">Hapus</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="addUploadModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form id="form-upload" name="form-upload" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Pemesanan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-sm-12">
            <div class="form-group">
              <input type="hidden" name="pesawat_id" id="pesawat_id">
              <input type="file" name="foto[]" id="foto" class="form-control" accept="image/jpeg, image/png" multiple>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-sm btn-success" id="tombol-upload-image" value="create">Upload</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Gambar Pemesanan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body message-modal">
          <div class="data-image">

          </div>
        </div>
      </div>
  </div>
</div>