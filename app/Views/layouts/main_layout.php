<!doctype html>
<html>

<head>

  <title>My Social Media II</title>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous" />

  <link rel="stylesheet" href="<?= base_url('public/fontawesome/css/all.min.css') ?>" />
  <link rel="stylesheet" href="<?= base_url('public/css/main.css') ?>" />

  <style>
    .navbar-light .nav-item.active .nav-link,
    .navbar-light .nav-item:focus .nav-link,
    .navbar-light .nav-item:hover .nav-link {
      background-color: #eaeaea;
    }
  </style>

</head>

<body>
  <div class="fluid-container">


    <header>

      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
          <a class="navbar-brand" href="<?= base_url("/") ?>"><img src="<?php echo base_url('public/images/logoEdited3.png'); ?>" alt="logo" style="width:30px; height:30px;"></a>
          <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url('user/showprofile/' . session()->get('id')) ?>">Meu perfil <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url('login/signout') ?>">Sair</a>
            </li>
            <!-- <li class="nav-item">
            <a class="nav-link disabled" href="#">Disabled</a>
          </li> -->
          </ul>
          <form class="form-inline my-2 my-lg-0" method="post" action="<?= base_url('/search') ?>">
            <input class="form-control mr-sm-2" type="search" name="qsearch" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
          </form>
        </div>
      </nav>
    </header>



    <hr>
    <div class="container">
      <!---------------------------------------------- SEÇÃO PRINCIPAL -------------------------------------------------->

      <?= $this->renderSection('content') ?>

      <!-------------------------------------------- FIM SEÇÃO PRINCIPAL ---------------------------------------------->
      <hr>
      <div id="rodape">
        <footer>

        </footer>
      </div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
  </div> <!-- end main fluid container-->
</body>










<!-- Page level custom scripts -->
<script src="https://www.gstatic.com/firebasejs/7.14.6/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.14.6/firebase-messaging.js"></script>

<script>
    // Your web app's Firebase configuration
    // For Firebase JS SDK v7.20.0 and later, measurementId is optional
    var firebaseConfig = {
        apiKey: "AIzaSyANMvOA7SPqcQId8hpngmK4f21u27Ek4Vw",
        authDomain: "dipsi-cff9a.firebaseapp.com",
        projectId: "dipsi-cff9a",
        storageBucket: "dipsi-cff9a.appspot.com",
        messagingSenderId: "1001628405578",
        appId: "1:1001628405578:web:d55f82770766eb8e3fbbb3",
        measurementId: "G-JLZZ4E4MCR"
    };
    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);

    const fcm = firebase.messaging()
    let mToken;
    fcm.getToken({
        vapidKey: 'BPG4FHgrqyAJJmzRij4xg8qynok5tU9Rwtt8_sXNHslcLRMI9J3AUuzPhGwI864vKGrdd1Ul7C6E7XvKfyT7R80'
    }).then((token) => {
        console.log('getToken: ', token)
        mToken = token;
    });
      
    //ajax part
    $(document).ready(function() {
        $('#btnOnFCM').on('click', function() {
            $('#btnOnFCM').attr('disabled', 'disabled')

            $.ajax({
                url: '<?= base_url('notification/onFCM') ?>',
                type: 'POST',
                data: {
                    token: mToken,
                },
                success: function (res) {
                    console.log(res)
                },
                error: function (err) {

                }

            })
        })
    })
</script>

</html>