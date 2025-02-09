import Echo from 'laravel-echo';
import Pusher from 'pusher-js';
import axios from 'axios';


window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    forceTLS: true
});

// Correct userId reference
const userId = document.getElementById('user-data').dataset.userId;
window.Echo.channel('user.' + userId)
    .listen('.PostLiked', (event) => {
        console.log(event);
    });
    console.log('main.js is loaded');
