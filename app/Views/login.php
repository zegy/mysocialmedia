<!-- NOTE : NOT USING LAYOUT -->

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>DIPSI</title>
  <!-- Google Font: Source Sans Pro --><link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome --><link rel="stylesheet" href="<?= base_url('assets/plugins/fontawesome-free/css/all.min.css') ?>">
  <!-- Theme style --><link rel="stylesheet" href="<?= base_url('assets/dist/css/adminlte.min.css') ?>">
  
  <!-- SweetAlert2 --><link rel="stylesheet" href="<?= base_url('assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') ?>">
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="card card-outline card-primary">
      <div class="card-header text-center pb-0">
        <h1 class="mb-0"><b>DIPSI</b></h1>
        <p class="login-box-msg">Diskusi Prodi Sistem Informasi</p>
      </div>
      <div class="card-body">
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
              <!-- TODO (pending) : signup + reset passsword -->
              <!-- <p class="mb-0">
                <a href="forgot-password.html">I forgot my password</a>
              </p>
              <p class="mb-0">
                <a href="" class="text-center a-signup">Register a new membership</a>
              </p> -->
            </div><!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Sign In</button>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </form>
      </div><!-- /.card-body -->
    </div><!-- /.card -->
  </div><!-- /.login-box -->

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

      // Reset input valid status on click
      $(document).on("click", "input", function() {
        $(this).removeClass('is-invalid is-valid')
      })
    })
  </script>
</body>
</html>