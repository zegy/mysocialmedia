<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3</title>
  <!-- Google Font: Source Sans Pro --> <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons --> <link rel="stylesheet" href="<?= base_url('assets/plugins/fontawesome-free/css/all.min.css') ?>">
  <!-- IonIcons --> <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style --> <link rel="stylesheet" href="<?= base_url('assets/dist/css/adminlte.min.css') ?>">
</head>

<body class="hold-transition sidebar-mini"><!-- options: sidebar-collapse / sidebar-mini -->
  <div class="wrapper">
    <nav class="main-header navbar navbar-expand navbar-white navbar-light"><!-- Navbar -->
      <ul class="navbar-nav"><!-- Left navbar links -->
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item">
          <a href="<?php echo base_url('user/showprofile/' . session('id')) ?>" class="nav-link">Profile</a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto"><!-- Right navbar links -->
        <li class="nav-item"><!-- Navbar Search -->
          <a class="nav-link" data-widget="navbar-search" href="#" role="button">
            <i class="fas fa-search"></i>
          </a>
          <div class="navbar-search-block">
            <form class="form-inline">
              <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                  <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                  </button>
                  <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </li>       
        <li class="nav-item dropdown"><!-- Messages Dropdown Menu -->
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-comments"></i>
            <span class="badge badge-danger navbar-badge">3</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <a href="#" class="dropdown-item">
              <div class="media"><!-- Message Start -->
                <img src="<?= base_url('assets/dist/img/user1-128x128.jpg') ?>" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    Brad Diesel
                    <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">Call me whenever you can...</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div><!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <div class="media"><!-- Message Start -->
                <img src="<?= base_url('assets/dist/img/user8-128x128.jpg') ?>" alt="User Avatar" class="img-size-50 img-circle mr-3">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    John Pierce
                    <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">I got your message bro</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div><!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <div class="media"><!-- Message Start -->
                <img src="<?= base_url('assets/dist/img/user3-128x128.jpg') ?>" alt="User Avatar" class="img-size-50 img-circle mr-3">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    Nora Silvester
                    <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">The subject goes here</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div><!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
          </div>
        </li>
        <li class="nav-item dropdown"><!-- Notifications Dropdown Menu -->
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            <span class="badge badge-warning navbar-badge">15</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header">15 Notifications</span>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-envelope mr-2"></i> 4 new messages
              <span class="float-right text-muted text-sm">3 mins</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-users mr-2"></i> 8 friend requests
              <span class="float-right text-muted text-sm">12 hours</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-file mr-2"></i> 3 new reports
              <span class="float-right text-muted text-sm">2 days</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
            <i class="fas fa-th-large"></i>
          </a>
        </li>
      </ul>
    </nav><!-- /.navbar -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4"><!-- Main Sidebar Container -->
      <a href="index3.html" class="brand-link"><!-- Brand Logo -->
        <img src="<?= base_url('assets/dist/img/AdminLTELogo.png') ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
      </a>
      <div class="sidebar"><!-- Sidebar -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex"><!-- Sidebar user panel (optional) -->
          <div class="image">
            <img src="<?= base_url('assets/dist/img/user2-160x160.jpg') ?>" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block">Alexander Pierce</a>
          </div>
        </div>
        <nav class="mt-2"><!-- Sidebar Menu -->
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->
            <li class="nav-item">
              <a href="<?= base_url('fordis/umum') ?>" class="nav-link" id="umum">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Forum Diskusi Umum
                  <!-- <span class="right badge badge-danger">1</span> -->
                </p>
              </a>
            </li>
            <li class="nav-item" id="fordis_khusus_main">
              <a href="#" class="nav-link" id="fordis_khusus">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Forum Diskusi Khusus
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <!-- <li class="nav-item">
                  <a href="<?= base_url('fordis/publik') ?>" class="nav-link" id="publik">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Publik</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?= base_url('fordis/dosen') ?>" class="nav-link" id="dosen">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Dosen</p>
                  </a>
                </li> -->
                <li class="nav-item">
                  <a href="<?= base_url('fordis_khusus/create') ?>" class="nav-link" id="create">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Buat group baru</p>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </nav><!-- /.sidebar-menu -->
      </div><!-- /.sidebar -->
    </aside>
    <?= $this->renderSection('content') ?><!-- Content -->
    <aside class="control-sidebar control-sidebar-dark"><!-- Control Sidebar -->
      <!-- Control sidebar content goes here -->
    </aside><!-- /.control-sidebar -->
    <footer class="main-footer"><!-- Main Footer -->
      <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.2.0
      </div>
    </footer>
  </div><!-- ./wrapper -->

  <!-- ================================================ SCRIPTS ================================================ -->
  <!-- REQUIRED SCRIPTS -->
  <!-- jQuery --> <script src="<?= base_url('assets/plugins/jquery/jquery.min.js') ?>"></script>
  <!-- Bootstrap --> <script src="<?= base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
  <!-- AdminLTE --> <script src="<?= base_url('assets/dist/js/adminlte.js') ?>"></script>
  
  <!-- OPTIONAL SCRIPTS -->
  <!-- AdminLTE for demo purposes --> <script src="<?= base_url('assets/dist/js/demo.js') ?>"></script>
  
  <!-- MY CUSTOM SCRIPTS -->
  <!-- Set active sidebar menu START (experimental, mixed js with php). Set id on each sidebar menu first! -->
  <?php $uri = service('uri') ?>
  <script>
    $(document).ready(function(){
      document.getElementById("<?= $uri->getSegment(1) ?>").className += " active"
    });
  </script>
  <?php if (!empty($uri->getSegment(2))) { ?>
    <script>
      $(document).ready(function(){
        document.getElementById("<?= $uri->getSegment(2) ?>").className += " active"
        document.getElementById("<?= $uri->getSegment(1).'main' ?>").className += " menu-open"
      });
    </script>
  <?php } ?>
  <!-- Set active sidebar menu END -->
</body>
</html>
