<div class="modal fade" id="addUploadModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form id="form-upload" name="form-upload" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Pembayaran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="id" id="pembayaran_id">
        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              <select name="bank_id" id="bank_id" class="form-control">
                <option>-- BANK --</option>
                @foreach ($banks as $item)
                  <option value="{{ $item->id }}">{{ $item->nama_bank }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <input type="text" name="no_rekening" id="no_rekening" class="form-control" placeholder="No Rekening">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12">
            <div class="form-group">
              <input type="file" name="bukti_bayar" id="bukti_bayar" class="form-control" accept="image/jpeg, image/png">
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
          <h5 class="modal-title" id="exampleModalLabel">Bukti Bayar</h5>
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