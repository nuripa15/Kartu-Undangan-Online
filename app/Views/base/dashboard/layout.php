<!DOCTYPE html>
<html Content-Language="ID" lang="id" xml:lang="id">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Undangan digital berupa website untuk pernikahanmu. Lebih praktis, keren dan kekinian.">
    <meta name="author" content="MC Project">
    <link href="<?= base_url('assets/base'); ?>/img/favicon.png" rel="icon">
    <title><?= SITE_NAME; ?> - <?= $title; ?></title>
    <link href="<?= base_url('assets/dashboard/'); ?>/vendor/fontawesome-free/css/all.min.css?SIDOINIKAHV2" rel="stylesheet" type="text/css">
    <link href="<?= base_url('assets/dashboard/'); ?>/vendor/bootstrap/css/bootstrap.css?SIDOINIKAHV2" rel="stylesheet" type="text/css">
    <link href="<?= base_url('assets/dashboard/'); ?>/css/ruang-admin.css?SIDOINIKAHV2" rel="stylesheet">
    <link href="<?= base_url('assets/dashboard/'); ?>/vendor/datatables/dataTables.bootstrap4.min.css?SIDOINIKAHV2" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/base/css/croppie.min.css?SIDOINIKAHV2">
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/base/css/pikaday.css?SIDOINIKAHV2">


    <script src="<?= base_url() ?>/assets/base/js/moment-with-locales.js"></script>
    <script src="<?= base_url('assets/dashboard'); ?>/vendor/jquery/jquery.min.js"></script>
</head>

<body id="page-top">
<div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('user/dashboard'); ?>">
            <div class="sidebar-brand-icon">
                <img src="<?= base_url('assets/base'); ?>/img/logo2.png">
            </div>
            <div class="sidebar-brand-text mx-3"><?= SITE_NAME; ?></div>
        </a>
        <hr class="sidebar-divider my-0">
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('user/dashboard'); ?>">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>
        <hr class="sidebar-divider">
        <div class="sidebar-heading">
            Fitur
        </div>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap" aria-expanded="true" aria-controls="collapseBootstrap">
                <i class="far fa-fw fa-window-maximize"></i>
                <span>Website</span>
            </a>
            <div id="collapseBootstrap" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="<?= base_url('user/tampilan'); ?>">Tampilan</a>
                    <a class="collapse-item" href="<?= base_url('user/pengaturan'); ?>">Pengaturan</a>
                    <h6 class="collapse-header">Data Website</h6>
                    <a class="collapse-item" href="<?= base_url('user/mempelai'); ?>">Mempelai</a>
                    <a class="collapse-item" href="<?= base_url('user/acara'); ?>">Acara</a>
                    <a class="collapse-item" href="<?= base_url('user/album'); ?>">Gallery</a>
                    <a class="collapse-item" href="<?= base_url('user/cerita'); ?>">Cerita</a>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePengunjung" aria-expanded="true" aria-controls="collapsePengunjung">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Pengunjung</span>
            </a>
            <div id="collapsePengunjung" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="<?= base_url('user/riwayat'); ?>">Riwayat</a>
                    <a class="collapse-item" href="<?= base_url('user/ucapan'); ?>">Ucapan</a>
                </div>
            </div>
        </li>

    
        <hr class="sidebar-divider">
        <div class="sidebar-heading">
            Bantuan
        </div>
        <li class="nav-item">
            <a class="nav-link" href="https://api.whatsapp.com/send?phone=6282377823390">
                <i class="fa fa-fw fa-info-circle"></i>
                <span>Hubungi Kami</span>
            </a>
        </li>
        <hr class="sidebar-divider">
        <div class="version" ><?= SITE_NAME ?> Version 2</div>
    </ul>
    <!-- Sidebar -->

    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <!-- TopBar -->
            <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
                <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>
                <ul class="navbar-nav ml-auto">
                    <div class="topbar-divider d-none d-sm-block"></div>
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="img-profile rounded-circle" src="<?= base_url('assets/dashboard'); ?>/img/boy.png" style="max-width: 60px">
                            <span class="ml-2 d-none d-lg-inline text-white small"><?= $_SESSION['uname'] ?></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="<?= base_url('user/profil') ?>">
                                <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                Profil
                            </a>
                            <a class="dropdown-item" href="<?= base_url('user/invoice') ?>">
                                <i class="fas fa-money-bill fa-sm fa-fw mr-2 text-gray-400"></i>
                                Tagihan
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?= base_url('user/logout') ?>">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>
            <!-- Topbar -->
            <?php
            function rupiah($angka){
	
                $hasil_rupiah = "Rp " . number_format($angka,0,',','.');
                return $hasil_rupiah;
             
            }
            ?>
            <?php 
            echo view($view);
            ?>

        </div>
        
        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <p class="text-footer">&#169;2021 <a href="<?php echo base_url() ?>" rel="dofollow" target="_blank"><?= SITE_NAME ?></a> - <a href="https://mycoding.net" rel="dofollow" target="_blank">MC Project</a> - <a href="https://401xd.com" rel="dofollow" target="_blank">401XD Group</a>.</p>
                </div>
            </div>
        </footer>
        <!-- Footer -->
    </div>
    
</div>

<!-- Scroll to top -->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>


    <!-- modal upload croppie -->
    <div class="modal" id="myModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Foto Mempelai</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <div id="resizer"></div>
                    <hr>
                    <button class="btn btn-block btn-dark" id="upload" > 
                    Upload</button>
                </div>
            </div>
        </div>
    </div>

<script src="<?= base_url('assets/dashboard'); ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url('assets/dashboard'); ?>/vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="<?= base_url('assets/dashboard'); ?>/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/dashboard'); ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url('assets/dashboard'); ?>/js/ruang-admin.js"></script>

<!-- cart -->
<script src="<?= base_url('assets/dashboard'); ?>/vendor/chart.js/Chart.min.js"></script>
<script src="<?= base_url('assets/dashboard'); ?>/js/demo/chart-area-demo.js"></script>

<!-- Page level custom scripts -->
<script>
 $(document).ready(function () {
      $('#dataTable').DataTable(); // ID From dataTable 
      $('#dataTableHover').DataTable(); // ID From dataTable with Hover
    });
</script>

</body>

</html>