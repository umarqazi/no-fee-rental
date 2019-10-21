$(() => {

    let $body = $('body');
    if (localStorage.getItem('grid-view')) {
        $('.list-view-btn').removeClass('active');
        setTimeout(() => {
            $('body').find('.grid-view-btn').trigger('click');
        }, 100);
        localStorage.removeItem('grid-view');
    }

    $(".sort-bt > i,span").on('click', function () {
        $(this).siblings(".custom-dropdown").slideToggle();
    });

    $('.input-style').attr('disabled', false);

    $body.on('change', '#file-3', function(e) {
    	let file = e.target.files[0];
    	imagePreview(file, '#img');
    	$('#img').attr('style', 'width: 180px;height: 145px;margin-bottom: 15px;');
    });

    $(".grid-view-btn").on('click', function(){
        localStorage.setItem('grid-view', JSON.stringify(1));
    });

    $(".list-view-btn").on('click', function(){
        localStorage.removeItem('grid-view');
    });

    if(localStorage.getItem('tab')) {
        $body.find('.nav-item, .active').removeClass('active');
        $('span.page-link').parents('li.page-item').addClass('active');
        $(`a[href="#${localStorage.getItem('tab')}"]`).addClass('active');
        $('.tab-content').find('#'+localStorage.getItem('tab')).addClass('active').removeClass('fade');
        localStorage.removeItem('tab');
    } else {
        $('.nav-link:first, .tab-content > .tab-pane:first').addClass('active');
    }

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

    $('select[name=availability]').on('change', function() {
        let $selector = $('.availability-date');
        if($(this).val() === '3') {
            $selector.show();return;
        }
            $selector.hide();
    });

    $('.controls').on('keydown blur', function() {
        setTimeout(() => {
            let val = $(this).val();
            val = val.replace(', USA', '');
            val = val.replace(', NY, USA', '');
            val = val.replace(', New York', '');
            $('#autofill').val(val);
        }, 5);
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

    // disable enable exclusive settings checkboxes
        $('#listitemp4 , #listitemp3').change(function() {
            var val = $(this).val();

            if (val == "p4") {
                $(".row > .col-md-6 > ul > li > .custom-checkbox > input[value='p1'] ,input[value='p2'] ,input[value='p3']").prop("disabled", $(this).is(":checked"));
                $(".row > .col-md-6 > ul > li > .custom-checkbox > input[value='p1'] ,input[value='p2'] ,input[value='p3']").prop("checked", false);

            }

            if (val == "p3") {
                $(".row > .col-md-6 > ul > li > .custom-checkbox > input[value='p1'] ,input[value='p2']").prop("disabled", $(this).is(":checked"));
                $(".row > .col-md-6 > ul > li > .custom-checkbox > input[value='p1'] ,input[value='p2']").prop("checked", false);

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
