"use strict";

let currentUser = Window.Laravel.user;
let io = require('socket.io-client');
let protocol = `http://localhost:8080`;
let socket = io(protocol);

// Event Emitter
const emit = async () => {
    let data = {
        to: $('input[name=to]').val(),
        from: currentUser,
        message: $('input[name=message]').val(),
        profile_image: $('.avtar > img').attr('src'),
    };
    socket.emit('chat-channel', data);
    await ajaxRequest($('#send-message').attr('action'), $('#send-message').attr('method'), data, false);
};

// Event Listener
$(() => {
    socket.on(`listen-chat-event.${$('input[name=to]').val()}`, async function (res) {
        if(Window.Laravel.user === res.from) {
            return;
        }
        // let url = window.location.href;
        // url = url.split('/');
        // if(url[4] !== 'load-chat') {
        //     await ajaxRequest('/push-notification', 'post', res, false);
        // } else {
        let $ul = $('.messages > ul');
        $ul.append(`
            <li class="sent">
            <img style="width: 25px;height: 25px;" alt="" src="${res.profile_image}">
                 <p>${res.message}</p>
            </li>`);
        scrollDown($ul);
        // }
    });
});

$(() => {
    let $body = $('body');
    let $ulSelector = $('.messages > ul');

    /**
     * Accept Meeting Request
     */
    $('#accept').on('click', async function(e) {
        e.preventDefault();
        if(await confirm('You want to set a meeting?')) {
            let meeting_id = $(this).attr('request_id');
            window.location.href = `accept-meeting/${meeting_id}`;
        }
    });

    $body.on('click', '#send-message', function(e) {
        e.preventDefault();
        let msgField = $('input[name="message"]');
        let src = $('.avtar').find('img').attr('src');
        let value  = msgField.val();
        if(value !== '') {
            emit();
            msgField.css('border', '');
            if($('#error').length > 0) $('#error').css('display' , 'none');
            $('.messages > ul').append(`<li class="replies"><img style="width: 25px;height: 25px;" src="${src}"><p>${$('input[type=text]').val()}</p></li>`);
            msgField.val('');
            scrollDown($ulSelector);
        }
        else {
            $('#error').css('display' , 'block') ;
            $('input[name="message"]').css('border', '1px solid red');
        }
    });


    /**
     * load chat history
     */
    $('#load_chat').on('click', async function(e) {
        e.preventDefault();
        let inbox_id = $(this).attr('inbox_id');
        await ajaxRequest(`load-chat/${inbox_id}`,'post');
    });

    $(".message-block .message-box .fa-users").click(function () {
        $(".message-block .users-listing").toggleClass('active_listing_bar');
    });
    $(".message-block .users-listing .header-text .fa-times").click(function () {
        $(".message-block .users-listing").removeClass('active_listing_bar');
    });

    $body.find('.archive').on('click', async function (e) {
        let msg = null;
        e.preventDefault();
        if($(this).text() === ' Archive')
            msg = 'You want to archive this conversation';
        else
            msg = 'You want to un-Archive this conversation?';

        if(await confirm(msg))
            window.location.href = $(this).attr('href');
    });

    $body.on('click', '.deny', async function (e) {
        e.preventDefault();
        if(await confirm('You want to deny meeting request')) {
            window.location.href = $(this).attr('href');
        }
    });
});
