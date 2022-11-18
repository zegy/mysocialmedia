<?= $this->extend('layout') ?>
<!-- CONTENT -->
<?= $this->section('content') ?> 
<div class="content-wrapper"><!-- Content Wrapper. Contains page content -->
  <section class="content-header"><!-- Content Header (Page header) -->
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-9">
          <h1>Simple Tables</h1>
        </div>
        <div class="col-sm-3">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Simple Tables</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <section class="content"><!-- Main content -->
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="overlay">
              <i class="fas fa-2x fa-sync fa-spin"></i>
            </div>
            <div class="card-header">
              <button class="btn btn-primary btn-sm btn-add-post"><i class="fa fa-plus"></i></button>
              <button class="btn btn-success btn-sm btn-refresh-post"><i class="fas fa-sync-alt"></i></button>
              <button class="btn btn-secondary btn-sm btn-refresh-post"><i class="fas fa-bars"></i></button>
              <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 140px; margin: 0px">
                  <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                  <div class="input-group-append">
                    <button type="submit" class="btn btn-default">
                      <i class="fas fa-search"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div><!-- /.card-header -->
            <div class="post_list"><!-- NOTE : Get data using AJAX -->
              <div class="card-body" style="height: 355px;"><!-- NOTE : act as "empty table" so "loading" overlay animation will be at the center of the card. This element will replaced with the one from the "source" -->
                <h3>Belum ada diskusi di forum ini</h3>
                Silahkan buat diskusi perdana dari anda!
              </div><!-- /.card-body -->
            </div>
          </div><!-- /.card -->
        </div>
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<!-- MODALS -->
<form id="post_modal_add_form">
  <div class="modal fade" id="post_modal_add" tabindex="-1" role="dialog" aria-labelledby="post_modal_add_label" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add new Item</h5>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="judul">Judul <i class="fas fa-exclamation-circle text-danger"></i></label>
            <textarea class="form-control" name="judul" id="judul" rows="2"></textarea>
            <div class="invalid-feedback"></div>
          </div>
          <div class="form-group">
            <label for="deskripsi">Deskripsi <i class="fas fa-exclamation-circle text-danger"></i></label>
            <textarea class="form-control" name="deskripsi" id="deskripsi" rows="5"></textarea>
            <div class="invalid-feedback"></div>
          </div>
          <div class="form-group">
            <label for="images">File</label>
            <input style="height: 45px" type="file" class="form-control" name="images[]" id="images" multiple>
            <div class="invalid-feedback"></div>
          </div>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="group" id="group" value="<?= $group ?>">
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </div>
    </div>
  </div>
</form>

<div class="modal fade" id="user_sum_modal" tabindex="-1" role="dialog" aria-labelledby="user_sum_modal_label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="card bg-light d-flex flex-fill">
          <div class="card-header text-muted border-bottom-0">
            Digital Strategist
          </div>
          <div class="card-body pt-0">
            <div class="row">
              <div class="col-7">
                <h2 class="lead"><b>Nicole Pearson</b></h2>
                <p class="text-muted text-sm"><b>About: </b> Web Designer / UX / Graphic Artist / Coffee Lover </p>
                <ul class="ml-4 mb-0 fa-ul text-muted">
                  <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Address: Demo Street 123, Demo City 04312, NJ</li>
                  <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone #: + 800 - 12 12 23 52</li>
                </ul>
              </div>
              <div class="col-5 text-center">
                <img src="<?= base_url('assets/dist/img/user1-128x128.jpg') ?>" alt="user-avatar" class="img-circle img-fluid">
              </div>
            </div>
          </div>
          <div class="card-footer">
            <div class="text-right">
              <a href="#" class="btn btn-sm bg-teal">
                <i class="fas fa-comments"></i>
              </a>
              <a href="#" class="btn btn-sm btn-primary">
                <i class="fas fa-user"></i> View Profile
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection() ?>

<!-- SCRIPTS -->
<?= $this->section('script') ?>
<script>
  // Callable functions
  function get_post_list(page_no) {
    $.ajax({
      url: "<?= base_url('post/list') ?>",
      dataType: "json",
      type: "post",
      data: {
        group: "<?= $group ?>",
        page: page_no
      },
      success: function(res) {
        if (res.status) {
          $(".post_list").html(res.posts)
        }
        $(".overlay").hide()
      }
    })
  }

  // Main script (jQuery)
  $(document).ready(function() {
    get_post_list()
    
    $(document).on("click", ".btn-pagination", function(e) {
      e.preventDefault()
      $(".overlay").show();
      let page_no = $(this).attr('id')
      get_post_list(page_no)
    })
    
    $(document).on("click", ".btn-refresh-post", function() {
      $(".overlay").show()
      get_post_list()
    })
    
    $(document).on("click", ".btn-add-post", function() { //NOTE : Using custom modal, semi using "sweetalert2" (Because it's multiple inputs method is not flexible)
      $("#post_modal_add").modal("toggle")
    })
    
    $(document).on("submit", "#post_modal_add_form", function(e) {
      e.preventDefault()
      let formData = new FormData(this);
      $.ajax({
        url: "<?= base_url('post/save') ?>",
        type: "post",
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
        dataType: "json",
        success: function(res) {
          if (res.status) {
            $(".modal").modal("toggle")
            window.location = "<?= base_url('group') ?>" + "/" + res.group + "/detail/" + res.pid
          } else {
            $.each(res.errors, function(key, value) { //TODO (pending) : The image upload is optional, "valid status" is not needed if there is no image upload. 
              $('[id="' + key + '"]').addClass('is-invalid')
              $('[id="' + key + '"]').next().text(value)
              if (value == "") {
                $('[id="' + key + '"]').removeClass('is-invalid')
                $('[id="' + key + '"]').addClass('is-valid')
              }
            })
          }
        }
      })
    
      $("#post_modal_add_form textarea").on("click", function() {
        $(this).removeClass('is-invalid is-valid')
      })

      $("#post_modal_add_form input").on("click", function() {
        $(this).removeClass('is-invalid is-valid')
      })
    })
    
    $(document).on("click", ".table-avatar", function(e) {
      e.preventDefault()
      //NOTE : Using "data()" so no need to request the same data again (from post_list)
      let id = $(this).data('id')
      let ufn = $(this).data('user_full_name')
      let role = $(this).data('user_role')
      $("#user_sum_modal .lead").html('<b>'+ ufn + '</b>')
      $("#user_sum_modal .card-header").text(role)
      $("#user_sum_modal").modal("toggle")
    })
  })
</script>
<?= $this->endSection() ?>