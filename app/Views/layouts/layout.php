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
    <!-- features-post-create -->
    <link rel="stylesheet" href="<?= base_url("/node_modules/summernote/dist/summernote-bs4.css") ?>">
    <!-- <link rel="stylesheet" href="../node_modules/selectric/public/selectric.css"> -->
    <link rel="stylesheet" href="<?= base_url("/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css") ?>">

  <!-- Template CSS -->
  <link rel="stylesheet" href="<?= base_url("/assets/css/style.css") ?>">
  <link rel="stylesheet" href="<?= base_url("/assets/css/components.css") ?>">
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
        <?= $this->renderSection('content') ?> <!-- NOTE has "<div class="main-content">" -->
      <!-- PART : Main Content ] -->

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
  <script>
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
</script>

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
<?php echo form_open('post/update') ?>
<div class="modal fade" tabindex="-1" role="dialog" id="editPostModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">UBAH DISKUSI</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <label>Detail diskusi</label> <!-- TODO change to text area -->
            <input type="text" class="form-control post_text" name="text" placeholder="">
        </div>
      </div>
      <div class="modal-footer bg-whitesmoke br">
        <input type="hidden" class="post_id" name="pid" >
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<?php echo form_close() ?> 
<!-- Modal Edit Post ] -->

<!-- Modal Delete Post [ -->
<?php echo form_open('post/delete') ?>
<div class="modal fade" tabindex="-1" role="dialog" id="deletePostModal">
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
</div>
<?php echo form_close() ?> 
<!-- Modal Delete Post ] -->

</body>
</html>
