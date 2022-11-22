<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3</title>
  <!-- Google Font: Source Sans Pro --><link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons --><link rel="stylesheet" href="<?= base_url('assets/plugins/fontawesome-free/css/all.min.css') ?>">
  <!-- IonIcons --><link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style --><link rel="stylesheet" href="<?= base_url('assets/dist/css/adminlte.min.css') ?>">

  <!-- SweetAlert2 --><link rel="stylesheet" href="<?= base_url('assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') ?>">
  <!-- Ekko Lightbox --><link rel="stylesheet" href="<?= base_url('assets/plugins/ekko-lightbox/ekko-lightbox.css') ?>">

  <!-- NOTE Custom "AdminLTE-3.2.0" style (Override "adminlte.min") -->
  <style>
      /* User profile image's circle based on role (Style based on profile page's "Profile Image") */
      .circle-role-admin{border:2px solid #bc4b4b;margin:0 auto;padding:3px;width:100px}
      .circle-role-dosen{border:2px solid #e8df5d;margin:0 auto;padding:3px;width:100px}
      .circle-role-mahasiswa{border:2px solid #5de8df;margin:0 auto;padding:3px;width:100px}
  </style>  
</head>

<!-- <body class="hold-transition sidebar-mini"> --><!-- options: sidebar-collapse / sidebar-mini -->
<body class="hold-transition sidebar-mini sidebar-collapse layout-fixed"><!-- options: sidebar-collapse / sidebar-mini -->
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
        <li class="nav-item dropdown"><!-- Messages Dropdown Menu -->
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            <span class="badge badge-danger navbar-badge">3</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <a href="#" class="dropdown-item">
              <div class="media"><!-- Message Start -->
                <img src="<?= base_url('assets/dist/img/user1-128x128.jpg') ?>" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    Brad Diesel
                    <!-- <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span> NOTE Original!-->
                    <span class="float-right text-sm text-danger">Comment</span> <!-- NOTE The custom -->
                  </h3>
                  <p class="text-sm">Call me whenever you can...</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div><!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
          </div>
        </li>
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
        <!-- NOTE Below is CI's "settings" button -->
        <!-- <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
            <i class="fas fa-th-large"></i>
          </a>
        </li> -->
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
            <li class="nav-header">FORUM DISKUSI :</li>
            <li class="nav-item">
              <a href="<?= base_url('group/umum/') ?>" class="nav-link" id="umum">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Umum
                  <!-- <span class="right badge badge-danger">1</span> -->
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('group/dosen/') ?>" class="nav-link" id="dosen">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Dosen
                  <!-- <span class="right badge badge-danger">1</span> -->
                </p>
              </a>
            </li>
            <!-- TODO Delete later, "Layout" script (Dev-only, Admin_tools) START -->
            <li class="nav-header">ADMIN TOOLS :</li>
            <li class="nav-item">
              <a href="#" class="nav-link btn-add-posts-batch"> <!-- Toggle modal, post via AJAX -->
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Create Posts
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('admin_tools/delete_all_posts') ?>" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Delete All Posts
                </p>
              </a>
            </li>
            <!-- TODO Delete later, "Layout" script (Dev-only, Admin_tools) END -->
          </ul>
        </nav><!-- /.sidebar-menu -->
      </div><!-- /.sidebar -->
    </aside>
    <?= $this->renderSection('content') ?><!-- Content -->
    <aside class="control-sidebar control-sidebar-dark"><!-- Control Sidebar -->
      <!-- Control sidebar content goes here -->
    </aside><!-- /.control-sidebar -->
    <aside class="view-modal"></aside><!-- TODO Delete later, "Layout" script (Dev-only, Admin_tools) END -->
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
  <!-- jQuery --><script src="<?= base_url('assets/plugins/jquery/jquery.min.js') ?>"></script>
  <!-- Bootstrap --><script src="<?= base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
  <!-- AdminLTE --><script src="<?= base_url('assets/dist/js/adminlte.js') ?>"></script>
  
  <!-- SweetAlert2 --><script src="<?= base_url('assets/plugins/sweetalert2/sweetalert2.min.js') ?>"></script>
  <!-- Ekko Lightbox --><script src="<?= base_url('assets/plugins/ekko-lightbox/ekko-lightbox.min.js') ?>"></script>

  <!-- OPTIONAL SCRIPTS -->
  <!-- AdminLTE for demo purposes --><script src="<?= base_url('assets/dist/js/demo.js') ?>"></script>
  
  <!-- MY CUSTOM SCRIPTS -->    
  <script>
    $(document).ready(function() {
      //"Layout" script START
      //Decide "active sidebar" based on current page START
      let seg = (window.location.href).split('/') //Get current URL separated by "/" as segments. The seg[3] is like CI's "1st" segment
      let ele = document.getElementById(seg[4]);
      if (ele != '') {
        $(ele).addClass('active')
      }
      //Decide "active sidebar" based on current page END
      //"Layout" script END

      //TODO Delete later, "Layout" script (Dev-only, Admin_tools) START
      $(document).on("click", ".btn-add-posts-batch", function() {
        $.ajax({
          url: "<?= base_url('admin_tools/get_add_posts_modal') ?>",
          dataType: "json",
          success: function(res) {
            $(".view-modal").html(res)
            $("#post_modal_add_batch").modal("toggle")
          }
        })
      })

      $(document).on("submit", "#form-data", function(e) {
        e.preventDefault()

        $.ajax({
          url: $(this).attr("action"),
          type: $(this).attr("method"),
          data: $(this).serialize(),
          dataType: "json",
          success: function(res) {
            if (res.status) {
              $("#post_modal_add_batch").modal("toggle")
              post_list() //NOTE Using "posts" script
            } else {
              $.each(res.errors, function(key, value) {
                $('[name="' + key + '"]').addClass('is-invalid')
                $('[name="' + key + '"]').next().text(value)
                if (value == "") {
                  $('[name="' + key + '"]').removeClass('is-invalid')
                  $('[name="' + key + '"]').addClass('is-valid')
                }
              })
            }
          }
        })

        $("#form-data input").on("keyup", function() {
          $(this).removeClass('is-invalid is-valid')
        })
        $("#form-data input").on("click", function() {
          $(this).removeClass('is-invalid is-valid')
        })
        $("#form-data select").on("click", function() {
          $(this).removeClass('is-invalid is-valid')
        })
      })
      //TODO Delete later, "Layout" script (Dev-only, Admin_tools) END
    })
  </script>
  <?= $this->renderSection('script') ?>
</body>
</html>
