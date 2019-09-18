import Echo from "laravel-echo"
window.io = require('socket.io-client');

(async () => {

    async function fetchNotifications() {
        let res = await ajaxRequest('/fetch-notifications', 'post', '', false);
        vue.$data.notifications = res.data.data;
    }

    if (typeof io !== undefined) {
        window.Echo = new Echo({
            broadcaster: 'socket.io',
            host: window.location.hostname + ':6001',
        });
    }

    window.Echo.channel(`notification-channel.`+ Window.Laravel.user).listen('.notification', (res) => {
        console.log(res);
    });

    await fetchNotifications();
})();
