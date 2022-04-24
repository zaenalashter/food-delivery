<!-- Modal -->
<div class="modal fade" id="modal-form" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h3 class="modal-title"></h3>
      </div>
      <div class="modal-body form">
        <form action="#" id="form" class="form-horizontal">
            <?= csrf_field(); ?>
            <input type="hidden" value="" name="id"/>

            <div class="form-group">
                <div class="control-label col-md-3">Nama Produk</div>
                <div class="col-md-8">
                    <input id="nama_produk" name="nama_produk" placeholder="Nama Produk" class="form-control" type="text">
                    <span class="help-block"></span>
                </div>
                <div class="col-md-1"></div>
            </div>
            <div class="form-group">
                <div class="control-label col-md-3">Harga</div>
                <div class="col-md-8">
                    <input id="harga" name="harga" placeholder="Harga" class="form-control" type="text">
                    <span class="help-block"></span>
                </div>
                <div class="col-md-1"></div>
            </div>
            <div class="form-group">
                <div class="control-label col-md-3">Kategori</div>
                <div class="col-md-8">
                   <?php
                    $dropdown = GetDropdownList('kategori', ['nama_kategori', 'nama_kategori'],'Nama Kategori');
                    echo form_dropdown('kategori', $dropdown, '', ' class="form-control"');
                   ?>
                    <span class="help-block"></span>
                </div>
                <div class="col-md-1"></div>
            </div>
            <div class="form-group">
                <div class="control-label col-md-3">Deskripsi</div>
                <div class="col-md-8">
                    <textarea id="deskripsi" name="deskripsi" placeholder="Deskripsi" class="form-control" rows="3"></textarea>
                    <span class="help-block"></span>
                </div>
                <div class="col-md-1"></div>
            </div>
            <div class="form-group">
                <div class="control-label col-md-3">Gambar</div>
                <div class="col-md-8">
                    <input id="gambar" name="gambar" class="form-control" type="file" onchange="imgPreview()">
                    <span class="help-block"></span>
                    <img class="img-preview" width="100%" height="250px">
                </div>
                <div class="col-md-1"></div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" id="btn-save" onclick="ajaxSave()" class="btn btn-primary" data-dismiss="modal">Simpan</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
      </div>
    </div>
  </div>
</div>