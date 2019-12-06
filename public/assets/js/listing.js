$(() => {

    let $body = $('body');
    let url = window.location.href.split('/');
    url = url[3] + "-" + url[4];

    // List OR Grid View Selector
    if (localStorage.getItem('grid-view')) {
        $('.list-view-btn').removeClass('active');
        setTimeout(() => {
            $('.grid-view-btn').trigger('click');
        }, 10);
        localStorage.removeItem('grid-view');
    } else {
        $('.grid-view-btn').removeClass('active');
        setTimeout(() => {
            $('.list-view-btn').trigger('click');
        }, 10);
        localStorage.removeItem('list-view');
    }

    if(localStorage.getItem(`tab-view-${url}`)) {
        setTimeout(() => {
            $(`.nav-pills > li > a:eq(${localStorage.getItem(`tab-view-${url}`)})`).trigger('click');
        }, 50);
    }

    $(".grid-view-btn").on('click', function(){
        localStorage.removeItem('list-view');
        localStorage.setItem('grid-view', JSON.stringify(1));
    });

    $(".list-view-btn").on('click', function(){
        localStorage.removeItem('grid-view');
        localStorage.setItem('list-view', JSON.stringify(1));
    });

    // Tab Selector
    $('.nav-pills > li').on('click', function() {
        localStorage.setItem(`tab-view-${url}`, $(this).index());
    });

    if(localStorage.getItem('tab-view')) {
        $body.find('.nav-item, .active').removeClass('active');
        $body.find()
    } else {
        $('.nav-link:first, .tab-content > .tab-pane:first').addClass('active');
    }

    $body.on('blur', '.controls', function() { $('.pac-container').remove(); });

    $(".sort-bt > i,span").on('click', function () {
        $(this).siblings(".custom-dropdown").slideToggle();
    });

    $('.input-style').attr('disabled', false);

    $body.on('change', '#file-3', function(e) {
    	let file = e.target.files[0];
    	imagePreview(file, '#img');
    	$('#img').attr('style', 'width: 180px;height: 145px;margin-bottom: 15px;');
    });

    $body.on('click', '.info > a', async function(e) {
        e.preventDefault();
        if(await confirm('Are you sure?')) {
            let currentTab = $(this).parents('div.active').attr('id');
            localStorage.setItem('tab', currentTab);
            window.location.href = $(this).attr('href');
        }
    });

    $body.on('click', '.page-link', function(e) {
        e.preventDefault();
        let currentTab = $(this).parents('div.active').attr('id');
        localStorage.setItem('tab', currentTab);
        if(e.target.href) {
            window.location.href = e.target.href;
        }
    });

    $('select[name=availability_type]').on('change', function() {
        let $selector = $('.availability-date');
        if($(this).val() === '3') {
            $selector.show();return;
        }
            $selector.hide();
    });

    $('body').on('blur', 'input[name=street_address]', async function() {
        let $validator = $(`#${$('body').find('form').attr('id')}`).validate();
        await ajaxRequest('/is-owner-only', 'post', {address: $(this).val()}, false).then(async res => {
            if(res === 'false') {
                $('.submit').removeAttr('disabled');
                await ajaxRequest('/is-unique-address', 'post', {address: $(this).val()}, false).then(res => {
                    if(res === 'true') {
                        $('body').find('#amenities > .row').show();
                    }
                });
            } else {
                $('.submit').attr('disabled', 'disabled');
                let errors = { street_address: "Current building is owner only." };
                $validator.showErrors(errors);
            }
        });
    });

    $body.on('keyup', '#controls', function() {
        autoComplete( document.getElementById('controls'));
    });

    $body.on('click', '.submit', function () {
        $(this).parents('form').submit();
    });

    $body.on('blur', '#controls', function() {
        setTimeout(() => {
            addrToLatLng($('body').find('#controls').val()).then(coords => {
                coords = {
                    latitude: coords[0].geometry.location.lat(),
                    longitude: coords[0].geometry.location.lng()
                };
                $('input[name=map_location]').val(JSON.stringify(coords));
                setMap(coords, document.getElementById('map'));
                marker = addMarker(coords);
                showInfoWindow($('body').find('#controls').val(), marker);
            });
        }, 500);
    });
});

/**
 * live preview the image
 *
 * @return void
 */
async function imagePreview(file, targetId) {
    await livePreview(file, targetId);
}

/**
 * build collection for api
 * collected data.
 *
 * @return void
 */

async function remove(id, image) {
    let url = window.location.href;
    url = url.split('/');
    await ajaxRequest(`/${url[3]}/remove-listing-image/${id}`, 'get');
    $(image).parents('.parent-div').remove();
}
