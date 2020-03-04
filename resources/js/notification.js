"use strict";

let currentUser = Window.Laravel.user;

/**
 * Hide Notification alert icon
 */
const hideAlert = () => {
    $('body').find('.notification-alert').hide();
};

/**
 *
 * @param data
 */
const pushNotification = (data) => {
    $('.notification-inner-scroll').prepend(`
        <div class="notiofication-content ${(data.is_read) ? 'notification-bg-read' : 'unread'}" data-id="${data.id}">
            <img src="${data.profile_image}" alt="">
            <a href="${data.url}">${data.message}</a> <i class="fas fa-times"></i>
        </div>
    `);
};

/**
 *
 * @returns {Promise<void>}
 */
window.onload = async function () {
    hideAlert();
    await ajaxRequest('/fetch-notifications', 'post', null, false)
        .then(res => {
        res.data.forEach(collection => {
            if(collection.is_read === 0) {
                showAlert();
            }

            let obj = {
                'id': collection.id,
                'is_read': collection.is_read,
                'profile_image': `${window.location.origin}/${collection.from.profile_image}`,
                'url': collection.url,
                'message': collection.message
            };
            pushNotification(obj);
        });
    })
        .catch(err => {
            console.log(err);
    });
};

/**
 * Show Notification alert icon
 */
const showAlert = () => {
    $('body').find('.notification-alert').show();
};

// Notification Listener
socket.on(`listen-notification-event.${currentUser}`, function(data) {
    if($('body').find('.toggle-notification').length < 1) showAlert();
    pushNotification(data);
});

$(() => {
    let $body = $('body');

    $body.on('click', '.notification-listener', function () {
        $(".notification-container").toggleClass("toggle-notification");
        hideAlert();
    });

    $(".notiofication-content .fa-times").on('click', function () {
        $(this).closest('div.notiofication-content').fadeOut("slow", function () {
            $(this).remove();
        });
    });

    // Mark All As Read
    $('.mark-read').on('click', async function () {
        let ids = [];
        $('.unread').each((index, value) => {
            ids.push($(value).attr('data-id'));
        });
        await ajaxRequest('/mark-all-as-read', 'post', {ids}, false);
        $body.find('.unread').addClass('notification-bg-read').removeClass('unread');
    });

    // Mark As Read
    $body.on('click', '.notiofication-content', async function() {
        let id = $(this).attr('data-id');
        if($(this).hasClass('unread')) {
            await ajaxRequest(`/read-notification/${id}`, 'post', null, false);
        }
    });

    // Remove a notification
    $body.on('click', '.fa-times', async function (e) {
        let $selector = $(this).parents('div.notiofication-content');
        let id = $selector.attr('data-id');
        await ajaxRequest(`/delete-notification/${id}`, 'post', null, false);
        $selector.remove();
    });
});
