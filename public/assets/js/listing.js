$(() => {

    let $body = $('body');
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

    $body.on('click', '.border-btn', async function(e) {
        e.preventDefault();
        if(await confirm('')) {
            let currentTab = $(this).parents('div.active').attr('id');
            localStorage.setItem('tab', currentTab);
            window.location.href = $(this).parent().attr('href');
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
        if($(this).val() === '2') {
            $selector.show();return;
        }
        $selector.hide();
    });

    $body.on('keyup', '#controls', function() {
        autoComplete( document.getElementById('controls'));
    });

    $body.on('keydown', function (event) {
        if(event.keyCode === 13)
            event.preventDefault();
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

    $body.on('change', 'select[name=bedrooms]', function () {
        let $selector = $body.find('input[name=is_convertible]');
        if($(this).val() == '0.5') {
            $selector.prop('checked', false).attr('disabled', 'disabled');
        } else {
            $selector.removeAttr('disabled');
        }
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
