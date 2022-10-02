<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Register &mdash; Stisla</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="../node_modules/selectric/public/selectric.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="../assets/css/components.css">
</head>

<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
            <div class="login-brand">
              <img src="<?php echo base_url('assets/img/stisla-fill.svg') ?>" alt="logo" width="100" class="shadow-light rounded-circle">
            </div>
            <div class="card card-primary">
              <div class="card-header"><h4>Register</h4></div>
              <div class="card-body">
                <?php $validation = \Config\Services::validation() ?>
                <?php echo form_open('account/createaccount') ?>
                <div class="row">
                  <!-- Field Nama lengkap [ -->
                  <div class="form-group col-6">
                    <label for="nama_lengkap">Nama Lengkap</label>
                    <?php if ($validation->hasError('nama_lengkap')) { ?> <!-- Has it's error -->
                        <input id="nama_lengkap" type="text" class="form-control is-invalid" name="nama_lengkap" value="<?= old('nama_lengkap') ?>">
                        <div class="invalid-feedback">
                        <?php echo $validation->getError('nama_lengkap') ?>
                        </div>
                    <?php } else if (!empty(old('nama_lengkap'))) { ?> <!-- No error, but others has -->
                        <input id="nama_lengkap" type="text" class="form-control is-valid" name="nama_lengkap" value="<?= old('nama_lengkap') ?>">
                        <div class="valid-feedback">
                        Sudah benar!
                        </div>
                    <?php } else { ?> <!-- Default -->
                        <input id="nama_lengkap" type="text" class="form-control" name="nama_lengkap">
                    <?php } ?>
                  </div>
                  <!-- Field Nama lengkap ] -->
                  <!-- Field Username [ -->
                  <div class="form-group col-6">
                    <label for="username">Username</label>
                    <?php if ($validation->hasError('username')) { ?> <!-- Has it's error -->
                        <input id="username" type="text" class="form-control is-invalid" name="username" value="<?= old('username') ?>">
                        <div class="invalid-feedback">
                        <?php echo $validation->getError('username') ?>
                        </div>
                    <?php } else if (!empty(old('username'))) { ?> <!-- No error, but others has -->
                        <input id="username" type="text" class="form-control is-valid" name="username" value="<?= old('username') ?>">
                        <div class="valid-feedback">
                        Sudah benar!
                        </div>
                    <?php } else { ?> <!-- Default -->
                        <input id="username" type="text" class="form-control" name="username">
                    <?php } ?>
                  </div>
                  <!-- Field Username ] -->
                </div>
                <!-- Field Email [ -->
                <div class="form-group">
                  <label for="email">Email</label> <!-- NOTE input type "email" changed to "text", fully rely on CI's validation -->
                  <?php if ($validation->hasError('email')) { ?> <!-- Has it's error -->
                    <input id="email" type="text" class="form-control is-invalid" name="email" value="<?= old('email') ?>">
                    <div class="invalid-feedback">
                      <?php echo $validation->getError('email') ?>
                    </div>
                  <?php } else if (!empty(old('email'))) { ?> <!-- No error, but others has -->
                    <input id="email" type="text" class="form-control is-valid" name="email" value="<?= old('email') ?>">
                    <div class="valid-feedback">
                      Sudah benar!
                    </div>
                  <?php } else { ?> <!-- Default -->
                    <input id="email" type="text" class="form-control" name="email">
                  <?php } ?>
                </div>
                <!-- Field Email ] -->
                <div class="row">
                  <!-- Field Password [ -->
                  <div class="form-group col-6">
                    <label for="password" class="d-block">Password</label>
                    <?php if ($validation->hasError('password')) { ?> <!-- Has it's error -->
                        <input id="password" type="password" class="form-control pwstrength is-invalid" data-indicator="pwindicator" name="password" value="<?= old('password') ?>">
                        <div class="invalid-feedback">
                        <?php echo $validation->getError('password') ?>
                        </div>
                    <?php } else if (!empty(old('password'))) { ?> <!-- No error, but others has -->
                        <input id="password" type="password" class="form-control pwstrength is-valid" data-indicator="pwindicator" name="password" value="<?= old('password') ?>">
                        <div class="valid-feedback">
                        Sudah benar!
                        </div>
                    <?php } else { ?> <!-- Default -->
                        <input id="password" type="password" class="form-control pwstrength" data-indicator="pwindicator" name="password">
                    <?php } ?>                    
                    <div id="pwindicator" class="pwindicator">
                      <div class="bar"></div>
                      <div class="label"></div>
                    </div>
                  </div>
                  <!-- Field Password ] -->
                  <!-- Field Konfirmasi Password [ -->
                  <div class="form-group col-6">
                    <label for="konfirmasi_password">Konfirmasi Password</label>
                    <?php if ($validation->hasError('konfirmasi_password')) { ?> <!-- Has it's error -->
                        <input id="konfirmasi_password" type="password" class="form-control is-invalid" name="konfirmasi_password" value="<?= old('konfirmasi_password') ?>">
                        <div class="invalid-feedback">
                        <?php echo $validation->getError('konfirmasi_password') ?>
                        </div>
                    <?php } else if ($validation->hasError('password')) { ?> <!-- Has error in password field so no old value or feedback given -->
                        <input id="konfirmasi_password" type="password" class="form-control" name="konfirmasi_password">
                    <?php } else if (!empty(old('konfirmasi_password'))) { ?> <!-- No error, but others has -->
                        <input id="konfirmasi_password" type="password" class="form-control is-valid" name="konfirmasi_password" value="<?= old('konfirmasi_password') ?>">
                        <div class="valid-feedback">
                        Sudah benar!
                        </div>
                    <?php } else { ?> <!-- Default -->
                        <input id="konfirmasi_password" type="password" class="form-control" name="konfirmasi_password">
                    <?php } ?>
                  </div>
                  <!-- Field Konfirmasi Password ] -->
                </div>
                <div class="row">
                  <!-- Field Jenis Kelamin [ -->
                  <div class="form-group col-6">
                    <label>Jenis Kelamin</label>
                    <select class="form-control selectric" name="jenis_kelamin">
                      <option <?php if (old('jenis_kelamin') == 'Laki-laki'){ ?> selected <?php } ?> value="L">Laki-laki</option>
                      <option <?php if (old('jenis_kelamin') == 'Perempuan'){ ?> selected <?php } ?> value="P">Perempuan</option>
                    </select>
                  </div>
                  <!-- Field Jenis Kelamin ] -->
                  <!-- Field Nomor Handphone [ -->
                  <div class="form-group col-6">
                    <label for="nomor_handphone">Nomor Handphone</label>
                    <?php if ($validation->hasError('nomor_handphone')) { ?> <!-- Has it's error -->
                        <input id="nomor_handphone" type="text" class="form-control is-invalid" name="nomor_handphone" value="<?= old('nomor_handphone') ?>">
                        <div class="invalid-feedback">
                        <?php echo $validation->getError('nomor_handphone') ?>
                        </div>
                    <?php } else if (!empty(old('nomor_handphone'))) { ?> <!-- No error, but others has -->
                        <input id="nomor_handphone" type="text" class="form-control is-valid" name="nomor_handphone" value="<?= old('nomor_handphone') ?>">
                        <div class="valid-feedback">
                        Sudah benar!
                        </div>
                    <?php } else { ?> <!-- Default -->
                        <input id="nomor_handphone" type="text" class="form-control" name="nomor_handphone">
                    <?php } ?>
                  </div>
                  <!-- Field Nomor Handphone ] -->
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-primary btn-lg btn-block">
                    Register
                  </button>
                </div>
                <?php echo form_close() ?> 
              </div>
            </div>
            <div class="simple-footer">
              Copyright &copy; Stisla 2018
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- General JS Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="../assets/js/stisla.js"></script>

  <!-- JS Libraies -->
  <script src="../node_modules/jquery-pwstrength/jquery.pwstrength.min.js"></script>
  <script src="../node_modules/selectric/public/jquery.selectric.min.js"></script>

  <!-- Template JS File -->
  <script src="../assets/js/scripts.js"></script>
  <script src="../assets/js/custom.js"></script>

  <!-- Page Specific JS File -->
  <script src="../assets/js/page/auth-register.js"></script>
</body>
</html>