import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// Import the functions you need from the SDKs you need
import { initializeApp } from "firebase/app";
import { getAnalytics } from "firebase/analytics";
import { getMessaging,getToken,onMessage } from "firebase/messaging";
// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
const firebaseConfig = {
  apiKey: "AIzaSyAsQid1tNousXpv9-vJEBNvbvDiGXqUDO4",
  authDomain: "scbkemahrajawali-webpush.firebaseapp.com",
  projectId: "scbkemahrajawali-webpush",
  storageBucket: "scbkemahrajawali-webpush.appspot.com",
  messagingSenderId: "672945865843",
  appId: "1:672945865843:web:e3639d64408197093fd606",
  measurementId: "G-HZZXYNDZ5S"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const analytics = getAnalytics(app);
const messaging = getMessaging(app);
onMessage(messaging, (payload) => {
    console.log('Message received. ', payload);
    alert('Ada notifikasi baru');
  });
// VapidKey Firebase Project/Cloud Messaging/Web Push Certificates
getToken(messaging, { vapidKey: getenv('FIREBASE_VAPID_WEB_PUSH_CERTIFICATES') }).then((currentToken) => {
    if (currentToken) {
      // Send the token to your server and update the UI if necessary
      // ...
      console.log(currentToken);
      SentTokenToServer(currentToken);
    } else {
      // Show permission request UI
      requestPermission();
      console.log('No registration token available. Request permission to generate one.');
      // ...
    }
  }).catch((err) => {
    console.log('An error occurred while retrieving token. ', err);
    // ...
  });

  function requestPermission(){
// [START messaging_request_permission_modular]
Notification.requestPermission().then((permission) => {
    if (permission === 'granted') {
      console.log('Notification permission granted.');
      // TODO(developer): Retrieve a registration token for use with FCM.
      // ...
      alert('Notifikasi sudah di ijinkan.')

    } else {
        alert('Silahkan izinkan notifikasi untuk mendapatkan notifikasi terbaru dari kami.')
    }
  });
  // [END messaging_request_permission_modular]
  }

  function SentTokenToServer(token){
    var csrf = document
    .querySelector('meta[name="csrf-token"]')
    .getAttribute("content");
    let formData = new FormData();
    formData.append("token", token);
    fetch("/tokenweb", {
        headers: {
            "X-CSRF-Token":csrf,
            _method: "_POST",

        },
        method:"post",
        credentials:"same-origin",
        body: formData,
    }).then((response) => {
        console.log(response.status);
    })
  }
  const button = document.getElementById('notification-button');
button.addEventListener('click', requestPermission);