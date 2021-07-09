<div class="modal fade" id="addUtamaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form id="form-tambah-edit" name="form-tambah-edit" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Paket</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="id" id="id">
        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              <input type="text" name="nama_paket" id="nama_paket" class="form-control" placeholder="Nama Paket">
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <input type="text" name="keterangan" id="keterangan" class="form-control" placeholder="Keterangan">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              <select name="bus_id" id="bus_id" class="form-control">
                <option value="tidak_memilih">-- BUS --</option>
                @foreach ($buses as $item)
                  <option value="{{ $item->id }}">{{ $item->nama_bus }} - min: {{ $item->minimum_pack }} / max: {{ $item->maksimum_pack }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <select name="pesawat_id" id="pesawat_id" class="form-control">
                <option value="tidak_memilih">-- Pesawat --</option>
                @foreach ($pesawats as $item)
                  <option value="{{ $item->id }}">{{ $item->nama_pesawat }}</option>
                @endforeach
              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12">
            <div class="form-group">
              <input type="number" name="harga_paket" id="harga_paket" class="form-control" placeholder="Harga Paket">
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-sm btn-success" id="tombol-simpan" value="create">Simpan</button>
      </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="deleteUtamaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Paket</h5>
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