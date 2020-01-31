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

    /**
     * Load Reply Back Modal
     */

    // $('.reply-back-modal > a').on('click', async function () {
    //     // Fetching Info From page
    //     let obj = {};
    //     await ajaxRequest(`reply-back/${$(this).attr('data-id')}`, 'post', null).then(res => {
    //         let $data = res.data;
    //         let $modal = $('#message-modal');
    //         obj.sender_name = $data.username != null ? $data.username : $data.sender.first_name +' '+ $data.sender.last_name;
    //         obj.sender_email = $data.email != null ? $data.email : $data.sender.email;
    //         obj.sender_phone = $data.phone_number != null ? $data.phone_number : $data.sender.phone_number;
    //         obj.thumbnail = window.location.origin +'/'+ $data.listing.thumbnail;
    //         obj.rent = $data.listing.rent;
    //         obj.request_type = $data.conversation_type === '1' ? 'Appointment Request' : 'Check Availability Request';
    //         obj.beds = $data.listing.bedrooms === '0.5' ? 'Studio' : $data.listing.bedrooms;
    //         obj.baths = $data.listing.baths;
    //         obj.address = $data.listing.listing_type === 'exclusive' ? $data.listing.street_address + ` - (${$data.listing.unit})` : $data.listing.display_address;
    //         obj.message = ($data.messages.pop()).message;
    //         obj.request_on = dateFormatting($data.created_at);
    //
    //         if(obj.request_type === 'Appointment Request') {
    //             $modal.find('.appointment').append(`<p>Appointment On </p><p class="date">${dateFormatting($data.appointment_date.date)} at ${$data.appointment_time}</p>`);
    //         } else {
    //             obj.appointment_on = '';
    //         }
    //
    //         $modal.find('form').attr('action', `send-reply/${$data.id}`);
    //         $modal.find('form > input[name=to]').val($data.to);
    //         $modal.find('.request-type').text(obj.request_type);
    //         $modal.find('.user-info > p:first > strong').text(obj.sender_name);
    //         $modal.find('.user-info > p:eq(1) > strong > a').text(obj.sender_email);
    //         $modal.find('.user-info > p:eq(2) > strong').text(obj.sender_phone);
    //         $modal.find('.user-info > p:last > strong').text(obj.message);
    //         $modal.find('.property-info > img').attr('src', obj.thumbnail);
    //         $modal.find('.message-list > p:first').html(`Reminder from Nofee: You have still not replied to <strong style="color: #000000; font-weight: 700; ">${obj.sender_name}</strong>`);
    //         $modal.find('.message-list > p:last').html(`Request Receive on <strong style="color: #000000; font-weight: 700; ">${obj.request_on}</strong>`);
    //         $modal.find('.info > div.title > p:first').text(`$${formatNumber(obj.rent)}`);
    //         $modal.find('.info > p:last').text(obj.address);
    //         $modal.find('.info > ul > li:first').html(`<i class="fa fa-bed"></i> ${obj.beds} Bed`);
    //         $modal.find('.info > ul > li:last').html(`<i class="fa fa-bath"></i> ${obj.baths} Bath`);
    //         $modal.modal('show');
    //     });
    // });

    // $body.on('form-success-reply-back', function () {
    //     $('#message-modal').modal('hide');
    // });

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

    /**
     *
     * @param $date
     * @param $format
     * @returns {string}
     */
    function dateFormatting($date, $format) {
        let months = [
            "January", "February", "March",
            "April", "May", "June", "July",
            "August", "September", "October",
            "November", "December"
        ];

        let parse = {};
        $date = new Date($date);

        parse.d = $date.getDate();
        parse.M = months[$date.getMonth()];
        parse.m = $date.getMonth() + 1;
        parse.Y = $date.getFullYear();
        return `${parse.d} ${parse.M}, ${parse.Y}`;
    }
});
