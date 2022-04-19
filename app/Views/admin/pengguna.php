

<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
    </div>

    <div class="row mb-3">


        <!-- Invoice Example -->
        <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-primary">
                  <h6 class="m-0 font-weight-bold text-light">Data Ucapan</h6>
                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush" id="dataTable">
                    <thead class="thead-light">
                      <tr>
                        <th>Email</th>
                        <th>Domain</th>
                        <th>Exp</th>
                        <th>Status</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th>Email</th>
                        <th>Domain</th>
                        <th>Exp</th>
                        <th>Status</th>
                        <th>Aksi</th>
                      </tr>
                    </tfoot>
                    <tbody>
                    <?php 
                    foreach($join as $row){ 
                    ?>
                      <tr>
                        <td><?= $row->email ?></td>
                        <td><?= $row->domain ?></td>

                        <!-- status Exp -->
                        <?php if($row->statusPembayaran != 2){ ?>

                          <?php 
                    
                          $durasi = '+3 days';
                          $tglDaftar = $row->created_at;
                          $tglExp = strtotime($durasi, strtotime($tglDaftar));
                          $tglExpFormated = date("d-m-Y H:i A",$tglExp);

                          ?>

                          <td><?= $tglExpFormated ?></td>

                        <?php }else{ ?>
                          <td>-</td>
                        <?php } ?>
                        
                        <?php if($row->statusWeb == '1'){ ?>    
                        <td><span class="badge badge-success">Aktif</span></td>
                        <?php }else{ ?>    
                        <td><span class="badge badge-danger">Tidak Aktif</span></td>
                        <?php } ?>

                        <td>
                            <form method="post" action="<?php echo base_url('admin/edit_pengguna'); ?>">
                            <input type="hidden" value="<?= $row->id_user ?>" name="id">
                            <button 
                            class="btn btn-sm btn-primary" type="submit">Edit</button>
                            </form>
                            <button 
                            data-id="<?= $row->id_user?>" 
                            class="btn btn-sm btn-danger hapus" data-toggle="modal" data-target="#modalHapus">Hapus</button>
                        </td>
                      </tr>

                    <?php } ?>
                      
                    </tbody>
                  </table>
                </div>
              </div>
        </div>
        <!-- Message From Customer-->
       
    </div>
    <!--Row-->
</div>
<!---Container Fluid-->

<!-- Modal -->
<div class="modal fade" id="modalHapus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Peringatan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Apakah kamu yakin ingin menghapus pengguna ini ?<br>
        <strong>SEMUA DATA PENGGUNA TERMASUK WEBSITE AKAN TERHAPUS!!</strong>
        <input type="hidden" id="iduser" value=""/>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm text-danger" id="hapusBtn">Hapus</button>
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

<script>
  

    $('.hapus').on('click', function (event) {
        var iduser = $(this).data('id');
        $(".modal-body #iduser").val( iduser );
    });

    $('#hapusBtn').on('click', function(event) {

        var id = $('#iduser').val();
    
        $.ajax({
            url : "<?= base_url('admin/hapus_user') ?>",
            method : "POST",
            data : {id: id},
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