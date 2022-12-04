<!-- NOTE : NOT USING LAYOUT -->

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Log in (v2)</title>
  <!-- Google Font: Source Sans Pro --><link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome --><link rel="stylesheet" href="<?= base_url('assets/plugins/fontawesome-free/css/all.min.css') ?>">
  <!-- Theme style --><link rel="stylesheet" href="<?= base_url('assets/dist/css/adminlte.min.css') ?>">
  
  <!-- SweetAlert2 --><link rel="stylesheet" href="<?= base_url('assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') ?>">
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="../../index2.html" class="h1"><b>Admin</b>LTE</a>
      </div>
      <div class="card-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <form id="login_form">
          <div class="input-group mb-3">
            <input type="email" class="form-control" name="email" placeholder="Email" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" name="password" placeholder="Password" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
              <p class="mb-0">
                <a href="forgot-password.html">I forgot my password</a>
              </p>
              <p class="mb-0">
                <a href="" class="text-center a-signup">Register a new membership</a> <!-- NOTE : has "href" for better view (mouse cursor). use "prevent default" on script! -->
              </p>
            </div><!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Sign In</button>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </form>
      </div><!-- /.card-body -->
    </div><!-- /.card -->
  </div><!-- /.login-box -->

  <!-- [MODALS] -->
  <!-- [MODALS] : Sign up -->
  <form id="user_mahasiswa_signup_form"><!-- TODO (Pending): Disable google chrome's auto-fill on this from (Because it's not in the right field, even with dif name). https://github.com/terrylinooo/disableautofill.js -->
    <div class="modal fade" id="user_mahasiswa_signup" tabindex="-1" role="dialog" aria-labelledby="post_modal_add_label" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Add new Item</h5>
          </div>
          <div class="modal-body">
            <!-- TODO : OTC END -->
            <div class="form-group">
              <label for="user_id_mix">user_id_mix <i class="fas fa-exclamation-circle text-danger"></i></label>
              <input type="text" class="form-control" name="user_id_mix" id="user_id_mix">
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
              <input type="number" class="form-control" name="user_tel" id="user_tel">
              <div class="invalid-feedback"></div>
            </div>
            <div class="form-group">
              <label>user_sex <i class="fas fa-exclamation-circle text-danger"></i></label>
              <select class="form-control" name="user_sex" id="user_sex">
                <option value="" selected>Select</option>
                <option value="0">Laki-laki</option>
                <option value="1">Perempuan</option>
              </select>
              <div class="invalid-feedback"></div>
            </div>
            <div class="form-group">
              <label for="user_bio">user_bio <i class="fas fa-exclamation-circle text-danger"></i></label>
              <textarea class="form-control" name="user_bio" id="user_bio" rows="5"></textarea>
              <div class="invalid-feedback"></div>
            </div>
            <div class="form-group">
              <label for="profile_pic">profile_pic </label>
              <input style="height: 45px" type="file" class="form-control" name="profile_pic" id="profile_pic">
              <div class="invalid-feedback"></div>
            </div>
            <!-- TODO : OTC END -->
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Save</button>
          </div>
        </div>
      </div>
    </div>
  </form>
  
  <!-- ================================================ LOAD SCRIPTS ================================================ -->
  <!-- jQuery --> <script src="<?= base_url('assets/plugins/jquery/jquery.min.js') ?>"></script>
  <!-- Bootstrap 4 --> <script src="<?= base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
  <!-- AdminLTE App --> <script src="<?= base_url('assets/dist/js/adminlte.min.js') ?>"></script>

  <!-- SweetAlert2 --><script src="<?= base_url('assets/plugins/sweetalert2/sweetalert2.min.js') ?>"></script>

  <!-- ================================================ MAIN SCRIPTS ================================================ -->
  <script>
    $(document).ready(function() {
      // login (form submit)
      $(document).on("submit", "#login_form", function(e) {
        e.preventDefault()

        let formData = new FormData(this)

        $.ajax({
          url: "<?= base_url('auth/signin') ?>",
          type: "post",
          data: formData,
          contentType: false,
          cache: false,
          processData: false,
          dataType: "json",
          success: function(res) {
            if (res.status) {
              window.location = "<?= base_url() ?>"
            } else {
              //TODO : Error "animation"
              $('[name="email"]').addClass('is-invalid')
              $('[name="password"]').addClass('is-invalid')
            }
          }
        })
      })

      // Sign up (form modal)
      $(document).on("click", ".a-signup", function(e) {
        e.preventDefault()

        $("#user_mahasiswa_signup").modal("toggle")
      })

      // Sign up (form submit)
      $(document).on("submit", "#user_mahasiswa_signup_form", function(e) {
        e.preventDefault()
        let formData = new FormData(this)
        $.ajax({
          url: "<?= base_url('auth/signup') ?>",
          type: "post",
          data: formData,
          contentType: false,
          cache: false,
          processData: false,
          dataType: "json",
          success: function(res) {
            if (res.status) {
              $("#user_mahasiswa_signup_form").modal("toggle")
            //   window.location = "<?= base_url('group') ?>" + "/" + res.group + "/detail/" + res.pid
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
      $(document).on("click", "input", function() {
        $(this).removeClass('is-invalid is-valid')
      })
    })
  </script>
</body>
</html>