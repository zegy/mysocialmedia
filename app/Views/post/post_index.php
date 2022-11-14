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
<div class="modal fade" id="post_modal_add" tabindex="-1" role="dialog" aria-labelledby="post_modal_add_label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add new Item</h5>
      </div>
      <?= form_open('post/create', ['id' => 'post_modal_add_form']); ?>
      <div class="modal-body">
        <div class="form-group">
          <label for="judul"><i class="fas fa-exclamation-circle text-danger"></i> Judul</label>
          <input type="text" class="form-control" name="judul" id="judul">
          <div class="invalid-feedback"></div>
        </div>
        <div class="form-group">
          <label for="deskripsi"><i class="fas fa-exclamation-circle text-danger"></i> Deskripsi</label>
          <input type="text" class="form-control" name="deskripsi" id="deskripsi">
          <div class="invalid-feedback"></div>
        </div>
      </div>
      <div class="modal-footer">
        <input type="hidden" name="group" id="group" value="<?= $group ?>">
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
      <?= form_close(); ?>
    </div>
  </div>
</div>
<?= $this->endSection() ?>

<!-- SCRIPTS -->
<?= $this->section('script') ?>
<script>
  $(document).ready(function() {
    function get_post_list(page_no) {
      var page = page_no //NOTE : Optional, used in pagination
    
      $.ajax({
        url: "<?= base_url('post/list') ?>",
        dataType: "json",
        type: "post",
        data: {
          group: "<?= $group ?>",
          page: page
        },
        success: function(res) {
          if (res.status) {
            $(".post_list").html(res.posts)
          }
          $(".overlay").hide()
        }
      })
    }
    
    get_post_list()
    
    $(document).on("click", ".btn-pagination", function(e) {
      e.preventDefault()
      
      $(".overlay").show();
      let page = $(this).attr('id')
      get_post_list(page)
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
    
      $.ajax({
        url: $(this).attr("action"),
        type: $(this).attr("method"),
        data: $(this).serialize(),
        dataType: "json",
        success: function(res) {
          if (res.status) {
            $(".modal").modal("toggle")
            window.location = "<?= base_url('group') ?>" + "/" + res.group + "/detail/" + res.pid
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
    
      $("#post_modal_add_form input").on("click", function() {
        $(this).removeClass('is-invalid is-valid')
      })
      $("#post_modal_add_form select").on("click", function() {
        $(this).removeClass('is-invalid is-valid')
      })
    })
    
    // $(document).on("click", ".table-avatar", function(e) {
    //   e.preventDefault()
    
    //   const id = $(this).attr('id')
    
    //   $.ajax({
    //     url: "<?= base_url('user/user_sum_modal') ?>",
    //     dataType: "json",
    //     type: "post",
    //     data: {
    //       uid: id
    //     },
    //     success: function(res) {
    //       $(".view-modal").html(res)
    //       $(".modal").modal("toggle")
    //     }
    //   })
    // })
  })
</script>
<?= $this->endSection() ?>