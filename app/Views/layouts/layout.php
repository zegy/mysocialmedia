<!DOCTYPE html>
<html lang="en">
<!-- PART : Header [ -->
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Posts &mdash; Stisla</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <!-- CSS Libraries -->
    <!-- features-posts -->
    <link rel="stylesheet" href="<?= base_url("/node_modules/selectric/public/selectric.css") ?>">
    <!-- features-post-create TODO need to check!-->
    <link rel="stylesheet" href="<?= base_url("/node_modules/summernote/dist/summernote-bs4.css") ?>">
    <!-- <link rel="stylesheet" href="../node_modules/selectric/public/selectric.css"> -->
    <link rel="stylesheet" href="<?= base_url("/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css") ?>">

  <!-- Template CSS -->
  <link rel="stylesheet" href="<?= base_url("/assets/css/style.css") ?>">
  <link rel="stylesheet" href="<?= base_url("/assets/css/components.css") ?>">

  <!-- TODO temp only! for comment page -->
  <style>
    /* 1.34 Ticket. Fixed "which ones is use for custom" */
    .tickets {
      display: flex;
    }
    .tickets .ticket-content {
      width: 100%;
    }
    .tickets .ticket-content .ticket-header {
      display: flex;
    }
    .tickets .ticket-content .ticket-header .ticket-sender-picture {
      width: 50px;
      height: 50px;
      border-radius: 3px;
      overflow: hidden;
      margin-right: 20px;
    }
    .tickets .ticket-content .ticket-header .ticket-sender-picture img { /* TODO used? most likely yes */
      width: 100%;
    }
    .tickets .ticket-content .ticket-header .ticket-detail .ticket-title h4 { /* TODO used? most likely yes */
      font-size: 18px;
      font-weight: 700;
    }
    .tickets .ticket-content .ticket-header .ticket-detail .ticket-info {
      display: flex;
      letter-spacing: 0.3px;
      font-size: 12px;
      font-weight: 500;
      color: #34395e;
    }
    .tickets .ticket-content .ticket-header .ticket-detail .ticket-info .bullet {
      margin: 0 10px;
    }
    .tickets .ticket-divider {
      height: 1px;
      width: 100%;
      display: inline-block;
      background-color: #f2f2f2;
    }
    .tickets .ticket-description {
      color: #34395e;
      font-weight: 500;
      margin-top: 30px;
      line-height: 28px;
    }
    .tickets .ticket-description p { /* TODO used? most likely yes */
      margin-bottom: 20px;
    }
    
    @media (min-width: 576px) and (max-width: 767.98px) {
      .tickets {
        display: inline-block;
      }
      .tickets .ticket-content {
        width: 100%;
      }
    }
    @media (min-width: 768px) and (max-width: 991.98px) {
      .tickets {
        flex-wrap: wrap;
        margin: 0 -15px;
      }
      .tickets .ticket-content {
        margin: 15px;
        width: 100%;
      }
    }
  </style>
</head>
<!-- PART : Header ] -->

