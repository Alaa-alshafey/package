/*

 Give the service worker access to Firebase Messaging.

 Note that you can only use Firebase Messaging here, other Firebase libraries are not available in the service worker.

 */

importScripts('https://www.gstatic.com/firebasejs/7.23.0/firebase-app.js');

importScripts('https://www.gstatic.com/firebasejs/7.23.0/firebase-messaging.js');



/*

 Initialize the Firebase app in the service worker by passing in the messagingSenderId.

 * New configuration for app@pulseservice.com

 */

firebase.initializeApp({

    apiKey: "AIzaSyC3zIV4wZjDmNMYZWw46bXJy4gDZQvKNec",

    authDomain: "sheariapp-dd792.firebaseapp.com",

//        databaseURL: "https://XXXX.firebaseio.com",

    projectId: "sheariapp-dd792",

    storageBucket: "sheariapp-dd792.appspot.com",

    messagingSenderId: "736172931360",

    appId: "1:736172931360:web:6314bf8ebfa4e9e5f4ff45",

    measurementId: "G-WRF6V1WRXP"

});



/*

 Retrieve an instance of Firebase Messaging so that it can handle background messages.

 */

const messaging = firebase.messaging();

messaging.setBackgroundMessageHandler(function(payload) {

    console.log(

        "[firebase-messaging-sw.js] Received background message ",

        payload

    );

    /* Customize notification here */

    const notificationTitle = "Background Message Title";

    const notificationOptions = {

        body: "Background Message body.",

        icon: "/itwonders-web-logo.png",

    };



    return self.registration.showNotification(

        notificationTitle,

        notificationOptions

    );

});