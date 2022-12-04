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
              <button class="btn btn-primary btn-sm btn-create-user"><i class="fa fa-plus"></i></button>
              <button class="btn btn-success btn-sm btn-refresh-user"><i class="fas fa-sync-alt"></i></button>
              <div class="card-tools">
                <form id="search_user_form">
                  <div class="input-group input-group-sm" style="width: 140px; margin: 0px">
                    <input type="search" class="form-control float-right" name="input_search_user" id="input_search_user" placeholder="Cari Diskusi">
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
<!-- [MODALS] : Create user -->
<form id="user_modal_create_form">
  <div class="modal fade" id="user_modal_create" tabindex="-1" role="dialog" aria-labelledby="user_modal_create_label" aria-hidden="true">
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
            <label for="user_name">user_name <i class="fas fa-exclamation-circle text-danger"></i></label>
            <input type="text" class="form-control" name="user_name" id="user_name">
            <div class="invalid-feedback"></div>
          </div>
          <div class="form-group">
            <label for="user_password">user_password <i class="fas fa-exclamation-circle text-danger"></i></label>
            <input type="password" class="form-control" name="user_password" id="user_password">
            <div class="invalid-feedback"></div>
          </div>
          <div class="form-group">
            <label for="conf_user_password">conf_user_password <i class="fas fa-exclamation-circle text-danger"></i></label>
            <input type="password" class="form-control" name="conf_user_password" id="conf_user_password">
            <div class="invalid-feedback"></div>
          </div>
          <div class="form-group">
            <label for="user_full_name">user_full_name <i class="fas fa-exclamation-circle text-danger"></i></label>
            <input type="text" class="form-control" name="user_full_name" id="user_full_name">
            <div class="invalid-feedback"></div>
          </div>
          <div class="form-group">
            <label for="user_email">user_email <i class="fas fa-exclamation-circle text-danger"></i></label>
            <input type="email" class="form-control" name="user_email" id="user_email">
            <div class="invalid-feedback"></div>
          </div>
          <div class="form-group">
            <label for="user_tel">user_tel <i class="fas fa-exclamation-circle text-danger"></i></label>
            <input type="tel" class="form-control" name="user_tel" id="user_tel"><!-- TODO : "type=tel"... Use pattern? -->
            <div class="invalid-feedback"></div>
          </div>
          <div class="form-group">
            <label for="user_sex">user_sex <i class="fas fa-exclamation-circle text-danger"></i></label>
            <select class="form-control" name="user_sex" id="user_sex">
              <option value="m">Laki-laki</option>
              <option value="f">Perempuan</option>
            </select>
            <div class="invalid-feedback"></div>
          </div>
          <div class="form-group">
            <label for="user_bio">user_bio <i class="fas fa-exclamation-circle text-danger"></i></label>
            <textarea class="form-control" name="user_bio" id="user_bio"></textarea>
            <div class="invalid-feedback"></div>
          </div>
          <div class="form-group">
            <label for="user_profile_picture">user_profile_picture <i class="fas fa-exclamation-circle text-danger"></i></label>
            <input style="height: 45px" type="file" class="form-control" name="user_profile_picture" id="user_profile_picture">
            <div class="invalid-feedback"></div>
          </div>
          <div class="form-group">
            <label for="user_role">user_role <i class="fas fa-exclamation-circle text-danger"></i></label>
            <select class="form-control" name="user_role" id="user_role">
              <option value="admin">Admin</option>
              <option value="dosen">Dosen</option>
              <option value="mahasiswa">Mahasiswa</option>
            </select>
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
  
  function get_user_list(page) {
    $.ajax({
      url: "<?= base_url('user/list_default') ?>",
      dataType: "json",
      type: "post",
      data: {
        page: page
      },
      success: function(res) {
        if (res.status) {
          $("#user_list_data").html(res.users)
        } else {
        //   NOTE : CAN'T BE EMPTY!
        //   $("#user_list_data").html('<div class="card-body" style="height: 355px;"><h3>Belum ada diskusi di forum ini</h3>Silahkan buat diskusi perdana dari anda!</div>')
        }
        $(".overlay").hide()
      }
    })
  }

  function get_user_list_search(page, keyword) {
    $.ajax({
      url: "<?= base_url('user/list_search') ?>",
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
          $("#user_list_data").html('<div class="card-body" style="height: 355px;"><h3>Tidak ada user ditemukan</h3>Silahkan coba kata kunci yang lain</div>')
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

      let keyword = $("#search_user_form #input_search_user").val()
      
      if (keyword == "") {  
        get_user_list(page)
      } else {
        get_user_list_search(page, keyword)
      }
    })
    
    // Refresh user list
    $(document).on("click", ".btn-refresh-user", function() {
      $(".overlay").show()
      $("#search_user_form #input_search_user").val('')
      get_user_list()
    })

    // Search user
    $(document).on("submit", "#search_user_form", function(e) {
      e.preventDefault()
        
      let keyword = $("#search_user_form #input_search_user").val()
      let page = 1

      if (keyword == "") {
        get_user_list()
      } else {
        get_user_list_search(page, keyword)
      }
    })
    
    // Create user (form modal)
    $(document).on("click", ".btn-create-user", function() {
      $("#user_modal_create").modal("toggle")
    })
    
    // Create user (form submit)
    $(document).on("submit", "#user_modal_create_form", function(e) {
      e.preventDefault()

      $("#user_modal_create .overlay").show()

      let formData = new FormData(this)
      $.ajax({
        url: "<?= base_url('user/create') ?>",
        type: "post",
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
        dataType: "json",
        success: function(res) {
          if (res.status) {
            $("#user_modal_create").modal("toggle")
            window.location = "<?= base_url('data/user') ?>"
          } else {
            set_errors(res.errors)
            $("#user_modal_create .overlay").hide()
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
  })
</script>
<?= $this->endSection() ?>