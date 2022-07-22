<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('vendor/jquery/jquery.min.js') ?>"></script>
<script src="<?= base_url('vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('vendor/jquery-easing/jquery.easing.min.js') ?>"></script>

<!-- Page level plugins -->
<script src="<?= base_url('vendor/chart.js/Chart.min.js') ?>"></script>








<!-- Page level custom scripts -->
<script src="https://www.gstatic.com/firebasejs/8.2.2/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.2.2/firebase-messaging.js"></script>

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

    fcm.onMessage((data) => {
        console.log('onMessage: ', data)

        let title = data['data']['title'];
        let body = data['data']['body'];

        Notification.requestPermission((status) => {
            console.log('requestPermission', status)
            if (status === 'granted') {

                new Notification(title, {
                    body: body
                })
            }
        })
    })

    //ajax part
    $(document).ready(function() {
        $('#btnLogin').on('click', function() {
            $('#btnLogin').attr('disabled', 'disabled')

            $.ajax({
                url: '<?= base_url('admin/doLogin') ?>',
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
</body>

</html>