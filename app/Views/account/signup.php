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
            <!-- ZEGY OTC NEW ERROR [-->
            <?php if (!empty(session()->getFlashdata('error'))) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <h4>Periksa Entrian Form</h4>
                </hr />
                <?php echo session()->getFlashdata('error'); ?>
            </div>
            <?php endif; ?>
            <!-- ZEGY OTC NEW ERROR ]-->

            <form action="<?php echo base_url('account/createaccount') ?>" method="post" enctype="multipart/form-data">
                <div class="user-details">
                    <div class="input-box">
                        <span class="details">Nama Lengkap :</span>
                        
                        <input type="text" name="nama_lengkap" value="<?= old('nama_lengkap'); ?>">
                       
                       
                    </div>
                    <div class="input-box">
                        <span class="details">Username :</span>
                        <?php if (isset($prev_input)) { ?>
                        <input type="text" name="username" value="<?= $prev_input['username']?>">
                        <?php } else { ?>
                        <input type="text" name="username">
                        <?php } ?>
                    </div>
                    <div class="input-box">
                        <span class="details">E-mail :</span>
                        <?php if (isset($prev_input)) { ?>
                        <input type="text" name="email" value="<?= $prev_input['email']?>">
                        <?php } else { ?>
                        <input type="text" name="email">
                        <?php } ?>
                    </div>
                    <div class="input-box">
                        <span class="details">Nomor Handphone :</span>
                        <?php if (isset($prev_input)) { ?>
                        <input type="text" name="nomor_handphone" value="<?= $prev_input['nomor_handphone']?>">
                        <?php } else { ?>
                        <input type="text" name="nomor_handphone">
                        <?php } ?>
                    </div>
                    <div class="input-box">
                        <span class="details">Password :</span>
                        <?php if (isset($prev_input)) { ?>
                        <input type="password" name="password" value="<?= $prev_input['password']?>">
                        <?php } else { ?>
                        <input type="password" name="password">
                        <?php } ?>
                    </div>
                    <div class="input-box">
                        <span class="details">Konfirmasi Password :</span>
                        <?php if (isset($prev_input)) { ?>
                        <input type="password" name="konfirmasi_password" value="<?= $prev_input['konfirmasi_password']?>">
                        <?php } else { ?>
                        <input type="password" name="konfirmasi_password">
                        <?php } ?>
                    </div>
                    <div class="input-box">
                        <span class="details">Foto Profil :</span>
                        <input name="profile_img" type="file" accept=".jpg, .jpeg" >                       
                    </div>
                    <div class="input-box">
                        <span class="details">Bio :</span>
                        <?php if (isset($prev_input)) { ?>
                        <textarea name="bio" id="bio" cols="85" rows="5"><?= $prev_input['bio']?></textarea>
                        <?php } else { ?>
                        <textarea name="bio" id="bio" cols="85" rows="5"></textarea>
                        <?php } ?>
                    </div>
                </div>
                <div class="gender-details">
                    <input type="radio" name="jenis_kelamin" value="m" id="dot-1" <?php if (isset($prev_input['jenis_kelamin'])) { if ($prev_input['jenis_kelamin'] == 'm') { ?> checked <?php } } ?>>
                    <input type="radio" name="jenis_kelamin" value="f" id="dot-2" <?php if (isset($prev_input['jenis_kelamin'])) { if ($prev_input['jenis_kelamin'] == 'f') { ?> checked <?php } } ?>>
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