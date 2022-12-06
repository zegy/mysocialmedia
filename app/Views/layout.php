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
          <a href="<?php echo base_url('user/detail/' . session('id')) ?>" class="nav-link">Profile</a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto"><!-- Right navbar links -->      
        <li class="nav-item dropdown"><!-- Messages Dropdown Menu -->
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            <span class="badge badge-danger navbar-badge notif-button"><!-- "notif_count" --></span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <div id="notif_list_data">
              <!-- NOTE : Get data using AJAX (Replace anything inside this "notif_list_data" after request) -->
            </div>
            <!-- <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Messages</a> -->
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer btn-delete-all-notif">Tandai semua telah terbaca</a>
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
            <img src="<?= base_url('resource/users/thumb' . session('picture')) ?>" class="img-circle elevation-2 user-profile-picture" alt="User Image">
          </div>
          <div class="info">
            <a href="<?php echo base_url('user/detail/' . session('id')) ?>" class="d-block text-capitalize user-full-name"><?= session('full_name') ?></a>
          </div>
        </div>
        <nav class="mt-2"><!-- Sidebar Menu -->
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->
            <!-- <li class="nav-header">FORUM DISKUSI :</li> -->
            <li class="nav-item">
              <a href="<?= base_url('group/umum/') ?>" class="nav-link" id="umum">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Daftar Diskusi Umum
                  <!-- <span class="right badge badge-danger">1</span> -->
                </p>
              </a>
            </li>
            <?php if (session('role') != 'mahasiswa') { ?>
            <li class="nav-item">
              <a href="<?= base_url('group/dosen/') ?>" class="nav-link" id="dosen">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Daftar Diskusi Dosen
                  <!-- <span class="right badge badge-danger">1</span> -->
                </p>
              </a>
            </li>
            <?php } ?>
            <!-- <li class="nav-header">DATA :</li> -->
            <li class="nav-item">
              <a href="<?= base_url('user') ?>" class="nav-link" id="user">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Daftar Pengguna
                  <!-- <span class="right badge badge-danger">1</span> -->
                </p>
              </a>
            </li>
          </ul>
        </nav><!-- /.sidebar-menu -->
      </div><!-- /.sidebar -->
    </aside>
    <?= $this->renderSection('content') ?><!-- Content -->
    <aside class="control-sidebar control-sidebar-dark"><!-- Control Sidebar -->
      <!-- Control sidebar content goes here -->
    </aside><!-- /.control-sidebar -->
    <aside id="layout-modal"></aside><!-- NOTE : Custom element for common modal called via AJAX -->
    <footer class="main-footer"><!-- Main Footer -->
      <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.2.0
      </div>
    </footer>
  </div><!-- ./wrapper -->

  <!-- ================================================ LOAD SCRIPTS ================================================ -->
  <!-- REQUIRED SCRIPTS -->
  <!-- jQuery --><script src="<?= base_url('assets/plugins/jquery/jquery.min.js') ?>"></script>
  <!-- Bootstrap --><script src="<?= base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
  <!-- AdminLTE --><script src="<?= base_url('assets/dist/js/adminlte.js') ?>"></script>
  
  <!-- SweetAlert2 --><script src="<?= base_url('assets/plugins/sweetalert2/sweetalert2.min.js') ?>"></script>
  <!-- Ekko Lightbox --><script src="<?= base_url('assets/plugins/ekko-lightbox/ekko-lightbox.min.js') ?>"></script>

  <!-- OPTIONAL SCRIPTS -->
  <!-- AdminLTE for demo purposes --><script src="<?= base_url('assets/dist/js/demo.js') ?>"></script>

  <!-- ================================================ FCM SCRIPTS ================================================ -->
  <!-- Import and configure the Firebase SDK -->
  <script src="https://www.gstatic.com/firebasejs/9.2.0/firebase-app-compat.js"></script>
  <script src="https://www.gstatic.com/firebasejs/9.2.0/firebase-messaging-compat.js"></script>
  <script>
      firebase.initializeApp({
      apiKey: "AIzaSyDUehOhRrjY60dBABjlj4jCYOGyfJHCknE",
      authDomain: "dipsi-fcm.firebaseapp.com",
      projectId: "dipsi-fcm",
      storageBucket: "dipsi-fcm.appspot.com",
      messagingSenderId: "743966764510",
      appId: "1:743966764510:web:b6d2d5efead71f2db5414f",
      measurementId: "G-DH93PHSJ6W"
    });
  </script>

<script>
    // Retrieve Firebase Messaging object.
    const messaging = firebase.messaging();
  
    // Handle incoming messages. Called when:
    // - a message is received while the app has focus
    // - the user clicks on an app notification created by a service worker
    //   `messaging.onBackgroundMessage` handler.
    messaging.onMessage((payload) => {
    //   console.log('Message received. ', payload);
      // Update the UI to include the received message.
    //   appendMessage(payload);
      get_notif_list()
    });
  </script>
  
  <!-- ================================================ MAIN SCRIPTS ================================================ -->
  <script>
    function get_notif_list() {
      $.ajax({
        url: "<?= base_url('notif/list') ?>",
        dataType: "json",
        type: "post",
        success: function(res) {
          if (res.status) {
            $("#notif_list_data").html(res.notifs)
            // alert(res.notif_count)
          } else {
            $("#notif_list_data").html('Belum ada notifikasi')
          }

          if (res.notif_count != '0') {
            $(".notif-button").text(res.notif_count)
          } else {
            $(".notif-button").text('')
          }
        }
      })
    }

    $(document).ready(function() {
      // After loaded
      get_notif_list()

      // Active sidebar
      let seg = (window.location.href).split('/') //Get current URL separated by "/" as segments. The seg[3] is like CI's "1st" segment
      let ele1 = document.getElementById(seg[3]); // 1st parameter
      let ele2 = document.getElementById(seg[4]); // 2nd parameter
      if (ele1 != '') {
        $(ele1).addClass('active')
      }
      if (ele2 != '') {
        $(ele2).addClass('active')
      }

      // Delete all notif ("tandai semua telah terbaca") (Fully using "sweetalert2")
      $(document).on("click", ".btn-delete-all-notif", function(e) {
        e.preventDefault() //NOTE : Needed because it's a link (a)!
        
        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              url: "<?= base_url('notif/delete_all') ?>",
              dataType: "json",
              type: "post",
              success: function(res) {
                Swal.fire({
                  title: 'Deleted!',
                  text: "Your file has been deleted.",
                  icon: 'success',
                  confirmButtonColor: '#3085d6',
                  confirmButtonText: 'OK'
                }).then((result) => {
                  if (result.isConfirmed) {
                    get_notif_list()
                  }
                })
              }
            })
          }
        })
      })
    })
  </script>
  <!-- Spesific page's scripts -->
  <?= $this->renderSection('script') ?>
</body>
</html>
