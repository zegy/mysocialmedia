<!DOCTYPE html>
<html lang="pt-br" dir="ltr">

<head>
    <title>DIPSI</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="<?= base_url('css/signup.css') ?>" />
</head>

<body>
    <div class="container">
        <div class="title">Pendaftaran Pengguna Baru</div>
        <div class="content">
            <!-- Show error [-->
            <!-- <?php //if (!empty(session()->getFlashdata('error'))) { ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php //echo session()->getFlashdata('error'); ?>
            </div>
            <?php //} ?> -->

            <?php $validation = \Config\Services::validation() ?>
           
            <!-- Show error ]-->
            <form action="<?php echo base_url('account/createaccount') ?>" method="post" enctype="multipart/form-data">
                <div class="user-details">
                    <div class="input-box">
                        <span class="details">Nama Lengkap :</span>
                        <input type="text" name="nama_lengkap" value="<?= old('nama_lengkap') ?>">
                    </div>
                    <div class="input-box">
                        <span class="details">Username :</span>
                        <input type="text" name="username" value="<?= old('username') ?>">
                        <?php if ($validation->hasError('username')) {
                            echo $validation->getError('username');
                        }?>
                    </div>
                    <div class="input-box">
                        <span class="details">E-mail :</span>
                        <input type="text" name="email" value="<?= old('email') ?>">
                    </div>
                    <div class="input-box">
                        <span class="details">Nomor Handphone :</span>
                        <input type="text" name="nomor_handphone" value="<?= old('nomor_handphone') ?>">
                    </div>
                    <div class="input-box">
                        <span class="details">Password :</span>
                        <input type="password" name="password" value="<?= old('password') ?>">
                    </div>
                    <div class="input-box">
                        <span class="details">Konfirmasi Password :</span>
                        <input type="password" name="konfirmasi_password" value="<?= old('konfirmasi_password') ?>">
                    </div>
                    <div class="input-box">
                        <span class="details">Foto Profil :</span>
                        <input name="profile_img" type="file" accept=".jpg, .jpeg" >
                    </div>
                    <div class="input-box">
                        <span class="details">Bio :</span>
                        <textarea name="bio" id="bio" cols="85" rows="5"><?= old('bio') ?></textarea>
                    </div>
                </div>
                <div class="gender-details">
                    <input type="radio" name="jenis_kelamin" value="m" id="dot-1" <?php if (old('jenis_kelamin') == 'm'){ ?> checked <?php } ?>>
                    <input type="radio" name="jenis_kelamin" value="f" id="dot-2" <?php if (old('jenis_kelamin') == 'f'){ ?> checked <?php } ?>>
                    <span class="gender-title">Jenis Kelamin :</span>
                    <div class="category">
                        <label for="dot-1">
                            <span class="dot one"></span>
                            <span class="gender">Laki-laki</span>
                        </label>
                        <label for="dot-2">
                            <span class="dot two"></span>
                            <span class="gender">Perempuan</span>
                        </label>
                    </div>
                </div>
                <div class="button">
                    <input type="submit" value="Daftar">
                </div>
            </form>
        </div>
    </div>
</body>

</html>