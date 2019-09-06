$(() => {

    /**
     * Confirm the accepted chat
     */
    $('#reply').on('click', async function(e) {
        e.preventDefault();
       if(await confirm('You want to set a meeting?')) {
           datePicker('#schedule');
           let meeting_id = $(this).attr('meeting_id');
           let res = await ajaxRequest(`accept-meeting/${meeting_id}`, 'post');
           if(res.status) {
               let $userSelector = $('.user-info');
               let $listingSelector = $('.info:last');
               $userSelector.find('p:eq(3) > strong').text(res.data.messages[0].message);
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
               $('form').attr('action', 'send-message/'+res.data.messages[0].contact_id);
               $('#message-modal').modal('show');
               return true;
           }
       }
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
});
