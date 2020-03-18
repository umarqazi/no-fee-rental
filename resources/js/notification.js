"use strict";

let currentUser = Window.Laravel.user;

/**
 * Hide Notification alert icon
 */
const hideAlert = () => {
    $('body').find('.notification-alert').hide();
};

// /**
//  *
//  * @param data
//  */
// const pushNotification = (data) => {
//     $('.notification-inner-scroll').prepend(`
//         <div class="notiofication-content ${(data.is_read) ? 'notification-bg-read' : 'unread'}" data-id="${data.id}">
//             <img src="${data.profile_image}" alt="">
//             <a href="${data.url}">${data.message}</a> <i class="fas fa-times"></i>
//         </div>
//     `);
// };

// /**
//  *
//  * @returns {Promise<void>}
//  */
// window.onload = async function () {
//     hideAlert();
//     await ajaxRequest('/fetch-notifications', 'post', null, false)
//         .then(res => {
//         res.data.forEach(collection => {
//             if(collection.is_read === 0) {
//                 showAlert();
//             }
//
//             let obj = {
//                 'id': collection.id,
//                 'is_read': collection.is_read,
//                 'profile_image': `${window.location.origin}/${collection.from.profile_image}`,
//                 'url': collection.url,
//                 'message': collection.message
//             };
//             pushNotification(obj);
//         });
//     })
//         .catch(err => {
//             console.log(err);
//     });
// };

/**
 * Show Notification alert icon
 */
const showAlert = () => {
    $('body').find('.notification-alert').show();
};

$(() => {
    let $body = $('body');

    $(".notiofication-content .fa-times").on('click', function () {
        $(this).closest('div.notiofication-content').fadeOut("slow", function () {
            $(this).remove();
        });
    });

    // Mark All As Read
    $body.on('click', '.mark-all-as-read', async function () {
        let ids = [];
        let $main = $(this).parents('.notification-container').find('.notification-inner-scroll');

        $main.find('.unread').find('a').each((index, value) => {
            ids.push($(value).attr('data-id'));
        });

        await ajaxRequest('/mark-all-as-read', 'post', {ids}, false);
        $main.find('.unread').removeClass('unread');
        hideAlert();
    });

    $(".checkbox-all").click(function () {
        $(".checkBoxClass").prop('checked', $(this).prop('checked'));
    });

    // Mark As Read
    $body.on('click', '.notification-inner-content', async function(e) {
        e.preventDefault();
        let id = $(this).parents('a').attr('data-id');
        let url = $(this).parents('a').attr('href');
        if(await ajaxRequest(`/read-notification/${id}`, 'post', null, false)) {
            $(this).closest('.notification-content').removeClass('unread');
            window.location.href = url;
        }
    });

    // Remove a notification
    $body.on('click', '.remove-single', async function (e) {
        e.preventDefault();
        let $selector = $(this).closest('div.notification-content');
        let id = $selector.find('a').attr('data-id');
        await ajaxRequest(`/delete-notification/${id}`, 'post', null, false);
        $selector.remove();
    });

    // Mark Selected As Read
    $body.on('click', '.mark-selected-as-read', async function (e) {
        let ids = [];
        e.preventDefault();
        if(!$('.checkBoxClass').is(':checked')) {
            alert('Select at least one notification');
            return;
        }

        $.each($("input[name='remove']:checked"), function(){
            ids.push($(this).val());
        });

        await ajaxRequest('/mark-all-as-read', 'post', {ids}, false);
        window.location.reload();
    });

    // Delete Selected
    $body.on('click', '.delete-selected', async function (e) {
        let ids = [];
        e.preventDefault();
        if(!$('.checkBoxClass').is(':checked')) {
            alert('Select at least one notification');
            return;
        }

        $.each($("input[name='remove']:checked"), function(){
            ids.push($(this).val());
        });
        console.log(ids);
        await ajaxRequest('/remove-selected', 'post', {ids}, false);
        window.location.reload();
    });

    $body.on('click', '.notification-listener', function () {
        $(".notification-container").toggleClass("toggle-notification");
    });
});
