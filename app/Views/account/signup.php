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
                        <input type="text" name="nome" placeholder="" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Username :</span>
                        <input type="text" name="username" placeholder="" required>
                    </div>
                    <div class="input-box">
                        <span class="details">E-mail :</span>
                        <input type="text" name="email" placeholder="" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Nomor telepon (Optional) :</span>
                        <input type="text" name="phone" placeholder="" >
                    </div>
                    <div class="input-box">
                        <span class="details">Password :</span>
                        <input type="password" name="password" placeholder="" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Konfirmasi Password :</span>
                        <input type="password"  name="passconf" placeholder="" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Foto Profil:</span>
                        <input name="arquivo" id="arquivo" type="file" accept=".jpg, .jpeg" required>
                        <span id="file-msg" style="color:red"></span>
                       
                    </div>
                    <div class="input-box">
                    <span class="details">Bio :</span>
                        <textarea name="bio" id="bio" cols="85" rows="5"></textarea>
                    </div>
                </div>
                <div class="gender-details">
                    <input type="radio" name="gender" value="m" id="dot-1">
                    <input type="radio" name="gender" value="f" id="dot-2">
                    <input type="radio" name="gender" value="null" id="dot-3">
                    <span class="gender-title">Jenis Kelamin:</span>
                    <div class="category">
                        <label for="dot-1">
                            <span class="dot one"></span>
                            <span class="gender">Laki-laki</span>
                        </label>
                        <label for="dot-2">
                            <span class="dot two"></span>
                            <span class="gender">Perempuan</span>
                        </label>
                        <label for="dot-3">
                            <span class="dot three"></span>
                            <span class="gender">xxxxxx</span>
                        </label>
                    </div>
                </div>
                <div class="button">
                    <input type="submit" value="Daftar">
                </div>
            </form>
        </div>
    </div>

    <script>
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
    </script>

</body>

</html>