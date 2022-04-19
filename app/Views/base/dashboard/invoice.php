<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
        <div>
        <a href="<?= SITE_UNDANGAN ?>/<?= $order[0]->domain ?>" class="btn btn-primary btn-sm">Lihat Website</a>
        </div>
    </div> 

    <div class="row mb-3">
        <?php if($pembayaran[0]->status != 2){ ?>
        <div class="col-xl-12 col-lg-12 mb-4">
            <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <?php 
                    
                    $durasi = '+3 days';
                    $tglDaftar = $pembayaran[0]->created_at;
                    $tglExp = strtotime($durasi, strtotime($tglDaftar));
                    $tglExpFormated = date("d-m-Y H:i A",$tglExp);

                    ?>
                    
                    <h6 class="m-0 font-weight-bold " style="color:#10ac84">Invoice : Selesaikan pembayaran anda sebelum <?= $tglExpFormated ?></h6>

                </div>
            </div>
        </div>
        <?php } ?>
                    
                    


        <div class="col-xl-6 col-lg-6 mb-4">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Tagihan Pembayaran</h6>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Kode Pesanan</label>
                        <div class="upload-area-bg" style="margin-top: 5px;text-align: center;background: #f1f2f6; !important;">                       
                            <div class="col">
                                <div class="row">
                                    <div class="col">
                                    <a style="font-size: 16px;text-transform: uppercase;color: #2c3e50;font-weight:600;" >#<?= $pembayaran[0]->invoice ?></a>
                                    </div>
                                    <div class="col-auto">
                                    <?php if($pembayaran[0]->status == 2){ ?>
                                        <button  class="btn-success btn-sm btn" >Lunas</button>
                                    <?php }else if($pembayaran[0]->status == 1){ ?> 
                                        <button class="btn-warning btn-sm btn" >Menunggu Pembayaran</button>
                                    <?php }else if($pembayaran[0]->status == 0){ ?>
                                        <button class="btn-warning btn-sm btn" >Belum Lunas</button>
                                    <?php } ?>
                                    </div>
                                </div>   
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Nama Domain / URL Undangan</label>
                        <div class="upload-area-bg" style="margin-top: 5px;text-align: center;background: #f1f2f6;">
                            <a style="font-size: 16px;text-transform: uppercase;color: #007bff;" >undangan.sidoinikah.xyz/<?= $order[0]->domain ?></a>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Total Tagihan</label>
                        <div class="upload-area-bg" style="margin-top: 5px;text-align: center;background: #f1f2f6;">
                            <a style="font-size: 18px;color: #2c3e50;font-weight:bolder" ><?= rupiah($setting[0]->harga) ?></a>
                        </div>
                    </div>

                    <div class="form-group" style="text-align: center;">
                        <label class="form-check-label" >
                            Setelah melakukan pembayaran mohon konfirmasi pembayaran anda dengan menakan tombol <strong>Konfirmasi</strong> dan ikuti instruksi selanjutnya. 
                        </label>
                    </div>
                    <?php if($pembayaran[0]->status == 2){ ?>
                        <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#modalKonfirmasi" disabled>Konfirmasi</button>
                    <?php }else if($pembayaran[0]->status == 1){ ?> 
                        <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#modalMenunggu">Konfirmasi</button>
                    <?php }else if($pembayaran[0]->status == 0){ ?>
                        <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#modalKonfirmasi">Konfirmasi</button>
                    <?php } ?>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-lg-6 mb-4">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Rekening Pembayaran </h6>
                </div>
                <div class="card-body">

                    <div class="form-group">
                        <label>Nama Bank</label>
                        <div class="upload-area-bg d-flex justify-content-between" style="margin-top: 5px;text-align: center;background: #f1f2f6;">
                            <img src="<?= base_url() ?>/assets/base/img/bank.png" height="20px" width="80px">      
                            <a style="font-size: 16px;text-transform: uppercase;color: #2c3e50;" ><?= $setting[0]->nama_bank ?></a>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Nomor Rekening</label>
                        <div class="upload-area-bg d-flex justify-content-between" style="margin-top: 5px;text-align: center;background: #f1f2f6;">
                            <a style="font-size: 18px;text-transform: uppercase;color: #2c3e50;" ><?= $setting[0]->norek ?></a>   
                            <button class="btn btn-sm btn-secondary">Salin</button>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Atas Nama</label>
                        <div class="upload-area-bg" style="margin-top: 5px;text-align: center;background: #f1f2f6;">
                            <a style="font-size: 18px;text-transform: uppercase;color: #2c3e50;" ><?= strtoupper($setting[0]->nama_pemilik) ?></a>   
                        </div>
                    </div>

                </div>
            </div>
        </div>

     
    </div>
    <!--Row-->
</div>

<!-- Modal -->
<div class="modal fade" id="modalMenunggu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Peringatan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       Pembayaran anda sudah kami terima.<br>Mohon tunggu tim kami sedang melakukan verifikasi..
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalKonfirmasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> 
      <form method="POST" enctype="multipart/form-data"  action="<?php echo base_url('user/konfirmasi'); ?>">
      <div class="modal-body">
        <div class="col mt-2">
            <label>Nama Lengkap</label>
            <input name="nama_lengkap" type="text" class="form-control" placeholder="Contoh : Dinda Rahma" value="" required>
        </div>
        <div class="col mt-2">
            <label>Nama Bank</label>
            <input name="nama_bank" type="text" class="form-control" placeholder="Contoh : BRI Syariah " value="" required>
        </div>        
        <div class="col mt-2 mb-2">
            <label>Bukti Transfer (max 2MB)</label>
            <input type="file"  id="bukti" name="bukti">
        </div>
        <input type="hidden"  value="<?= $pembayaran[0]->invoice ?>" name="invoice">
      <div class="modal-footer">
        <button type="submit" class="btn btn-sm btn-primary" id="simpanKonfimasi">Konfirmasi</button>
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Batal</button>
      </div>
      </form>
    </div>
  </div>
</div>




<script>

</script>