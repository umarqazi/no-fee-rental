import Echo from "laravel-echo"
window.io = require('socket.io-client');
let vue = require('vue');
let notifications = null;
(async () => {

    async function fetchNotifications() {
        let res = await ajaxRequest('/fetch-notifications', 'post', '', false);
        vue.$data.notifications = res.data.data;
    }

    async function pushNotification(data) {
    }

    if (typeof io !== undefined) {
        window.Echo = new Echo({
            broadcaster: 'socket.io',
            host: window.location.hostname + ':6001',
        });
    }

    window.Echo.channel(`notification-channel.`+ Window.Laravel.user).listen('.notification', (res) => {
        let data = {
            notification: res.notification,
            path: res.path,
            image: window.origin + '/' + res.from.profile
        };
        vue.$data.notifications.unshift(data);
    });

    vue = new vue({
        el: '#notification-area',
        data: {
            notifications: null,
        },
        methods: {
            see_all: () => {
                // window.location.href = 'www.google.com';
            }
        }
    });

    await fetchNotifications();
})();
