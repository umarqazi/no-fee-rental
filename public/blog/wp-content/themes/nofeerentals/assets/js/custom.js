$(document).ready(function() {

    new WOW().init();

    $("#signup-option1").trigger('click');
    $(".license_num").hide();

    $("#phone_number").addClass('col-sm-12');

    $(".property-thumb .heart-icon").click(function() {
        $(this).toggleClass('favourite');
    });

    $('#price-range-submit').hide();

    $("#min_price,#max_price").on('change', function() {

        $('#price-range-submit').show();

        var min_price_range = parseInt($("#min_price").val());

        var max_price_range = parseInt($("#max_price").val());

        if (min_price_range > max_price_range) {
            $('#max_price').val(min_price_range);
        }

        $("#slider-range").slider({
            values: [min_price_range, max_price_range]
        });

    });

    $("#min_price,#max_price").on("paste keyup", function() {

        $('#price-range-submit').show();

        var min_price_range = parseInt($("#min_price").val());

        var max_price_range = parseInt($("#max_price").val());

        if (min_price_range == max_price_range) {

            max_price_range = min_price_range + 100;

            $("#min_price").val(min_price_range);
            $("#max_price").val(max_price_range);
        }

        $("#slider-range").slider({
            values: [min_price_range, max_price_range]
        });

    });

    $(function() {
        $("#slider-range").slider({
            range: true,
            orientation: "horizontal",
            min: 0,
            max: 10000,
            values: [0, 10000],
            step: 100,

            slide: function(event, ui) {
                if (ui.values[0] == ui.values[1]) {
                    return false;
                }

                $("#min_price").val(ui.values[0]);
                $("#max_price").val(ui.values[1]);
            }
        });

        $("#min_price").val($("#slider-range").slider("values", 0));
        $("#max_price").val($("#slider-range").slider("values", 1));

    });

    $("#slider-range,#price-range-submit").click(function() {

        var min_price = $('#min_price').val();
        var max_price = $('#max_price').val();

        $("#searchResults").text("Here List of products will be shown which are cost between " + min_price + " " + "and" + " " + max_price + ".");
    });

    $(".menu-btn").click(function() {
        $(".mobile-menu").slideDown();
    });

    $(".close-menu-btn").click(function() {
        $(".mobile-menu").slideUp();
    });

    $(".listing-large-view").click(function() {
        $(this).toggleClass("fa-th fa-th-large")
        $(".map-wrapper").toggleClass("map-small-view");
        $(".featured-properties .property-listing").toggleClass("grid-view");
    });

    $("#signup-wrapper").hide();

    $(".signup-modal-btn").click(function() {
        $("#signin-wrapper").hide();
        $("#signup-wrapper").fadeIn();
    });
    $(".signin-modal-btn").click(function() {
        $("#signup-wrapper").hide();
        $("#signin-wrapper").fadeIn();
    });

    $(".row .custom-control-input").click(function() {
        var radioId = $("input[name=user_type]:checked").attr('id');
        if (radioId == 'signup-option1') {
            $(".finding-home-text").hide();
            $(".license_num").hide();
            $(".create-client-listing").show();
            $(".create-agent-listing").hide();
            $("#signup_form .btn-default").prop('disabled', false);
            $("#signup_form .agnet-input").prop('disabled', false);
           
        } else {
            $("#signup_form .agnet-input").prop('disabled', true);
            $("#signup_form .finding-home-text").css('opacity', '0.3');
            $("#signup_form .btn-default").prop('disabled', true);
            $(".finding-home-text").show();
            $(".license_num").show();
            $(".create-client-listing").hide();
            $(".create-agent-listing").show();
        }
    });

    $(".close-menu").click(function() {
        $(".mobile-menu").slideUp();
    });

    $(".let-us-hlep-form .btn-default").click(function() {
        var get_btn_id = $(this).data("target");
        if (get_btn_id != '') {
            $(".let-us-hlep-form").hide();
            $("#" + get_btn_id).fadeIn();
        }
    });

    /*$(function () {
        $('#multiple').pignoseCalendar({
            multiple: true
        });
    });

    $('#image-gallery').lightSlider({
        gallery: true,
        item: 1,
        thumbItem: 4,
        slideMargin: 0,
        speed: 900,
        auto: false,
        loop: true,
        onSliderLoad: function () {
            $('#image-gallery').removeClass('cS-hidden');
        }
    });

    $('.property-listing.mobile-listing .owl-carousel').owlCarousel({
        loop: false,
        margin: 5,
        nav: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 2
            }
        }
    });*/

});

$(document).ready(function() {

    $('#login-btn').on('click', function() {
        $('#signup').modal('hide');
        $('#login').modal('show');
    });

    $('#signup-btn').on('click', function() {
        $('#signup').modal('show');
        $('#login').modal('hide');
    });

    $(".minimize-button").click(function() {
        $(".new-found-results").toggleClass("summery-details");
    });
    $('.dropdown-toggle').dropdown();
    $('#divNewNotifications li').on('click', function() {
        $('#dropdown_title').html($(this).find('a').html());
    });
    $("#signup-btn").click(function() {
        $('body').addClass('signup-modal-scroll');
    });
    $("#login-btn").click(function() {
        $('body').addClass('signup-modal-scroll');
    });
    $("#login").click(function() {
        $('body').addClass('signup-modal-scroll');
    });
    $('.close-signup-modal').click(function() {
        $('body').removeClass('signup-modal-scroll');
    });
    $(document).on("click", function (e) {
        if ($(e.target).is("#signup-btn")==false && $(e.target).parents('#signup').length==0 && $(e.target).parents('#login').length==0) {
            $("body").removeClass("signup-modal-scroll");
        }
    });

    function togglefooterlink() {
        if (window.matchMedia('(max-width: 1279px)').matches) {
            $(".collapseabe-link").click(function() {
                $(this).parent().find('.collapse-menu').slideToggle();
            });
        } else {
            //...
        }
    }
    togglefooterlink();


    // range slider rent calculator

    $('#price-range-submit').hide();

    

    $(function () {
        $("#slider-range-4").slider({
            range: true,
            orientation: "horizontal",
            //max: 10000,
            disabled: true,
            values: [ 0, 50 ]          
        });


    }); 
});
