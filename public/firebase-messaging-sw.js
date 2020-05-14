importScripts('https://www.gstatic.com/firebasejs/4.9.1/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/4.9.1/firebase-messaging.js');
// Your web app's Firebase configuration
var firebaseConfig = {
    apiKey: "AIzaSyBATk1HuttYgVIxRMagsd92gOGBgJVq0TU",
    authDomain: "notify-paulo.firebaseapp.com",
    databaseURL: "https://notify-paulo.firebaseio.com",
    projectId: "notify-paulo",
    storageBucket: "",
    messagingSenderId: "593106962460",
    appId: "1:593106962460:web:eacd2bbd5e3dde5e"
};
// Initialize Firebase
firebase.initializeApp(firebaseConfig);

const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function(payload) {
  console.log('[firebase-messaging-sw.js] Received background message ', payload);
  // Customize notification here
  const notificationTitle = payload.data.title;
  const notificationOptions = {
    body: payload.data.body,
  };

  return self.registration.showNotification(notificationTitle,
      notificationOptions);
});
// [END background_handler]
