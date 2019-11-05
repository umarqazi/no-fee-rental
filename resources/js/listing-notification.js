"use strict";

(async () => {
    window.Echo.channel(`listing-channel.`+ Window.Laravel.user).listen('.listing', (res) => {

    });
})();
