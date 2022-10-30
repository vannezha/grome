import Echo from 'laravel-echo';

import Pusher from 'pusher-js';
window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    forceTLS: false,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
});

window.Echo.channel('vannyezha_grome800000001').listen('ArduinoEvent', function(data){
    console.log(data)
})
