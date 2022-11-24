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
                  <form class="form-horizontal"> <!-- TODO DANGER : invalid feedback! --> 
                    
                    <!-- <div class="form-group row">
                      <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputName" placeholder="Name">
                      </div>
                    </div> -->

                    <div class="form-group row">
                      <label for="user_name" class="col-sm-2 col-form-label">user_name</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="user_name" id="user_name">
                      </div>
                    </div>
                    <div class="form-group row"><!-- NOTE DANGER : Check later -->
                      <label for="user_password" class="col-sm-2 col-form-label">user_password</label>
                      <div class="col-sm-10">
                        <input type="password" class="form-control" name="user_password" id="user_password">
                      </div>
                    </div>
                    <div class="form-group row"><!-- NOTE DANGER : Check later -->
                      <label for="conf_user_password" class="col-sm-2 col-form-label">conf_user_password</label>
                      <div class="col-sm-10">
                        <input type="password" class="form-control" name="conf_user_password" id="conf_user_password">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="user_full_name" class="col-sm-2 col-form-label">user_full_name</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="user_full_name" id="user_full_name">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="user_email" class="col-sm-2 col-form-label">user_email</label>
                      <div class="col-sm-10">
                        <input type="email" class="form-control" name="user_email" id="user_email">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="user_tel" class="col-sm-2 col-form-label">user_tel</label>
                      <div class="col-sm-10">
                        <input type="tel" class="form-control" name="user_tel" id="user_tel"><!-- TODO : "type=tel"... Use pattern? -->
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="user_sex" class="col-sm-2 col-form-label">user_sex</label>
                      <div class="col-sm-10">
                        <select class="form-control" name="user_sex" id="user_sex">
                          <option value="" selected>Select</option>
                          <option value="m">Laki-laki</option>
                          <option value="f">Perempuan</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="user_bio" class="col-sm-2 col-form-label">user_bio</label>
                      <div class="col-sm-10">
                        <textarea class="form-control" name="user_bio" id="user_bio"></textarea>
                      </div>
                    </div>
                    <div class="form-group row"><!-- NOTE : Experimental! because using "Horizontal form". Need to find the file input format -->
                      <label for="user_profile_picture" class="col-sm-2 col-form-label">user_profile_picture</label>
                      <div class="col-sm-10">
                        <input style="height: 45px" type="file" class="form-control" name="user_profile_picture" id="user_profile_picture">
                      </div>
                    </div>





                    <!-- DANGER User role -->

                    

                    





                    <div class="form-group row">
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
                    </div>
                    
                    <div class="form-group row">
                      <div class="offset-sm-2 col-sm-10">
                        <div class="checkbox">
                          <label>
                            <input type="checkbox"> Terima <a href="#">Push Notification</a>
                          </label>
                        </div>
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="offset-sm-2 col-sm-10">
                        <button type="submit" class="btn btn-success">Update</button>
                      </div>
                    </div>
                    
                  </form>
                  <div class="form-group row">
                    <div class="col" >
                      <button style="margin-top: 25px" type="button" class="btn btn-danger float-right btn-sign-out">Sign Out</button>
                    </div>
                  </div>
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
  })
</script>
<?= $this->endSection() ?>