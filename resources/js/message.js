"use strict";

let currentUser = Window.Laravel.user;
let socket = require('./socket-client').socket;

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
    $('#reply').on('click', async function(e) {
        e.preventDefault();
        if(await confirm('You want to set a meeting?')) {
            let meeting_id = $(this).attr('request_id');
            let res = await ajaxRequest(`accept-meeting/${meeting_id}`, 'post', null,false);
            if(res.status) {
                location.reload();
                return true;
            }

        }
    });

    $body.on('submit', '#send-message', function(e) {
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
});
