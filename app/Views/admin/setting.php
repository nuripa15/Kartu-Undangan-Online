<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
    </div> 

    <div class="row mb-3">

        <div class="col-xl-6 col-lg-6 mb-4">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Setting Website</h6>
                </div>
                <div class="card-body">

                    <div class="form-group">
                        <label>Harga Undangan</label>
                        <input id="harga" type="text" class="form-control" placeholder="Contoh : 10000" value="<?= $setting[0]->harga ?>" required>
                    </div>
                    <hr>
                    <label>Rekening Pembayaran</label>
                    <div class="form-group mt-2">
                        <label>Nama Bank</label>
                        <input id="bank" class="form-control" placeholder="Contoh : Bank BCA" value="<?= $setting[0]->nama_bank ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Nomor Rekening</label>
                        <input id="norek" type="text" class="form-control" placeholder="Contoh : 2720189278" value="<?= $setting[0]->norek ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Nama Pemilik Bank</label>
                        <input id="nama" type="text" class="form-control" placeholder="Contoh : Adinda Larasati" value="<?= $setting[0]->nama_pemilik ?>" required>
                    </div>

                    <button class="btn btn-primary" data-toggle="modal" data-target="#modalSetting">Simpan</button>
                </div>
            </div>
        </div>

     
    </div>
    <!--Row-->
</div>

<!-- Modal -->
<div class="modal fade" id="modalSetting" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Peringatan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Apakah kamu yakin ingin menyimpan perubahan ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" id="simpanSetting">Ya</button>
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Batal</button>
      </div>
    </div>
  </div>
</div>

<script>
$('#simpanSetting').on('click', function(event) {

var harga = $('#harga').val();
var bank = $('#bank').val();
var nama = $('#nama').val();
var norek = $('#norek').val();

$.ajax({
    url : "<?= base_url('admin/update_setting') ?>",
    method : "POST",
    data : {harga: harga,bank: bank, nama: nama,norek:norek},
    async : true,
    dataType : 'html',
    success: function($hasil){
        if($hasil == 'sukses'){
            location.reload();
        }
    }
});

});
</script>