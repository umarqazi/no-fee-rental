$(() => {

    let $body = $('body');
    let url = window.location.href.split('/');
    url = url[3] + "-" + url[4];

    // List OR Grid View Selector
    if (localStorage.getItem('grid-view')) {
        $('.list-view-btn').removeClass('active');
        setTimeout(() => {
            $('.grid-view-btn').trigger('click');
        }, 5);
        localStorage.removeItem('grid-view');
    } else {
        $('.grid-view-btn').removeClass('active');
        setTimeout(() => {
            $('.list-view-btn').trigger('click');
        }, 5);
        localStorage.removeItem('list-view');
    }

    if(localStorage.getItem(`tab-view-${url}`)) {
        setTimeout(() => {
            $(`.nav-pills > li > a:eq(${localStorage.getItem(`tab-view-${url}`)})`).trigger('click');
        }, 5);
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

});