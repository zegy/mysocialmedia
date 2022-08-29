importScripts('https://www.gstatic.com/firebasejs/7.14.6/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/7.14.6/firebase-messaging.js');

var firebaseConfig = {
    apiKey: "AIzaSyANMvOA7SPqcQId8hpngmK4f21u27Ek4Vw",
    authDomain: "dipsi-cff9a.firebaseapp.com",
    projectId: "dipsi-cff9a",
    storageBucket: "dipsi-cff9a.appspot.com",
    messagingSenderId: "1001628405578",
    appId: "1:1001628405578:web:d55f82770766eb8e3fbbb3",
    measurementId: "G-JLZZ4E4MCR"
};

firebase.initializeApp(firebaseConfig);
const messaging=firebase.messaging();

messaging.setBackgroundMessageHandler(function (payload) {
    console.log(payload);
    const notification=JSON.parse(payload);
    const notificationOption={
        body:notification.body,
        icon:notification.icon
    };
    return self.registration.showNotification(payload.notification.title,notificationOption);
});