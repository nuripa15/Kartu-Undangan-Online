<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
        <div>
        <a href="<?= SITE_UNDANGAN ?>/<?= $order[0]->domain ?>" class="btn btn-primary btn-sm">Lihat Website</a>
        </div>
    </div>

    <div class="row mb-3">

        <div class="col-xl-6 col-lg-6 mb-4">
              <!-- Form Basic -->
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Pengaturan Undangan</h6>
                </div>
                <div class="card-body">
                    <div class="form-group">
                    <label>Nama Domain / URL Undangan</label>
                    <label style="bottom: -12.3px;position: inherit;padding-left: 15px;color: #005CAA;font-weight: bold;display: table;margin-bottom: -2.1rem;">undangan.sidoinikah.xyz/</label>
                    <input id="domain" type="text" class="form-control" placeholder="akudandia" style="padding-left: 200px;" value="<?= $order[0]->domain ?>"  onkeyup="nospaces(this)" required>
                    </div>

                    <button class="btn btn-primary" data-toggle="modal" data-target="#modalDomain">Simpan</button>
                </div>
              </div>
        </div>


        <div class="col-xl-6 col-lg-6 mb-4">
         <!-- Form Basic -->
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Fitur Undangan</h6>
                </div>
                <div class="card-body">
                    <div class="form-group">
                      <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" disabled checked id="setSampul">
                        <label class="custom-control-label" for="setSampul" >Halaman Sampul</label>
                      </div>
                      <div class="custom-control custom-switch mt-2">
                        <input type="checkbox" class="custom-control-input" disabled checked id="setMempelai">
                        <label class="custom-control-label" for="setMempelai" >Halaman Mempelai</label>
                      </div>
                      <div class="custom-control custom-switch mt-2">
                        <input type="checkbox" class="custom-control-input" disabled checked id="setAcara">
                        <label class="custom-control-label" for="setAcara" >Halaman Acara</label>
                      </div>
                      <div class="custom-control custom-switch mt-2">
                        <input type="checkbox" class="custom-control-input" id="setUcapan" 
                        <?php if($fitur[0]->komen == '1') echo 'checked'; ?>>
                        <label class="custom-control-label" for="setUcapan" >Halaman Ucapan</label>
                      </div>
                      <div class="custom-control custom-switch mt-2">
                        <input type="checkbox" class="custom-control-input" id="setAlbum"
                        <?php if($fitur[0]->gallery == '1') echo 'checked'; ?>>
                        <label class="custom-control-label" for="setAlbum" >Halaman Gallery/Album</label>
                      </div>
                      <div class="custom-control custom-switch mt-2">
                        <input type="checkbox" class="custom-control-input" id="setCerita"
                        <?php if($fitur[0]->cerita == '1') echo 'checked'; ?>>
                        <label class="custom-control-label" for="setCerita">Halaman Cerita</label>
                      </div>
                      <div class="custom-control custom-switch mt-2">
                        <input type="checkbox" class="custom-control-input" id="setLokasi"
                        <?php if($fitur[0]->lokasi == '1') echo 'checked'; ?>>
                        <label class="custom-control-label" for="setLokasi" >Halaman Lokasi</label>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#modalFitur">Simpan</button>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-lg-6 mb-4">
              <!-- Form Basic -->
              <form method="post" enctype="multipart/form-data" action="<?php echo base_url('user/update_musik'); ?>">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Musik</h6>
                </div>
                <div class="card-body">

                    <label>Musik Latar (max 2MB)</label>
                    <div class="form-group">
                      <div class="custom-file">
                        <input type="file" name="musik" id="musik" accept=".mp3">
                      </div>
                    </div>

                    <button class="btn btn-primary" type="submit">Simpan</button>
                </div>
              </div>
              </form>
        </div>


    </div>
    <!--Row-->
</div>

<!-- Modal -->
<div class="modal fade" id="modalDomain" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Peringatan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Apakah kamu yakin ingin mengubah nama domain ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" id="simpanDomain">Ya</button>
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Batal</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="modalFitur" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
        <button type="button" class="btn btn-sm btn-primary" id="simpanFitur">Ya</button>
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Batal</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalGagal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Kesalahan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Gagal mengganti nama domain..
        Nama domain sudah dipakai!!
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>


<script>
    function nospaces(t){
      if(t.value.match(/\s/g)){
        t.value=t.value.replace(/\s/g,'');
      }
    }

    $('#simpanFitur').on('click', function(event) {

        var ucapan = $('#setUcapan').is(":checked") ? 1 : 0;
        var album = $('#setAlbum').is(":checked") ? 1 : 0;
        var cerita = $('#setCerita').is(":checked") ? 1 : 0;
        var lokasi = $('#setLokasi').is(":checked") ? 1 : 0;

        console.log(ucapan);

        $.ajax({
            url : "<?= base_url('user/update_fitur') ?>",
            method : "POST",
            data : {ucapan: ucapan,album: album, cerita: cerita, lokasi: lokasi},
            async : true,
            dataType : 'html',
            success: function($hasil){
                if($hasil == 'sukses'){
                    location.reload();
                }
            }
        });

    });

    $('#simpanDomain').on('click', function(event) {

      var domain = $('#domain').val();      

      $.ajax({
          url : "<?= base_url('user/update_domain') ?>",
          method : "POST",
          data : {domain: domain},
            async : true,
            dataType : 'html',
          success: function($hasil){
              if($hasil == 'sukses'){
                  location.reload();
              }else{
                  $('#modalDomain').modal('hide'); 
                  $('#modalGagal').modal('show'); 
              }

              console.log($hasil);
          }
      });

    });
</script>