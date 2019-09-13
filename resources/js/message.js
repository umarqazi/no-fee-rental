import Echo from "laravel-echo"
window.io = require('socket.io-client');
let $ulSelector = $('.messages > ul');

$('body').on('form-success-appointment', function (event, res) {
    $('#check-availability').modal('hide');
});

/**
 * Confirm the accepted chat
 */
$('#reply').on('click', async function(e) {
    e.preventDefault();
    if(await confirm('You want to set a meeting?')) {
        let meeting_id = $(this).attr('meeting_id');
        let res = await ajaxRequest(`accept-meeting/${meeting_id}`, 'post');
        if(res.status) {
            console.log(res);
            let $userSelector = $('.user-info');
            let $listingSelector = $('.info:last');
            $userSelector.find('p:eq(3) > strong').text(res.data.msgs[0].message);
            $userSelector.find('p:eq(0) > strong').text(res.data.sender.first_name);
            $userSelector.find('p:eq(1) > strong').text(res.data.sender.email);
            $userSelector.find('p:eq(2) > strong').text((res.data.sender.phone_number)
                ? res.data.sender.phone_number : 'N/A');
            $listingSelector.find('div > p:eq(0)').text("$ "+res.data.listing.rent);
            $listingSelector.find('div > p:eq(1)').text(res.data.listing.created_at);
            $listingSelector.find('ul > li:eq(0)').text(res.data.listing.bedrooms+" Bed");
            $listingSelector.find('ul > li:eq(1)').text(res.data.listing.baths+" Bath");
            $listingSelector.find('p:last').text(res.data.listing.street_address);
            $('.property-info > img').attr('src', 'storage'+res.data.listing.thumbnail);
            $('form').attr('action', 'send-message/'+res.data.msgs[0].contact_id);
            $('#message-modal').modal('show');
            return true;
        }
    }
});

$('#send-message').on('submit', function(e) {
    e.preventDefault();
    let src = $('.avtar').find('img').attr('src');
    $('.messages > ul').append(`<li class="replies"><img style="width: 35px;height: 35px;" src="${src}"><p>${$('input[type=text]').val()}</p></li>`);
    scrollDown();
});


/**
 * load chat history
 */
$('#load_chat').on('click', async function(e) {
    e.preventDefault();
    let inbox_id = $(this).attr('inbox_id');
    if(await ajaxRequest(`load-chat/${inbox_id}`,'post')) {
    }
});
$(".message-block .message-box .fa-users").click(function () {
    $(".message-block .users-listing").toggleClass('active_listing_bar');
});
$(".message-block .users-listing .header-text .fa-times").click(function () {
    $(".message-block .users-listing").removeClass('active_listing_bar');
});

(async () => {

    if (typeof io !== undefined) {
        window.Echo = new Echo({
            broadcaster: 'socket.io',
            host: window.location.hostname + ':6001',
        });
    }

    window.Echo.channel(`messaging-channel.`+ Window.Laravel.user).listen('.message', (res) => {
        $ulSelector.append(`
            <li class="sent">
                <img style="width: 35px;height: 35px;" src="${res.sender.profile_image}">
                <p>${res.message}</p>
            </li>`);
        scrollDown();
    });
})();

/**
 * scroll down
 */
function scrollDown() {
    $ulSelector.animate({scrollTop: $ulSelector[0].scrollHeight});
}

// Scroll to end of chat area
window.onload = function () {
    scrollDown();
};
