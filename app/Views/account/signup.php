<!DOCTYPE html>
<html lang="pt-br" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title>DIPSI</title>
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        html {
            background-color: #71b7e6;
        }

        body {
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 10px;
            background: no-repeat linear-gradient(135deg, #71b7e6, #9b59b6);
        }

        .container {            
            max-width: 700px;
            width: 100%;
            min-height: 50%;
            background-color: #fff;
            padding: 5px 20px;
            border-radius: 5px;
            box-shadow: 5px 5px 10px #333;
        }

        .container .title {
            font-size: 25px;
            font-weight: 500;
            position: relative;
        }

        .container .title::before {
            content: "";
            position: absolute;
            left: 0;
            bottom: 0;
            height: 3px;
            width: 30px;
            border-radius: 5px;
            background: linear-gradient(135deg, #71b7e6, #9b59b6);
        }

        .content form .user-details {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin: 20px 0 12px 0;
        }

        form .user-details .input-box {
            margin-bottom: 15px;
            width: calc(100% / 2 - 20px);
        }

        form .input-box span.details {
            display: block;
            font-weight: 500;
            margin-bottom: 5px;
        }

        .user-details .input-box input {
            height: 45px;
            width: 100%;
            outline: none;
            font-size: 16px;
            border-radius: 5px;
            padding-left: 15px;
            border: 1px solid #ccc;
            border-bottom-width: 2px;
            transition: all 0.3s ease;
        }

        .user-details .input-box input:focus,
        .user-details .input-box input:valid {
            border-color: #9b59b6;
        }

        form .gender-details .gender-title {
            font-size: 20px;
            font-weight: 500;
        }

        form .category {
            display: flex;
            width: 80%;
            margin: 14px 0;
            justify-content: space-between;
        }

        form .category label {
            display: flex;
            align-items: center;
            cursor: pointer;
        }

        form .category label .dot {
            height: 18px;
            width: 18px;
            border-radius: 50%;
            margin-right: 10px;
            background: #d9d9d9;
            border: 5px solid transparent;
            transition: all 0.3s ease;
        }

        #dot-1:checked~.category label .one,
        #dot-2:checked~.category label .two,
        #dot-3:checked~.category label .three {
            
            background: #9b59b6;
            border-color: #d9d9d9;
        }

        form input[type="radio"] {
            display: none;
        }

        form .button {
            height: 45px;
            margin: 35px 0;
        }

        form .button input {

            height: 100%;
            width: 100%;
            border-radius: 5px;
            border: none;
            color: #fff;
            font-size: 18px;
            font-weight: 500;
            letter-spacing: 1px;
            cursor: pointer;
            transition: all 0.3s ease;
            background: linear-gradient(135deg, #71b7e6, #9b59b6);

        }

        form .button input:hover {
            background: linear-gradient(-135deg, #71b7e6, #9b59b6);
        }

        .alert {
            margin-left: 10%;
            width: 80%;
            background-color: rgba(255, 51, 51,0.8);
            border-radius: 5px;
            padding: 10px;

        }

        .alert ul {
            list-style: none;
        }

         #bio {
            width: 100%;
          
            
        } 

        @media(max-width: 584px) {
            .container {
                max-width: 100%;
            }

            form .user-details .input-box {
                margin-bottom: 15px;
                width: 100%;
            }

            form .category {
                width: 100%;
            }

            .content form .user-details {
                max-height: 300px;
                overflow-y: scroll;
            }

            .user-details::-webkit-scrollbar {
                width: 5px;
            }
        }

        @media(max-width: 459px) {
            .container .content .category {
                flex-direction: column;
            }
        }
    </style>

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
            
            <form action="<?php echo site_url('account/createaccount') ?>" method="post" enctype="multipart/form-data">
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
        function validateForm(ev) {
  
            let input = document.querySelector('#arquivo');
            let span  = document.querySelector('#file-msg');
      
            let files             = input.files;
            let filePath          = input.value;
            let allowedExtensions = /(\.jpg|\.jpeg)$/i;

            if (!allowedExtensions.exec(filePath)) {

                span.innerText = 'Por favor selecione arquivos de imagem .jpeg ou .jpg.';
                ev.preventDefault()
                input.value = '';
                return false;

            }

            if (files.length > 0) {
                
                if (files[0].size > 25 * 1024) {
                    ev.preventDefault()
                    span.innerText = 'Arquivo maior que 25kb';
                    return;
                }
            } 
            span.innerText = '';
        }
        
        let form = document.querySelector('form');
        form.addEventListener('submit', function(ev) {

            validateForm(ev);

        });
    </script>

</body>

</html>