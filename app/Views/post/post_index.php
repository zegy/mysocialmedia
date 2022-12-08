<?= $this->extend('layout') ?>
<!-- [CONTENT] -->
<?= $this->section('content') ?> 
<div class="content-wrapper"><!-- Content Wrapper. Contains page content -->
  <section class="content-header"><!-- Content Header (Page header) -->
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <h1><b>FORUM DISKUSI : </b><span class="text-uppercase"><?= $group ?></span></h1>
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
              <button class="btn btn-primary btn-sm btn-create-post"><i class="fa fa-plus"></i></button>
              <button class="btn btn-success btn-sm btn-refresh-post"><i class="fas fa-sync-alt"></i></button>
              <div class="card-tools">
                <form id="search_post_form">
                  <div class="input-group input-group-sm" style="width: 140px; margin: 0px">
                    <input type="search" class="form-control float-right" name="input_search_post" id="input_search_post" placeholder="Cari Diskusi">
                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default btn-search-post">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </div><!-- /.card-header -->
            <div id="post_list_data">
              <!-- NOTE : Get data using AJAX (Replace anything inside this "post_list_data" after request) -->
              <div class="card-body" style="height: 355px;"><!-- NOTE : As "empty table" so "loading" overlay animation will be at the center of the card -->
              </div><!-- /.card-body -->
            </div>
          </div><!-- /.card -->
        </div>
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<!-- [MODALS] -->
<!-- [MODALS] : Create post -->
<form id="post_modal_create_form">
  <div class="modal fade" id="post_modal_create" tabindex="-1" role="dialog" aria-labelledby="post_modal_create_label" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div style="display: none" class="overlay">
          <i class="fas fa-2x fa-sync fa-spin"></i>
        </div>
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
<?= $this->endSection() ?>

<!-- [SCRIPTS] -->
<?= $this->section('script') ?>
<script>
  //[A] Callable functions
  function set_errors(errors) {
    $.each(errors, function(key, value) {
      $('[id="' + key + '"]').addClass('is-invalid')
      $('[id="' + key + '"]').next().text(value)
      if (value == "") {
        $('[id="' + key + '"]').removeClass('is-invalid')
        $('[id="' + key + '"]').addClass('is-valid')
      }
    })
  }

  function get_post_list(page) {
    $.ajax({
      url: "<?= base_url('post/list_default') ?>",
      dataType: "json",
      type: "post",
      data: {
        group: "<?= $group ?>",
        page: page
      },
      success: function(res) {
        if (res.status) {
          $("#post_list_data").html(res.posts)
        } else {
          $("#post_list_data").html('<div class="card-body" style="height: 355px;"><h3>Belum ada diskusi di forum ini</h3>Silahkan buat diskusi perdana dari anda!</div>')
        }
        $(".overlay").hide()
      }
    })
  }

  function get_post_list_search(page, keyword) {
    $.ajax({
      url: "<?= base_url('post/list_search') ?>",
      dataType: "json",
      type: "post",
      data: {
        group: "<?= $group ?>",
        page: page,
        keyword : keyword
      },
      success: function(res) {
        if (res.status) {
          $("#post_list_data").html(res.posts)
        } else {
          $("#post_list_data").html('<div class="card-body" style="height: 355px;"><h3>Tidak ada diskusi ditemukan</h3>Silahkan coba kata kunci yang lain</div>')
        }
        $(".overlay").hide()
      }
    })
  }

  //[B] Main scripts
  $(document).ready(function() {
    // After loaded
    get_post_list()
    
    // Refresh post list based on page number (pagination)
    $(document).on("click", ".btn-pagination", function(e) {
      e.preventDefault() //NOTE : Needed because "links" from pager has "link / href"

      $(".overlay").show();
      let page = $(this).attr('id')

      let keyword = $("#search_post_form #input_search_post").val()
      
      if (keyword == "") {  
        get_post_list(page)
      } else {
        get_post_list_search(page, keyword)
      }
    })
    
    // Refresh post list
    $(document).on("click", ".btn-refresh-post", function() {
      $(".overlay").show()
      $("#search_post_form #input_search_post").val('')
      get_post_list()
    })

    // Search post
    $(document).on("submit", "#search_post_form", function(e) {
      e.preventDefault()
        
      let keyword = $("#search_post_form #input_search_post").val()
      let page = 1

      if (keyword == "") {
        get_post_list()
      } else {
        get_post_list_search(page, keyword)
      }
    })
    
    // Create post (form modal)
    $(document).on("click", ".btn-create-post", function() {
      $("#post_modal_create").modal("toggle")
    })
    
    // Create post (form submit)
    $(document).on("submit", "#post_modal_create_form", function(e) {
      e.preventDefault()

      $("#post_modal_create .overlay").show()

      let formData = new FormData(this)
      $.ajax({
        url: "<?= base_url('post/create') ?>",
        type: "post",
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
        dataType: "json",
        success: function(res) {
          if (res.status) {
            $("#post_modal_create").modal("toggle")
            window.location = "<?= base_url('group') ?>" + "/" + res.group + "/detail/" + res.pid
          } else {
            set_errors(res.errors)
            $("#post_modal_create .overlay").hide()
          }
        }
      })
    })

    // Reset input valid status on click
    $(document).on("click", "textarea", function() {
      $(this).removeClass('is-invalid is-valid')
    })

    $(document).on("click", "input", function() {
      $(this).removeClass('is-invalid is-valid')
    })

    // Reset / hide any modal overlay after modal close
    $('.modal').on('hidden.bs.modal', function () {
      $(".overlay").hide()
    })

    // Show post's user modal.
    $(document).on("click", ".table-avatar", function(e) {
      e.preventDefault()

      let uid = $(this).data('uid')
      
      $.ajax({
        url: "<?= base_url('user/sum_modal') ?>",
        dataType: "json",
        type: "post",
        data: {
          uid: uid
        },
        success: function(res) {
          if (res.status) {
            $("#layout-modal").html(res.user_sum_modal)
            $("#user_sum_modal").modal("toggle")
          }
        }
      })

    })

    // Redirect to post_detail after click post_text's area (The table's td)
    $(document).on("click", ".post_td_text", function(e) {
      e.preventDefault()
      let link = $(this).data('link')
      window.location = link
    })
  })
</script>
<?= $this->endSection() ?>