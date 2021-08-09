// Give the service worker access to Firebase Messaging.
// Note that you can only use Firebase Messaging here. Other Firebase libraries
// are not available in the service worker.importScripts('https://www.gstatic.com/firebasejs/7.23.0/firebase-app.js');
importScripts("https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js");
importScripts("https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js");

/*
Initialize the Firebase app in the service worker by passing in the messagingSenderId.
*/
firebase.initializeApp({
    apiKey: "AIzaSyD-4VrTe6S7RDHb_RtZ8mzmoqVN42O7HUA",
    authDomain: "sportworld-bee83.firebaseapp.com",
    databaseURL: "https://sportworld-bee83-default-rtdb.firebaseio.com",
    projectId: "sportworld-bee83",
    storageBucket: "sportworld-bee83.appspot.com",
    messagingSenderId: "567675053854",
    appId: "1:567675053854:web:70eb5ddf0c241a6e134b0f",
    measurementId: "G-NDGNKS0498",
});

// Retrieve an instance of Firebase Messaging so that it can handle background
// messages.
const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function (payload) {
    console.log("Message received.", payload);

    const title = "Hello world is awesome";
    const options = {
        body: "Your notificaiton message .",
        icon: "/firebase-logo.png",
    };

    return self.registration.showNotification(title, options);
});
