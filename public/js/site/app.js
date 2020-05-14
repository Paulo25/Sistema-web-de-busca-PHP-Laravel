$(document).ready(function (e) {




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

// Retrieve Firebase Messaging object.
    const messaging = firebase.messaging();
    messaging.requestPermission()
        .then(function() {
            console.log('Notification permission granted.');
            // TODO(developer): Retrieve an Instance ID token for use with FCM.
            if(isTokenSentToServer()) {
                console.log('Token already saved.');
            } else {
                getRegToken();
            }
        })
        .catch(function(err) {
            console.log('Unable to get permission to notify.', err);
        });

    function getRegToken(argument) {
        messaging.getToken()
            .then(function(currentToken) {
                if (currentToken) {
                    saveToken(currentToken);
                    //console.log(currentToken);
                    setTokenSentToServer(true);
                } else {
                    console.log('No Instance ID token available. Request permission to generate one.');
                    setTokenSentToServer(false);
                }
            })
            .catch(function(err) {
                console.log('An error occurred while retrieving token. ', err);
                setTokenSentToServer(false);
            });
    }
    function setTokenSentToServer(sent) {
        window.localStorage.setItem('sentToServer', sent ? 1 : 0);
    }
    function isTokenSentToServer() {
        return window.localStorage.getItem('sentToServer') == 1;
    }
    function saveToken(currentToken) {
        $.ajax({
            url: '/saveToken',
            method: 'post',
            data: 'token=' + currentToken,
            beforeSend: function(xhr) {
                xhr.setRequestHeader("X-CSRF-TOKEN", "CaZ4ucclyGcBws24hASJWV8YRNXd5OyNEky1dKsj");
            },
        }).done(function(result){
            console.log(result);
        });
    }
    messaging.onMessage(function(payload) {
        //console.log("Message received. ", payload);
        notificationTitle = payload.data.title;
        notificationOptions = {
            body: payload.data.body,
        };
        var notification = new Notification(notificationTitle,notificationOptions);
    });
});
