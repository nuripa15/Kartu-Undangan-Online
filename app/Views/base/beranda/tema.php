<!DOCTYPE html>
<html Content-Language="ID" lang="id" xml:lang="id">
  <head>
    <title>Onwedding</title>
    <link rel="icon" href="<?php echo base_url() ?>/assets/base/img/favicon.png?<?= date("Y-m-d"); ?>">

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Undangan digital berupa website untuk pernikahanmu. Lebih praktis, keren dan kekinian.">
    <meta name="keywords" content="Undangan digital, Website pernikahan, Undangan kekinian, Web undangan kren">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="theme-color" content="#005CAA" />
    <meta name="author" content="rifai ahmed">

    <!-- Required CSS -->
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/base/css/bootstrap.min.css?SIDOINIKAHV2" >
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/base/css/line-icons.css?SIDOINIKAHV2">
    <link type="text/css" href="<?php echo base_url() ?>/assets/base/css/froala_blocks.css?SIDOINIKAHV2" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,600|Roboto" rel="stylesheet">

  </head>

  <body>
    <header>
        <div class="container">
          <nav class="navbar navbar-expand-md fixed-top">
            <div class="container">
              <a class="navbar-brand" href="<?php echo base_url() ?>">
                <img src="<?php echo base_url() ?>/assets/base/img/logo.png?cache<?= date("Y-m-d"); ?>" height="35s" alt="image">
              </a>

              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav3" aria-controls="navbarNav3" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
        
              <div class="collapse navbar-collapse" id="navbarNav3">
                <ul class="navbar-nav ml-auto">
                  <li class="nav-item active">
                    <a class="nav-link" href="<?= base_url()?>">BERANDA <span class="sr-only">(current)</span></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="<?= base_url()?>/#fitur">FITUR</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="<?= base_url()?>/#harga">HARGA</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="<?= base_url()?>#tema">TEMA</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="<?= base_url()?>#testi">TESTIMONI</a>
                  </li>
                </ul>
        
              </div>
            </div>
          </nav>
        </div>
    </header>

      <section class="fdb-block cover-tema d-flex align-items-center" >
        <div class="container align-items-end justify-content-center d-flex">
          <div class="row align-items-top text-center">
            <div class="col-12 col-md-12 col-lg-12">
              <h1 class="judul">Pilih Tema</h1>
              <p class="lead subjudul">Tersedia banyak pilihan tema undangan yang menarik untuk pernikahanmu..</p>
              </div>
          </div>
        </div>
      </section>

      <section class="fdb-block team-1" id="tema">
        <div class="container">
          <div class="row">

          <?php foreach ($tema->getResult() as $row){ ?>
            <div class="col-lg-3 col-md-6 col-xs-12 mt-5">
              <div class="fdb-box p-0">
                <img alt="image" class="img-fluid rounded-0" src="<?php echo base_url() ?>/assets/themes/<?= $row->nama_theme ?>/preview.png">
      
                <div class="content p-2 d-flex justify-content-center">
                  <h3><strong><?= $row->nama_theme ?></strong></h3>
                </div>

                <div class="d-flex justify-content-center">
                  <p class="mt-2 mr-2"><a href="<?php echo base_url('order/'.$row->kode_theme) ?>" class="btn btn-success btn-sm">Pesan</a></p>  
                  <p class="mt-2"><a href="<?= base_url('demo/'.$row->nama_theme) ?>" class="btn btn-primary btn-sm">Pilih Tema</a></p>
                </div>
              </div>
            </div>
          <?php } ?>

          </div>
        </div>
      </section>

      <footer class="fdb-block footer-small footer">
        <div class="container">
        <div class="col-12 text-lg-left">
            <p class="lead footer-social">
              <a href="https://twitter.com/Onwedding" class="mx-2"><i class="lni-twitter-filled" aria-hidden="true"></i></a>
              <a href="https://facebook.com/Onwedding" class="mx-2"><i class="lni-facebook-filled" aria-hidden="true"></i></a>
              <a href="https://instagram.com/Onwedding" class="mx-2"><i class="lni-instagram-filled" aria-hidden="true"></i></a>
            </p>
          </div>
            <div class="row text-center">
            <div class="col">
                <p class="text-footer" style="color:#fff;">&#169;Copy right 2022 <a href="<?php echo base_url() ?>" rel="dofollow" target="_blank">Onewedding</a> </a>.</p>
            </div>
            </div>
        </div>
    </footer>
      
    <script src="<?php echo base_url() ?>/assets/base/js/jquery-min.js"></script>
    <script src="<?php echo base_url() ?>/assets/base/js/popper.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/base/js/bootstrap.min.js"></script>
  </body>
</html>