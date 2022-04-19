<!DOCTYPE html>
<html Content-Language="ID" lang="id" xml:lang="id">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Undangan digital berupa website untuk pernikahanmu. Lebih praktis, keren dan kekinian.">
    <meta name="author" content="rifai ahmed">
    <link href="<?= base_url('assets/base'); ?>/img/logo3.JPEG" rel="icon">
    <title>Oneweeding</title>
    <link href="<?= base_url('assets/admin/'); ?>/vendor/fontawesome-free/css/all.min.css?SIDOINIKAHV2" rel="stylesheet" type="text/css">
    <link href="<?= base_url('assets/admin/'); ?>/vendor/bootstrap/css/bootstrap.css?SIDOINIKAHV2" rel="stylesheet" type="text/css">
    <link href="<?= base_url('assets/admin/'); ?>/css/ruang-admin.css?SIDOINIKAHV2" rel="stylesheet">
    <link href="<?= base_url('assets/admin/'); ?>/vendor/datatables/dataTables.bootstrap4.min.css?SIDOINIKAHV2" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/base/css/croppie.min.css?SIDOINIKAHV2">
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/base/css/pikaday.css?SIDOINIKAHV2">


    <script src="<?= base_url() ?>/assets/base/js/moment-with-locales.js"></script>
    <script src="<?= base_url('assets/dashboard'); ?>/vendor/jquery/jquery.min.js"></script>
</head>

<body id="page-top">
<div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('admin/dashboard'); ?>">
            <div class="sidebar-brand-icon">
                <img src="<?= base_url('assets/base'); ?>/img/logo3.JPEG">
            </div>
            <div class="sidebar-brand-text mx-3">Onewedding</div>
        </a>
        <hr class="sidebar-divider my-0">
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('admin/dashboard'); ?>">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('admin/pengguna'); ?>">
                <i class="fas fa-fw fa-user-alt"></i>
                <span>Data Pengguna</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('admin/pembayaran'); ?>">
                <i class="fas fa-fw fa-money-bill-alt"></i>
                <span>Data Pembayaran</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('admin/setting'); ?>">
                <i class="fas fa-cogs"></i>
                <span>Setting</span></a>
        </li>
        <hr class="sidebar-divider">
        <div class="version" ><Onewdding> Version 2</div>
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
                            <span class="ml-2 d-none d-lg-inline text-white small"><?= $_SESSION['uname_admin'] ?></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="<?= base_url('admin/profil') ?>">
                                <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                Profil
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?= base_url('logout') ?>">
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
                    <p class="text-footer">&#169;Copyright 2022 <a href="<?php echo base_url() ?>" rel="dofollow" target="_blank">Onewedding</a>.</p>
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