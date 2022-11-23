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
  <!-- [MODALS] : Add post -->
  <form id="user_signup_form">
    <div class="modal fade" id="user_signup" tabindex="-1" role="dialog" aria-labelledby="post_modal_add_label" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Add new Item</h5>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="judul">Judul <i class="fas fa-exclamation-circle text-danger"></i></label>
              <input type="text" class="form-control" name="judul" id="judul">
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
            <input type="hidden" name="group" id="group" value="">
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

        $("#user_signup").modal("toggle")
      })

      // Sign up (form submit)
      $(document).on("submit", "#user_signup_form", function(e) {
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
              $("#user_signup").modal("toggle")
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
      $("input").on("click", function() {
        $(this).removeClass('is-invalid is-valid')
      })

      $("input").on("click", function() {
        $(this).removeClass('is-invalid is-valid')
      })
    })
  </script>
</body>
</html>