<body>
  <div id="app">
    <div class="main-wrapper">
      <!-- PART : Navbar [ -->
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
          </ul>
          <div class="search-element">
            <!-- <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="250" data-toggle="popover" data-trigger="focus" data-content="Cari pengguna / judul diskusi / komentar" data-placement="bottom"> -->
            <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="250">

            <button class="btn" type="submit"><i class="fas fa-search"></i></button>
            <div class="search-backdrop"></div>
          </div>
        </form>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg beep"><i class="far fa-bell"></i></a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right">
              <div class="dropdown-header">Notifications
                <div class="float-right">
                  <a href="#">Mark All As Read</a>
                </div>
              </div>
              <div class="dropdown-list-content dropdown-list-icons">
                <a href="#" class="dropdown-item dropdown-item-unread">
                  <div class="dropdown-item-icon bg-primary text-white">
                    <i class="fas fa-code"></i>
                  </div>
                  <div class="dropdown-item-desc">
                    Template update is available now!
                    <div class="time text-primary">2 Min Ago</div>
                  </div>
                </a>
                <a href="#" class="dropdown-item">
                  <div class="dropdown-item-icon bg-info text-white">
                    <i class="far fa-user"></i>
                  </div>
                  <div class="dropdown-item-desc">
                    <b>You</b> and <b>Dedik Sugiharto</b> are now friends
                    <div class="time">10 Hours Ago</div>
                  </div>
                </a>
                <a href="#" class="dropdown-item">
                  <div class="dropdown-item-icon bg-success text-white">
                    <i class="fas fa-check"></i>
                  </div>
                  <div class="dropdown-item-desc">
                    <b>Kusnaedi</b> has moved task <b>Fix bug header</b> to <b>Done</b>
                    <div class="time">12 Hours Ago</div>
                  </div>
                </a>
                <a href="#" class="dropdown-item">
                  <div class="dropdown-item-icon bg-danger text-white">
                    <i class="fas fa-exclamation-triangle"></i>
                  </div>
                  <div class="dropdown-item-desc">
                    Low disk space. Let's clean it!
                    <div class="time">17 Hours Ago</div>
                  </div>
                </a>
                <a href="#" class="dropdown-item">
                  <div class="dropdown-item-icon bg-info text-white">
                    <i class="fas fa-bell"></i>
                  </div>
                  <div class="dropdown-item-desc">
                    Welcome to Stisla template!
                    <div class="time">Yesterday</div>
                  </div>
                </a>
              </div>
              <div class="dropdown-footer text-center">
                <a href="#">View All <i class="fas fa-chevron-right"></i></a>
              </div>
            </div>
          </li>
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="<?php echo base_url(session('picture'))?>" class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block">Hi, Ujang Maman</div></a>
            <div class="dropdown-menu dropdown-menu-right">
              <div class="dropdown-title">Logged in 5 min ago</div>
              <a href="features-profile.html" class="dropdown-item has-icon">
                <i class="far fa-user"></i> Profile
              </a>
              <a href="features-activities.html" class="dropdown-item has-icon">
                <i class="fas fa-bolt"></i> Activities
              </a>
              <a href="features-settings.html" class="dropdown-item has-icon">
                <i class="fas fa-cog"></i> Settings
              </a>
              <div class="dropdown-divider"></div>
              <a href="login/signout" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>
      <!-- PART : Navbar ] -->
      <!-- PART : Sidebar [ -->
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="index.html">DIPSI</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">DIPSI</a>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header">MENU</li>
            <li class="active"><a class="nav-link" href="blank.html"><i class="far fa-square"></i> <span>Forum Diskusi</span></a></li>
            <li><a class="nav-link" href="blank.html"><i class="far fa-square"></i> <span>Kelola user</span></a></li>    
          </ul>
            <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
              <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
                <i class="fas fa-question"></i> Tutorial
              </a>
            </div>
        </aside>
      </div>
      <!-- PART : Sidebar ] -->

      <!-- PART : Main Content [ -->
        <?= $this->renderSection('content') ?>

      <!-- PART : Footer [ -->
      <footer class="main-footer">
        <div class="footer-left">
          Copyright &copy; 2018 <div class="bullet"></div> Design By <a href="https://nauval.in/">Muhamad Nauval Azhar</a>
        </div>
        <div class="footer-right">
          2.3.0
        </div>
      </footer>
      <!-- PART : Footer ] -->
    </div>
  </div>

  <!-- General JS Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="<?= base_url("/assets/js/stisla.js") ?>"></script>

  <!-- JS Libraies -->
    <!-- features-posts -->
    <script src="<?= base_url("/node_modules/selectric/public/jquery.selectric.min.js") ?>"></script>
    <!-- features-post-create TODO need to check!-->
    <script src="<?= base_url("/node_modules/summernote/dist/summernote-bs4.js") ?>"></script>
    <script src="<?= base_url("/node_modules/selectric/public/jquery.selectric.min.js") ?>"></script>
    <script src="<?= base_url("/node_modules/jquery_upload_preview/assets/js/jquery.uploadPreview.min.js") ?>"></script> <!-- TODO danger here! -->
    <script src="<?= base_url("/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js") ?>"></script>

  <!-- Template JS File -->
  <script src="<?= base_url("/assets/js/scripts.js") ?>"></script>
  <script src="<?= base_url("/assets/js/custom.js") ?>"></script>

  <!-- Page Specific JS File -->
    <!-- features-posts -->
    <script src="<?= base_url("/assets/js/page/features-posts.js") ?>"></script>
    <!-- features-post-create -->
    <script src="<?= base_url("/assets/js/page/features-post-create.js") ?>"></script>

  <!-- TODO Custom (Future : move to "custom.js"-->
  <!-- <script>
    $(document).ready(function(){
        $('.edit_post').on('click',function(){ // get Edit Post
            // get data from button edit
            const id = $(this).data('id');
            const text = $(this).data('text');
            // Set data to Form Edit
            $('.post_id').val(id);
            $('.post_text').val(text);
            // Call Modal Edit
            $('#editPostModal').modal('show');
        });

        $('.delete_post').on('click',function(){ // get Delete Post
            // get data from button edit
            const id = $(this).data('id');
            // Set data to Form Edit
            $('.post_id').val(id);
            // Call Modal Delete
            $('#deletePostModal').modal('show');
        });

        // Hide element if certain element clicked
        // $('.post_bg').on('click', function(event) {
        //     // compare the element clicked (event.target) with the
        //     // element that has the click attached (this)
        //     if (event.target !== this)
        //         return;
        //     console.log('red div was clicked')
        // });

        // Add new (did not change the original) class to element
        // document.getElementById("last_name").className += " is-invalid";
    });
</script> -->

<!-- TODO TEST ONLY! -->
<!-- Hide if clicked : https://api.jquery.com/event.target-->
<!-- <script>
    function handler( event ) {
    var target = $( event.target );
    if ( target.is( "td" ) ) {
        target.children().toggle();
    }
    }
    $( "tr" ).click( handler ).find( "tr" ).hide();
</script> -->

<!-- Other junk -->
<!-- Modal Edit Post [ -->
<?php //echo form_open('post/update') ?>
<!-- <div class="modal fade" tabindex="-1" role="dialog" id="editPostModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">UBAH DISKUSI</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group"> -->
            <!-- <label>Detail diskusi</label> TODO change to text area -->
            <!-- <input type="text" class="form-control post_text" name="text" placeholder="">
        </div>
      </div>
      <div class="modal-footer bg-whitesmoke br">
        <input type="hidden" class="post_id" name="pid" >
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div> -->
<?php //echo form_close() ?> 
<!-- Modal Edit Post ] -->

<!-- Modal Delete Post [ -->
<?php //echo form_open('post/delete') ?>
<!-- <div class="modal fade" tabindex="-1" role="dialog" id="deletePostModal">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">KONFIRMASI</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <h6>Apakah anda yakin akan menghapus postingan ini?</h6>
          </div>
       </div>
        <div class="modal-footer bg-whitesmoke br">
            <input type="hidden" class="post_id" name="pid" >
            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
            <button type="submit" class="btn btn-primary">Yes</button>
        </div>
      </div>
  </div>
</div> -->
<?php //echo form_close() ?> 
<!-- Modal Delete Post ] -->

</body>
</html>
