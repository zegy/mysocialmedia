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
                    <input type="search" class="form-control float-right" name="input_searchuser" id="input_searchuser" placeholder="Cari Diskusi">
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
<form id="user_modal_add_form"><!-- TODO (Pending): Disable google chrome's auto-fill on this from (Because it's not in the right field, even with dif name). https://github.com/terrylinooo/disableautofill.js -->
  <div class="modal fade" id="user_modal_add" tabindex="-1" role="dialog" aria-labelledby="user_modal_add_label" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add new Item</h5>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="user_name">user_name</label>
            <input type="text" class="form-control" name="user_name" id="user_name">
            <div class="invalid-feedback"></div>
          </div>
          <div class="form-group">
            <label for="user_password">user_password <i class="fas fa-exclamation-circle text-danger"></i></label>
            <input type="password" class="form-control" name="user_password" id="user_password" autocomplete="new-password"> <!-- TODO : The "autocomplete="new-password" is experimental. Re-check later!. https://developer.mozilla.org/en-US/docs/Web/Security/Securing_your_site/Turning_off_form_autocompletion -->
            <div class="invalid-feedback"></div>
          </div>
          <div class="form-group">
            <label for="conf_user_password">conf_user_password <i class="fas fa-exclamation-circle text-danger"></i></label>
            <input type="password" class="form-control" name="conf_user_password" id="conf_user_password">
            <div class="invalid-feedback"></div>
          </div>
          <div class="form-group">
            <label for="user_full_name">user_full_name</i></label>
            <input type="text" class="form-control" name="user_full_name" id="user_full_name">
            <div class="invalid-feedback"></div>
          </div>
          <div class="form-group">
            <label for="user_email">user_email <i class="fas fa-exclamation-circle text-danger"></i></label>
            <input type="email" class="form-control" name="user_email" id="user_email">
            <div class="invalid-feedback"></div>
          </div>
          <div class="form-group">
            <label for="user_tel">user_tel</label>
            <input type="number" class="form-control" name="user_tel" id="user_tel">
            <div class="invalid-feedback"></div>
          </div>
          <div class="form-group">
            <label>user_sex</label>
            <select class="form-control" name="user_sex" id="user_sex">
              <option value="" selected>Select</option>
              <option value="0">Laki-laki</option>
              <option value="1">Perempuan</option>
            </select>
            <div class="invalid-feedback"></div>
          </div>
          <div class="form-group">
            <label for="user_bio">user_bio</i></label>
            <textarea class="form-control" name="user_bio" id="user_bio" rows="5"></textarea>
            <div class="invalid-feedback"></div>
          </div>
          <div class="form-group">
            <label for="profile_pic">profile_pic </label>
            <input style="height: 45px" type="file" class="form-control" name="profile_pic" id="profile_pic">
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