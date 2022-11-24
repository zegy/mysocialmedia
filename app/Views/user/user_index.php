<?= $this->extend('layout') ?>
<!-- [CONTENT] -->
<?= $this->section('content') ?> 
<div class="content-wrapper"><!-- Content Wrapper. Contains page content -->
  <section class="content-header"><!-- Content Header (Page header) -->
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <h1><b>DAFTAR PENGGUNA</b></h1>
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
              <button class="btn btn-primary btn-sm btn-add-user"><i class="fa fa-plus"></i></button>
              <div class="card-tools">
                <form id="search_user_form">
                  <div class="input-group input-group-sm" style="width: 140px; margin: 0px">
                    <input type="text" class="form-control float-right" name="input_searchuser" id="input_searchuser" placeholder="Cari Diskusi">
                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default btn-search-user">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </div><!-- /.card-header -->
            <div id="user_list_data">
              <!-- NOTE : Get data using AJAX (Replace anything inside this "user_list_data" after request) -->
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
<!-- [MODALS] : Add user -->
<form id="user_modal_add_form">
  <div class="modal fade" id="user_modal_add" tabindex="-1" role="dialog" aria-labelledby="user_modal_add_label" aria-hidden="true">
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
  function get_user_list(page, keyword) {
    $.ajax({
      url: "<?= base_url('user/list') ?>",
      dataType: "json",
      type: "post",
      data: {
        page: page,
        keyword : keyword
      },
      success: function(res) {
        if (res.status) {
          $("#user_list_data").html(res.users)
        } else {
          if (res.nomatchuser) { //NOTE : No user found on this group based on search
            $("#user_list_data").html('<div class="card-body" style="height: 355px;"><h3>Tidak ada diskusi ditemukan</h3>Silahkan coba kata kunci yang lain</div>')
          } else { //NOTE : No any user found on this group
            $("#user_list_data").html('<div class="card-body" style="height: 355px;"><h3>Belum ada diskusi di forum ini</h3>Silahkan buat diskusi perdana dari anda!</div>')
          }
        }
        $(".overlay").hide()
      }
    })
  }

  //[B] Main scripts
  $(document).ready(function() {
    // After loaded
    get_user_list()
    
    // Refresh user list based on page number (pagination)
    $(document).on("click", ".btn-pagination", function(e) {
      e.preventDefault() //NOTE : Needed because "links" from pager has "link / href"

      $(".overlay").show();
      let page = $(this).attr('id')
      get_user_list(page)
    })
    
    // Search user. NOTE (Pending) : The result is not paginated!
    $(document).on("submit", "#search_user_form", function(e) {
      e.preventDefault()
        
      let keyword = $("#search_user_form #input_searchuser").val()
      let page = ''
      if (keyword == "") {
        get_user_list()
      } else {
        get_user_list(page, keyword)
      }
    })
    
    // Create user (form modal)
    $(document).on("click", ".btn-add-user", function() {
      $("#user_modal_add").modal("toggle")
    })
    
    // Create user (form submit)
    $(document).on("submit", "#user_modal_add_form", function(e) {
      e.preventDefault()
      let formData = new FormData(this)
      $.ajax({
        url: "<?= base_url('user/save') ?>",
        type: "post",
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
        dataType: "json",
        success: function(res) {
          if (res.status) {
            $("#user_modal_add").modal("toggle")
            window.location = "<?= base_url('group') ?>" + "/" + res.group + "/detail/" + res.pid
          } else {
            $.each(res.errors, function(key, value) {
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
    })

    // Reset input valid status on click
    $("textarea").on("click", function() {
      $(this).removeClass('is-invalid is-valid')
    })

    $("input").on("click", function() {
      $(this).removeClass('is-invalid is-valid')
    })
  })
</script>
<?= $this->endSection() ?>