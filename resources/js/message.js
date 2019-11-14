"use strict";

let $ulSelector = $('.messages > ul');
$('body').on('form-success-appointment', function () {
    $('#check-availability').modal('hide');
});

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

$('#send-message').on('submit', function(e) {
    e.preventDefault(e);
    let src = $('.avtar').find('img').attr('src');
    let value  =$('input[name="message"]').val();
    if(value !== '') {
        $('input[name="message"]').css('border', '');
        $('#error').css('display' , 'none') ;
        $('.messages > ul').append(`<li class="replies"><img style="width: 35px;height: 35px;" src="${src}"><p>${$('input[type=text]').val()}</p></li>`);
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
    alert('yes');
    let inbox_id = $(this).attr('inbox_id');
    await ajaxRequest(`load-chat/${inbox_id}`,'post');
});

$(".message-block .message-box .fa-users").click(function () {
    $(".message-block .users-listing").toggleClass('active_listing_bar');
});
$(".message-block .users-listing .header-text .fa-times").click(function () {
    $(".message-block .users-listing").removeClass('active_listing_bar');
});

$(() => {

    window.Echo.channel(`messaging-channel.`+ Window.Laravel.user).listen('.message', (res) => {
        $ulSelector.append(`
            <li class="sent">
                <img style="width: 35px;height: 35px;" alt="" src="${window.location.origin}/${res.sender.profile_image === null ? 'assets/images/default-images/user.jpeg' : res.sender.profile_image}">
                <p>${res.message.message}</p>
            </li>`);
        scrollDown($ulSelector);
    });

});
