// Import and configure the Firebase SDK
// These scripts are made available when the app is served or deployed on Firebase Hosting
// If you do not serve/host your project using Firebase Hosting see https://firebase.google.com/docs/web/setup
importScripts('https://www.gstatic.com/firebasejs/9.2.0/firebase-app-compat.js');
importScripts('https://www.gstatic.com/firebasejs/9.2.0/firebase-messaging-compat.js');





 firebase.initializeApp({
    apiKey: "AIzaSyAsQid1tNousXpv9-vJEBNvbvDiGXqUDO4",
    authDomain: "scbkemahrajawali-webpush.firebaseapp.com",
    projectId: "scbkemahrajawali-webpush",
    storageBucket: "scbkemahrajawali-webpush.appspot.com",
    messagingSenderId: "672945865843",
    appId: "1:672945865843:web:e3639d64408197093fd606",
    measurementId: "G-HZZXYNDZ5S"
 });


 const messaging = firebase.messaging();




messaging.onBackgroundMessage(function(payload) {
  console.log('[firebase-messaging-sw.js] Received background message ', payload);
  // Customize notification here
  const notificationTitle = payload.data.title;
  const notificationOptions = {
    body: payload.data.body,
    icon: payload.data.icon,
    image: payload.data.image
  };

  self.registration.showNotification(notificationTitle,
    notificationOptions);
    self.addEventListener('notificationclick', function (event){
      const clickedNotification = event.notification
      clickedNotification.close();
      event.waitUntil(
        clients.openWindow(payload.data.click_action)
      )
    })

    self.addEventListener('pushsubscriptionchange', (event) => {
      event.waitUntil(
        self.registration.pushManager.subscribe({ userVisibleOnly: true })
          .then((subscription) => {
            // Send the subscription details to your server
            // ...
          })
      );
      
    })

    self.addEventListener('install', () => {
      self.skipWaiting();
    });
    
    self.addEventListener('activate', () => {
      self.clients.claim();
    });
});