import Echo from "laravel-echo"
window.io = require('socket.io-client');
// Have this in case you stop running your laravel echo server
if (typeof io !== 'undefined') {
    window.Echo = new Echo({
        broadcaster: 'socket.io',
        host: window.location.hostname + ':6001',
    });
}

window.Echo.channel(`notification-channel.`+ Window.Laravel.user)
    .listen('.notification', (e) => {
        console.log(e);
    });
