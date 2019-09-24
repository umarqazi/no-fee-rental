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

    $(".grid-view-btn").click(function(){
        localStorage.setItem('grid-view', 1 );
    });

    $(".list-view-btn").click(function(){
        localStorage.removeItem('grid-view', 1 );
    });

    if(localStorage.getItem('tab')) {
        $body.find('.nav-item, .active').removeClass('active');
        $('span.page-link').parents('li.page-item').addClass('active');
        $(`a[href="#${localStorage.getItem('tab')}"]`).addClass('active');
        $('.tab-content').find('#'+localStorage.getItem('tab')).removeClass('fade');
        $('.tab-content').find('#'+localStorage.getItem('tab')).addClass('active');
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
