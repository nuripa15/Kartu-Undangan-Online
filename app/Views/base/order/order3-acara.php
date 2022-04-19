<div class="konten" style="display: flex;flex-grow: 1;overflow-x: hidden;flex-direction: row;margin-top: 60px;margin-bottom: 40px;">
    <section class="fdb-block" style="padding-top: 20px;flex:1; ">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12 col-md-8 col-lg-8 col-xl-6">
            <div class="row">
              <div class="col text-center">
                <h1 style="color: #005CAA;margin-bottom:0px;">Acara!</h1>
                <p tyle="font-size: 15px;font-weight:500; ">Hai kak! di isi dulu ya datanya </p>
              </div>
            </div>
            
          <form action="<?php echo base_url('order/4') ?>" method="post">
            <div class="progress" style="margin-top: 10px;">
              <div class="progress-bar" role="progressbar" style="width: 35%;" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">30%</div>
            </div>

            <a style="color: #2c3e50;margin-bottom:0px;font-size: 20px;font-weight: 600;margin-top: 15px;display: flex;">Akad Nikah</a>

            <div class="row align-items-center">
               <div class="col-6">
                <label>Tanggal </label>
                <input name="datepicker" type="text" class="form-control" placeholder="Tanggal" id="datepicker" readonly="readonly" style="cursor:pointer; background-color: #FFFFFF" value="<?php if(isset($_SESSION['tanggal_akad'])) echo $_SESSION['tanggal_akad']; ?>" required>
                <input type="hidden" id="tanggal_akad" name="tanggal_akad" value="<?php if(isset($_SESSION['tanggal_akad'])) echo $_SESSION['tanggal_akad']; ?>">
              </div>
              <div class="col-6">
                <label>Waktu / Jam</label>
                <input name="waktu_akad" type="text" class="form-control" placeholder="Contoh : 10.00 Pagi" value="<?php if(isset($_SESSION['waktu_akad'])) echo $_SESSION['waktu_akad']; ?>" required>
              </div>
            </div>

            <div class="row align-items-center mt-3">
              <div class="col">
                <label>Tempat / Lokasi</label>
                <input name="lokasi_akad" type="text" class="form-control" placeholder="Contoh : Kediaman Mempelai Wanita " value="<?php if(isset($_SESSION['lokasi_akad'])) echo $_SESSION['lokasi_akad']; ?>" required>
              </div>
            </div>

            <div class="row align-items-center mt-3">
              <div class="col">
                <label>Alamat</label>
                <textarea name="alamat_akad" type="text" class="form-control" placeholder="Contoh : JL. Ahmad Yani No.1" required><?php if(isset($_SESSION['alamat_akad'])) echo $_SESSION['alamat_akad']; ?></textarea>
              </div>
            </div>

           <a style="color: #2c3e50;margin-bottom:0px;font-size: 20px;font-weight: 600;margin-top: 15px;display: flex;">Resepsi</a>

            <div class="row align-items-center">
               <div class="col-6">
                <label>Tanggal </label>
                <input name="datepicker2" type="text" class="form-control" placeholder="Tanggal" id="datepicker2" readonly="readonly" style="cursor:pointer; background-color: #FFFFFF" value="<?php if(isset($_SESSION['tanggal_resepsi'])) echo $_SESSION['tanggal_resepsi']; ?>" required>
                <input type="hidden" id="tanggal_resepsi" name="tanggal_resepsi" value="<?php if(isset($_SESSION['tanggal_resepsi'])) echo $_SESSION['tanggal_resepsi']; ?>">
              </div>
              <div class="col-6">
                <label>Waktu / Jam</label>
                <input name="waktu_resepsi" type="text" class="form-control" placeholder="Contoh : 10.00 Pagi"value="<?php if(isset($_SESSION['waktu_resepsi'])) echo $_SESSION['waktu_resepsi']; ?>" required>
              </div>
            </div>

            <div class="row align-items-center mt-3">
              <div class="col">
                <label>Tempat / Lokasi</label>
                <input name="lokasi_resepsi" type="text" class="form-control" placeholder="Contoh : Kediaman Mempelai Wanita" value="<?php if(isset($_SESSION['lokasi_resepsi'])) echo $_SESSION['lokasi_resepsi']; ?>" required>
              </div>
            </div>

            <div class="row align-items-center mt-3">
              <div class="col">
                <label>Alamat</label>
                <textarea name="alamat_resepsi" type="text" class="form-control" placeholder="Contoh : JL. Ahmad Yani No.1"><?php if(isset($_SESSION['alamat_resepsi'])) echo $_SESSION['alamat_resepsi']; ?></textarea>
              </div>
            </div>

            <div class="row align-items-center mt-3">
              <div class="col">
                <label>Google Maps Link</label>
                <input name="maps_resepsi" type="text" class="form-control" placeholder="Contoh : Kediaman Mempelai Wanita" value="<?php if(isset($_SESSION['maps_resepsi'])) echo $_SESSION['maps_resepsi']; ?>" >
                <div class="mt-1">
                  <label class="form-check-label ">
                      <a href="<?= base_url('maps'); ?>" style="margin-top: 105px;color: #2c3e50;position: relative;top:3px;color:#17a2b8;"><i class="lni-question-circle" style="color:#17a2b8;"></i>&nbsp Cara Menambahkan Maps</a>
                    </label>
                </div>
              </div>
            </div>

            <div class="row justify-content-start mt-4" >
              <div class="col">
                <div class="row">
                  
                  <div class="col-auto">
                    <a href="<?php echo base_url('order/2'); ?>" class="btn btn-secondary btn-order">Kembali</a>
                  </div>
                  <div class="col">
                    <input name="submit" type="submit" class="btn btn-primary btn-order btn-block" style="background-color: #005CAA;" value="Lanjut">
                  </div>

                </div>   
              </div>
            </div>
          </form>

          </div>
        </div>
      </div>
    </section>
</div>