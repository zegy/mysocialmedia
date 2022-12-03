<?= $this->extend('layout') ?>
<!-- [CONTENT] -->
<?= $this->section('content') ?> 
<div class="content-wrapper"><!-- Content Wrapper. Contains page content -->
  <section class="content-header"><!-- Content Header (Page header) -->
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <h1><b>PROFIL</b></h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <section class="content"><!-- Main content -->
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-3">
          <div class="card card-primary card-outline"><!-- Profile Image -->
            <div class="card-body box-profile">
              <div class="text-center">
                <img class="profile-user-img img-fluid img-circle" src="<?= base_url('resource/users/thumb' . $user->user_profile_picture) ?>" alt="User profile picture">
              </div>
              <h3 class="text-center text-capitalize profile-username"><?= $user->user_full_name ?></h3>
              <p class="text-muted text-center text-uppercase profile-role"><?= $user->user_role ?></p>
            </div><!-- /.card-body -->
          </div><!-- /.card -->
        </div><!-- /.col -->
        <div class="col-md-9">
          <div class="card">
            <div style="display: none" class="overlay">
              <i class="fas fa-2x fa-sync fa-spin"></i>
            </div>
            <div class="card-header p-2">
              <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link active" href="#informasi" data-toggle="tab">Informasi</a></li>
                <li class="nav-item"><a class="nav-link" href="#diskusi" data-toggle="tab">Daftar Diskusi</a></li>
              </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
              <div class="tab-content">
                <div class="active tab-pane" id="informasi">
                  <form class="form-horizontal" id="user_update_form">
                    <div class="form-group row">
                      <label for="user_name" class="col-sm-2 col-form-label">user_name</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="user_name" id="user_name" value="<?= $user->user_name ?>">
                        <div class="invalid-feedback"></div>
                      </div>
                    </div>
                    <?php if (session('id') == $user->user_pk || session('role') == 'admin') { ?>
                    <div class="form-group row">
                      <label for="user_password" class="col-sm-2 col-form-label">user_password</label>
                      <div class="col-sm-10">
                        <input type="password" class="form-control" name="user_password" id="user_password"> <!-- NOTE : PHP's password_hash() is one-way hashing algorithm. Hence can't decrypt it -->
                        <div class="invalid-feedback"></div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="conf_user_password" class="col-sm-2 col-form-label">conf_user_password</label>
                      <div class="col-sm-10">
                        <input type="password" class="form-control" name="conf_user_password" id="conf_user_password"> <!-- NOTE : PHP's password_hash() is one-way hashing algorithm. Hence can't decrypt it -->
                        <div class="invalid-feedback"></div>
                      </div>
                    </div>
                    <?php } ?>
                    <div class="form-group row">
                      <label for="user_full_name" class="col-sm-2 col-form-label">user_full_name</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="user_full_name" id="user_full_name" value="<?= $user->user_full_name ?>">
                        <div class="invalid-feedback"></div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="user_email" class="col-sm-2 col-form-label">user_email</label>
                      <div class="col-sm-10">
                        <input type="email" class="form-control" name="user_email" id="user_email" value="<?= $user->user_email ?>" <?php if (session('role') != 'admin') { ?> readonly <?php } ?>>
                        <div class="invalid-feedback"></div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="user_tel" class="col-sm-2 col-form-label">user_tel</label>
                      <div class="col-sm-10">
                        <input type="tel" class="form-control" name="user_tel" id="user_tel" value="<?= $user->user_tel ?>"><!-- TODO : "type=tel"... Use pattern? -->
                        <div class="invalid-feedback"></div> 
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="user_sex" class="col-sm-2 col-form-label">user_sex</label>
                      <div class="col-sm-10">
                        <select class="form-control" name="user_sex" id="user_sex">
                          <option value="m">Laki-laki</option>
                          <option value="f">Perempuan</option>
                        </select>
                        <div class="invalid-feedback"></div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="user_bio" class="col-sm-2 col-form-label">user_bio</label>
                      <div class="col-sm-10">
                        <textarea class="form-control" name="user_bio" id="user_bio"><?= $user->user_bio ?></textarea>
                        <div class="invalid-feedback"></div>
                      </div>
                    </div>
                    <div style="display: none" class="form-group row" id="image_input"><!-- NOTE : Experimental! because using "Horizontal form". Need to find the file input format -->
                      <label for="user_profile_picture" class="col-sm-2 col-form-label">user_profile_picture</label>
                      <div class="col-sm-10">
                        <input style="height: 45px" type="file" class="form-control" name="user_profile_picture" id="user_profile_picture">
                        <div class="invalid-feedback"></div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="offset-sm-2 col-sm-10">
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" name="cb_update_image" id="cb_update_image"> Hapus / Ganti Foto
                          </label>
                        </div>
                      </div>
                    </div>
                    <?php if (session('role') == 'admin') { ?>
                    <div class="form-group row">
                      <label for="user_role" class="col-sm-2 col-form-label">user_role</label>
                      <div class="col-sm-10">
                        <select class="form-control" name="user_role" id="user_role"> <!-- TODO : There is dedicated class for "select". Check later! -->
                          <option value="admin">Admin</option>
                          <option value="dosen">Dosen</option>
                          <option value="mahasiswa">Mahasiswa</option>
                        </select>
                        <div class="invalid-feedback"></div>
                      </div>
                    </div>
                    <?php } else { ?>
                    <input type="hidden" name="user_role" id="user_role" value="<?= $user->user_role ?>"> <!-- Needed for update element on update user -->
                    <?php } ?>
                    <?php if (session('id') == $user->user_pk) { ?>
                    <div class="form-group row">
                      <div class="offset-sm-2 col-sm-10">
                        <div class="checkbox">
                          <label>
                            <input type="checkbox"> Terima <a href="#">Push Notification</a>
                          </label>
                        </div>
                      </div>
                    </div>
                    <?php } ?>
                    <?php if (session('id') == $user->user_pk || session('role') == 'admin') { ?>
                    <div class="form-group row">
                      <div class="offset-sm-2 col-sm-10">
                        <input type="hidden" name="uid" id="uid" value="<?= $user->user_pk ?>">
                        <?php if (session('role') == 'admin') { ?>
                        <button type="button" class="btn btn-danger btn-delete-user" data-uid="<?= $user->user_pk ?>">Delete</button>
                        <?php } ?>
                        <button type="submit" class="btn btn-success">Update</button>
                      </div>
                    </div>
                    <?php } ?>
                  </form>
                  <?php if (session('id') == $user->user_pk) { ?>
                  <button style="margin-top: 25px" type="button" class="btn btn-danger float-right btn-sign-out">Sign Out</button>
                  <?php } ?>
                </div><!-- /.tab-pane -->
                <div class="tab-pane" id="diskusi">
                  <div id="post_list_data">
                    <!-- NOTE : Get data using AJAX (Replace anything inside this "post_list_data" after request) -->
                  </div>
                </div><!-- /.tab-pane -->
              </div><!-- /.tab-content -->
            </div><!-- /.card-body -->
          </div><!-- /.card -->
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </section><!-- /.content -->
</div><!-- /.content-wrapper -->
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

  function get_post_list_from_user() {
    $.ajax({
      url: "<?= base_url('post/list_from_user') ?>",
      dataType: "json",
      type: "post",
      data: {
        user: "<?= $user->user_pk ?>"
      },
      success: function(res) {
        if (res.status) {
          $("#post_list_data").html(res.posts)
        } else {
          $("#post_list_data").html('<div class="card-body" style="height: 355px;"><h3>Pengguna belum pernah membuat diskusi!</h3></div>')
        }
      }
    })
  }
  
  //[B] Main scripts
  $(document).ready(function() {
    // After loaded
    get_post_list_from_user()
    // TODO : better method! because rn is selected="selected". What about prop?
    $('#user_sex option[value=<?= $user->user_sex ?>]').attr('selected','selected'); // Set "selected" values for user_sex
    $('#user_role option[value=<?= $user->user_role ?>]').attr('selected','selected'); // Set "selected" values user_role


    // Redirect to post_detail after click post_text's area (The table's td)
    $(document).on("click", ".post_td_text", function(e) {
      e.preventDefault()
      let link = $(this).data('link')
      window.location = link
    })

    // Sign out
    $(document).on("click", ".btn-sign-out", function(e) {
      e.preventDefault()

      window.location = "<?php echo base_url('auth/signout') ?>"
    })

    // Update user (form submit)
    $(document).on("submit", "#user_update_form", function(e) {
      e.preventDefault()

      $(".overlay").show()

      let formData = new FormData(this)
      $.ajax({
        url: "<?= base_url('user/update') ?>",
        type: "post",
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
        dataType: "json",
        success: function(res) {
          if (res.status) {
            $(".overlay").hide()
            
            // Update other related elements (The form is set-as-is, no need to update)
            $(".user-panel .user-full-name").text(formData.get('user_full_name'))
            $(".profile-username").text(formData.get('user_full_name'))
            $(".profile-role").text(formData.get('user_role'))
            if (res.image_change) {
              $(".user-panel .user-profile-picture").attr('src', "<?= base_url('resource')  . '/users' . '/thumb' ?>" + res.image)
              $(".profile-user-img").attr('src', "<?= base_url('resource')  . '/users' . '/thumb' ?>" + res.image)
            }

            // Reset prev validation
            $("#user_update_form textarea").removeClass('is-invalid is-valid')
            $("#user_update_form input").removeClass('is-invalid is-valid')
            $("#user_update_form select").removeClass('is-invalid is-valid')
          } else {
            $(".overlay").hide()

            set_errors(res.errors)
            if (typeof res.custom_error !== 'undefined') {
                alert(res.custom_error)
            }
          }
        }
      })
    })

    // Show or hide image_input (On user update)
    $("#cb_update_image").on("click", function() {
      $("#image_input").toggle();
    })

    // Delete User (Fully using "sweetalert2")
    $(document).on("click", ".btn-delete-user", function() {
      let uid = $(this).data("uid")

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
            url: "<?= base_url('user/delete') ?>",
            dataType: "json",
            type: "post",
            data: {
              uid: uid,
            },
            success: function(res) {
                if (res.status) {
                  Swal.fire({
                    title: 'Deleted!',
                    text: "Your file has been deleted.",
                    icon: 'success',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                  }).then((result) => {
                    if (result.isConfirmed) {
                    window.location = "<?= base_url('data/user') ?>"
                    }
                  })
                } else {
                    alert('error') //TODO
                }
            }
          })
        }
      })
    })
  })
</script>
<?= $this->endSection() ?>