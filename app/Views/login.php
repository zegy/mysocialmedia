<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Log in (v2)</title>
  <!-- Google Font: Source Sans Pro --> <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome --> <link rel="stylesheet" href="<?= base_url('assets/plugins/fontawesome-free/css/all.min.css') ?>">
  <!-- Theme style --> <link rel="stylesheet" href="<?= base_url('assets/dist/css/adminlte.min.css') ?>">
  
  <!-- OTC from ajax ci4 example -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.4/sweetalert2.min.css" integrity="sha512-Ls19wNglxCDcP78k23k5MygHFHAamARZWDggNovFF3XM4nFTgJz28wBM3m76/bqxvaGWvLKwsv/toFoLqhF8Gg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="../../index2.html" class="h1"><b>Admin</b>LTE</a>
      </div>
      <div class="card-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <?= form_open('login/signin', ['id' => 'form-data']) ?>
          <div class="input-group mb-3">
            <input type="email" class="form-control" name="email" placeholder="Email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" name="password" placeholder="Password">
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
                <a href="register.html" class="text-center">Register a new membership</a>
              </p>
            </div><!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Sign In</button>
            </div><!-- /.col -->
          </div><!-- /.row -->
        <?= form_close() ?>
      </div><!-- /.card-body -->
    </div><!-- /.card -->
  </div><!-- /.login-box -->
  
  <!-- ================================================ SCRIPTS ================================================ -->
  <!-- jQuery --> <script src="<?= base_url('assets/plugins/jquery/jquery.min.js') ?>"></script>
  <!-- Bootstrap 4 --> <script src="<?= base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
  <!-- AdminLTE App --> <script src="<?= base_url('assets/dist/js/adminlte.min.js') ?>"></script>

  <!-- OTC from ajax ci4 example -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.4/sweetalert2.min.js" integrity="sha512-Lbwer45RtGISU+efaUoil1EFYFliqkKOaZhUMXG8RoZZ5fdjpK4S/2khwZynw8vyItDeaRZ+IE6XdKA6XCsyxQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <script>
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 2000,
      timerProgressBar: true,
    })

    $(document).ready(function() {
      $(document).on("submit", "#form-data", function(e) {
        e.preventDefault()

        $.ajax({
          url: $(this).attr("action"),
          type: $(this).attr("method"),
          data: $(this).serialize(),
          dataType: "json",
          success: function(res) {
            if (res.status) {
            //   $(".modal").modal("toggle")
              Toast.fire({
                icon: 'success',
                title: 'Data berhasil ditambah'
              })
              source_data()
            } else {
              $.each(res.errors, function(key, value) {
                $('[name="' + key + '"]').addClass('is-invalid')
                // $('[name="' + key + '"]').next().text(value)
                if (value == "") {
                  $('[name="' + key + '"]').removeClass('is-invalid')
                  $('[name="' + key + '"]').addClass('is-valid')
                }
              })
            }
          }
        })

        $("#form-data input").on("keyup", function() {
          $(this).removeClass('is-invalid is-valid')
        })
        $("#form-data input").on("click", function() {
          $(this).removeClass('is-invalid is-valid')
        })
        $("#form-data select").on("click", function() {
          $(this).removeClass('is-invalid is-valid')
        })
      })
    })
  </script>
</body>
</html>