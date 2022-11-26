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
                <img class="profile-user-img img-fluid img-circle" src="<?= base_url('assets/dist/img/user4-128x128.jpg') ?>" alt="User profile picture">
              </div>
              <h3 class="profile-username text-center"><?= $user->user_full_name ?></h3>
              <p class="text-muted text-center text-uppercase"><?= $user->user_role ?></p>
            </div><!-- /.card-body -->
          </div><!-- /.card -->
        </div><!-- /.col -->
        <div class="col-md-9">
          <div class="card">
            <div class="card-header p-2">
              <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link active" href="#informasi" data-toggle="tab">Informasi</a></li>
                <li class="nav-item"><a class="nav-link" href="#diskusi" data-toggle="tab">Daftar Diskusi</a></li>
              </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
              <div class="tab-content">
                <div class="active tab-pane" id="informasi">
                  <form class="form-horizontal" id="user_edit_form">
                    
                    <!-- <div class="form-group row">
                      <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputName" placeholder="Name">
                      </div>
                    </div> -->

                    <div class="form-group row">
                      <label for="user_name" class="col-sm-2 col-form-label">user_name</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="user_name" id="user_name" value="<?= $user->user_name ?>">
                        <div class="invalid-feedback"></div>
                      </div>
                    </div>
                    <?php if ($editable) { ?>
                    <div class="form-group row"><!-- NOTE DANGER : Check later -->
                      <label for="user_password" class="col-sm-2 col-form-label">user_password</label>
                      <div class="col-sm-10">
                        <input type="password" class="form-control" name="user_password" id="user_password" placeholder="*******"> <!-- NOTE : PHP's password_hash() is one-way hashing algorithm. Hence can't decrypt it -->
                        <div class="invalid-feedback"></div>
                      </div>
                    </div>
                    <div class="form-group row"><!-- NOTE DANGER : Check later -->
                      <label for="conf_user_password" class="col-sm-2 col-form-label">conf_user_password</label>
                      <div class="col-sm-10">
                        <input type="password" class="form-control" name="conf_user_password" id="conf_user_password" placeholder="*******"> <!-- NOTE : PHP's password_hash() is one-way hashing algorithm. Hence can't decrypt it -->
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
                        <input type="email" class="form-control" name="user_email" id="user_email" value="<?= $user->user_email ?>">
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
                    <div class="form-group row"><!-- NOTE : Experimental! because using "Horizontal form". Need to find the file input format -->
                      <label for="user_profile_picture" class="col-sm-2 col-form-label">user_profile_picture</label>
                      <div class="col-sm-10">
                        <input style="height: 45px" type="file" class="form-control" name="user_profile_picture" id="user_profile_picture">
                        <div class="invalid-feedback"></div>
                      </div>
                    </div>

                    <?php if ($editable && session('role') == 'admin') { ?>
                    <div class="form-group row"><!-- DANGER User role -->
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
                    <?php } ?>

                    <!-- <div class="form-group row">
                      <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                      <div class="col-sm-10">
                        <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="inputExperience" class="col-sm-2 col-form-label">Experience</label>
                      <div class="col-sm-10">
                        <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                      </div>
                    </div> -->
                    <?php if ($editable && session('id') == $user->user_pk) { ?>
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

                    <?php if ($editable) { ?>
                    <div class="form-group row">
                      <div class="offset-sm-2 col-sm-10">
                        <input type="hidden" name="uid" id="uid" value="<?= $user->user_pk ?>">
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
    $(document).on("submit", "#user_edit_form", function(e) {
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
            // $("#user_modal_add").modal("toggle")
            // window.location = "base url'group'" + "/" + res.group + "/detail/" + res.pid
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
  })
</script>
<?= $this->endSection() ?>