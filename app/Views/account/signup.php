<!DOCTYPE html>
<html lang="pt-br" dir="ltr">

<head>
    <title>DIPSI</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="<?= base_url('public/css/signup.css') ?>" />
</head>

<body>
    <div class="container">
    
        <div class="title">Pendaftaran Pengguna Baru</div>
        <div class="content">
            <?php  if (isset($errors)) { ?>
            <div class="alert">
                <ul>
                    <?php foreach ($errors as $error): ?>
                    <li><?= esc($error) ?></li>
                    <?php endforeach ?>
                </ul>
            </div>
            <?php } ?>
            <form action="<?php echo base_url('account/createaccount') ?>" method="post" enctype="multipart/form-data">
                <div class="user-details">
                    <div class="input-box">
                        <span class="details">Nama Lengkap :</span>
                        <?php if (isset($prev_input)) { ?>
                        <input type="text" name="nama_lengkap" value="<?= $prev_input['nama_lengkap']?>">
                        <?php } else { ?>
                        <input type="text" name="nama_lengkap">
                        <?php } ?>
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
                        <span class="details">Foto Profil:</span>
                        <input name="arquivo" type="file" accept=".jpg, .jpeg" >                       
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
                    <input type="radio" name="jenis_kelamin" value="m" id="dot-1" <?php if (isset($prev_input)) { if ($prev_input['jenis_kelamin'] == 'm') { ?> checked <?php } } ?>>
                    <input type="radio" name="jenis_kelamin" value="f" id="dot-2" <?php if (isset($prev_input)) { if ($prev_input['jenis_kelamin'] == 'f') { ?> checked <?php } } ?>>
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
                        <!-- <label for="dot-3">
                            <span class="dot three"></span>
                            <span class="gender">xxxxxx</span>
                        </label> -->
                    </div>
                </div>
                <div class="button">
                    <input type="submit" value="Daftar">
                </div>
            </form>
        </div>
    </div>

    <!-- <script>
        // Autor: Rodrigo Guimaraes
        // Script to validate imagem upload
        function validateForm(ev)
        {
            let input = document.querySelector('#arquivo');
            let span  = document.querySelector('#file-msg');
      
            let files             = input.files;
            let filePath          = input.value;
            let allowedExtensions = /(\.jpg|\.jpeg)$/i;

            if (!allowedExtensions.exec(filePath))
            {
                span.innerText = 'Por favor selecione arquivos de imagem .jpeg ou .jpg.';
                ev.preventDefault()
                input.value = '';
                return false;
            }

            if (files.length > 0)
            {                
                if (files[0].size > 25 * 1024) {
                    ev.preventDefault()
                    span.innerText = 'Arquivo maior que 25kb';
                    return;
                }
            } 
            span.innerText = '';
        }
        
        let form = document.querySelector('form');
        form.addEventListener('submit', function(ev)
        {
            validateForm(ev);
        });
    </script> -->

</body>

</html>