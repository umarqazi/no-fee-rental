import Echo from "laravel-echo"

window.io = require('socket.io-client');

if (typeof io !== undefined) {
    window.Echo = new Echo({
        broadcaster: 'socket.io',
        host: window.location.hostname + ':6001',
    });
}

/**
 * Hide Notification alert icon
 */
const hideAlert = () => {
    $('body').find('.notification-alert').hide();
};

/**
 * Show Notification alert icon
 */
const showAlert = () => {
    $('body').find('.notification-alert').show();
};

/**
 * Whether to show null message or not
 */
const isNull = () => {
    if ($('.notiofication-content').length < 1) {
        hideAlert();
        $('.notification-inner-scroll').append('<p style="text-align: center;" id="null">No notification found</p>');
    } else {
        showAlert();
        $('body').find('#null').remove();
    }
};

$(() => {
    $("body").on('click', '.notification-listener', function () {
        $(".notification-container").toggleClass("toggle-notification");
        hideAlert();
    });

    $(".notiofication-content .fa-times").on('click', function () {
        $(this).closest('div.notiofication-content').fadeOut("slow", function () {
            $(this).remove();
        })
    });

    // Exception handler

    // Listener for new web notification
    window.Echo.channel(`notification-channel.` + Window.Laravel.user).listen('.notification', (res) => {
        pushNotification(res);
        console.log(res);
    });

    // Listener for incoming messages
    // window.Echo.channel(`messaging-channel.`+ Window.Laravel.user).listen('.message', async (res) => {
    //     let url = window.location.href;
    //     url = url.split('/');
    //     if(url[4] !== 'load-chat') {
    //         await ajaxRequest('/push-notification', 'post', res, false);
    //     }
    // });

    // Mark As Read
    $('.mark-read').on('click', async function (e) {
        let ids = [];
        $('.unread').each((index, value) => {
            ids.push($(value).attr('data-id'));
        });
        await ajaxRequest('/mark-all-as-read', 'post', {ids}, false);
        $('body').find('.unread').addClass('notification-bg-read').removeClass('unread');
    });

    // Remove a notification
    $('body').on('click', '.fa-times', async function (e) {
        let $selector = $(this).parents('div.notiofication-content');
        let id = $selector.attr('data-id');
        await ajaxRequest(`/delete-notification/${id}`, 'post', null, false);
        $selector.remove();
        isNull();
    });
});

/**
 *
 * @param data
 */
function pushNotification(data) {
    let src = (data.sender.profile_image !== null)
        ? '/storage/' + data.sender.profile_image
        : window.location.origin + '/assets/images/default-images/user.jpeg';
    $('.notification-inner-scroll').prepend(`
        <div class="notiofication-content ${(data.is_read) ? 'notification-bg-read' : 'unread'}" data-id="${data.id}">
            <img src="${src}" alt="">
            <a href="${data.url}">${data.message}</a> <i class="fas fa-times"></i>
        </div>
    `);
    isNull();
}

/**
 *
 * @returns {Promise<void>}
 */
window.onload = async function () {
    let res = await ajaxRequest('/fetch-notifications', 'post', null, false);
    res.data.forEach(collection => {
        let obj = {
            'id': collection.id,
            'is_read': collection.is_read,
            'sender': collection.from,
            'url': collection.url,
            'message': collection.message
        };
        pushNotification(obj);
    });
    isNull();
};
