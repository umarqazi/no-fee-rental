$(() => {

    new WOW().init();

    $("header .menu-icon").click(function() {
        $(".main-wrapper aside").slideDown();
    });

    $( "<button class='mapboxgl-popup-close-button' type='button' aria-label='Close popup'>×</button>" ).insertAfter( ".mapboxgl-popup-anchor-top" );
    //randomly change banner images on load
    let image = ["1.jpg", "2.jpg", "3.jpg"];
    let x = Math.floor(image.length * Math.random());
    $('body').find('.header-bg').css({ "background": "url(../assets/images/" + image[x] + ")" });

    $("aside .close-menu").click(function() {
        $(".main-wrapper aside").slideUp();
    });

    $(".after-radio-textarea a").click(function(){
        $(".calendar-wrap").hide();
        $(".successfull-msg").show();
    });
    $(".apointment-tabs ul li").click(function(){
        $(".apointment-tabs ul li").removeClass('active');
        $(this).addClass('active');
    });

    $(".list-view-btn").click(function() {
        $(".grid-view-btn").removeClass('active');
        $(this).addClass('active');
        $(".grid-view-wrapper").hide();
        $(".listing-wrapper").show();
    });

    $(".mobile-map-icon").click(function() {
        $(this).find('i').toggleClass('fa-map-marked-alt fa-times')
        $(".map-wrapper").slideToggle();
    });

    $(".grid-view-btn").click(function() {
        $(".list-view-btn").removeClass('active');
        $(this).addClass('active');
        $(".listing-wrapper").hide();
        $(".grid-view-wrapper").show();
    });

    $('.dropdown-wrap ul li .radio-button').click(function() {
        var input_checked = $(this).find("input").attr('checked', true);
        if ($(input_checked).is(':checked')) {
            var get_parent = $(this).parent().parent().parent().parent().find(".btn-default").addClass("addbackground");
        } else {}

    });



    $('#datepicker').datepicker({
        uiLibrary: 'bootstrap4'
    });

    $(function() {
        $('#exclusive-3').change(function() {
            var val = $(this).val();

            if (val == "one") {

                $(".exclusive-chkboxes .custom-checkbox input[value='two']").prop("disabled", $(this).is(":checked"));

            } else if (val == "two") {

                $(".exclusive-chkboxes .custom-checkbox input[value='one']").prop("disabled", $(this).is(":checked"));

            }
        });
    });

    // end range slider 3

    $('.listing-Details .apointment-tabs ul li').click(function() {
        $('.listing-Details .apointment-tabs ul li').removeClass('active');
        $(this).addClass('active');
    })
    $(".menu-btn").click(function() {
        $(".mobile-menu").slideDown();
    });

    $(".close-menu-btn").click(function() {
        $(".mobile-menu").slideUp();
    });

    $(".mobile-view-dropdown").on('click', function() {
        $(this).find("i").toggleClass('fa-bars fa-times');
        $("#mobile-tabs-collapse").slideToggle();
    });
    // $('.search-bdr-top .mobile-view-dropdown').click( function () {
    //     $('.search-result-wrapper .map-wrapper').hide();
    //     $('.mobile-map-icon').find('i').removeClass('fa-times');
    //     $('.mobile-map-icon').find('i').addClass('fa-map-marked-alt');
    // });
    $('.mobile-map-icon').click( function () {
        $('#mobile-tabs-collapse').hide();
        $('.mobile-view-dropdown').find('i').removeClass('fa-times');
        $('.mobile-view-dropdown').find('i').addClass('fa-bars');
    });

    $(".listing-large-view").click(function() {
        $(this).toggleClass("fa-th fa-th-large");
        $(".map-wrapper").toggleClass("map-small-view");
        $(".featured-properties .property-listing").toggleClass("grid-view");
    });

    $("#signup-wrapper").hide();

    $(".signup-modal-btn").click(function() {
        $("#signin-wrapper").hide();
        $("#signup-wrapper").fadeIn();
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
            $("#signup_form .finding-home-text").css('opacity', '0.8');
            $("#signup_form .btn-default").prop('disabled', true);
            $(".finding-home-text").show();
            $(".create-client-listing").hide();
            $(".create-agent-listing").show();
            $(".license_num").show();
        }
    });

    $(".close-menu").click(function() {
        $(".mobile-menu").slideUp();
    });

    function onSelectHandler(date, context) {
        let from = null;
        if (date[0] !== null) {
            from = date[0].format('YYYY-MM-DD');
        }

        if ($('body').find('.pignose-availability').length > 0) {
            $('.pignose-availability').val(from);
        } else {
            $('body').find('.article').append(`<input name='move_in_date' class="pignose-availability" type='hidden' value='${from}'>`);
        }
    }

    $(function() {
        let date = new Date();
        $('#multiple').pignoseCalendar({
            minDate: date.setDate(date.getDate() - 1),
            select: onSelectHandler
        });

        let from = $('body').find('.pignose-calendar-unit-active').attr('data-date');
        $('body').find('.article').append(`<input name='move_in_date' class="pignose-availability" type='hidden' value='${from}'>`);
    });

    $('#image-gallery').lightSlider({
        gallery: true,
        item: 1,
        thumbItem: 4,
        slideMargin: 0,
        speed: 900,
        auto: false,
        loop: false,
        responsive: [{
                breakpoint: 1279,
                settings: {
                    item: 1,
                    thumbItem: 4,
                    slideMove: 1,
                }
            },
            {
                breakpoint: 1024,
                settings: {
                    item: 1,
                    thumbItem: 4,
                    slideMove: 1
                },
                breakpoint: 991,
                settings: {
                    item: 1,
                    thumbItem: 3,
                    slideMove: 1
                },
                breakpoint: 767,
                settings: {
                    item: 1,
                    thumbItem: 4,
                    slideMove: 1
                }
            }
        ],
        onSliderLoad: function() {
            $('#image-gallery').removeClass('cS-hidden');
        }
    });

    $('.property-listing.mobile-listing .owl-carousel').owlCarousel({
        autoplay: true,
        responsiveClass: true,
        autoHeight: true,
        autoplayTimeout: 7000,
        smartSpeed: 800,
        margin: 15,
        nav: true,
        dots:false,
        responsive: {
            0: {
                items: 1
            },
            577: {
                items: 2
            },
            1000: {
                items: 2
            }
        }
    });

    $('.owl-slider #NearbyApartments').owlCarousel({
        autoplay: true,
        responsiveClass: true,
        autoHeight: true,
        autoplayTimeout: 7000,
        smartSpeed: 800,
        margin: 15,
        nav: true,
        dots: false,
        responsive: {
            0: {
                items: 1
            },

            577: {
                items: 2
            },

            1024: {
                items: 3
            },

            1366: {
                items: 3
            }
        }
    });

    $('#subscribe').on('click', async function() {
        let res = JSON.parse(await ajaxRequest(
            `http://nofeerentalsblog.wp/newsletter`,
            'post', {
                email: $('#newsletter-form .fld').val()
            }));

        $('#newsletter-form').reset();
        $('#newsletterModal .modal-body').text(res.message);
        $('#newsletterModal').modal();
    });

    $(document).ready(function() {
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

        $("#need-help-btn2").click(function() {
            $("body").addClass("signup-modal-scroll-getStart");
        });
        $(".btn-default.get_started_next_btn , .btn-default.next-modal").click(function() {
            $("body").addClass("signup-modal-scroll-getStart");
        });
        $(".modal .datepicker.-bottom-left-.-from-bottom-").click(function() {
            $("body").addClass("datepicker-overflow-hidden");
        });

        $(".need-help-modal .close, #let-us-step12 .close , #advance-search .close , #myModal-currentPlan .close ," +
            " #add-event .close , #add-event .modal-footer .btn-default  ").click(function() {
            $("body").removeClass("datepicker-overflow-hidden");
        });
        $(".need-help-modal .close").click(function() {
            $("body").removeClass("signup-modal-scroll-getStart");
        });

        $(document).on("click", function(e) {
            if ($(e.target).is("#signup-btn") == false && $(e.target).parents('#signup').length == 0 && $(e.target).parents('#login').length == 0) {
                $("body").removeClass("signup-modal-scroll");
            }
            if ($(e.target).parents(".need-help-modal, #datepickers-container .datepicker").length == 0) {
                $("body").removeClass("signup-modal-scroll-getStart");
            }
            if ($(e.target).is('#need-help-step4, #let-us-step12, #advance-search, #myModal-currentPlan, #add-event')) {
                $("body").removeClass("datepicker-overflow-hidden");
            }
            if ($(e.target).is(".dropdown-beds") == false && $(e.target).parents('.dropdown-beds').length == 0 && $(e.target).parents('.beds-dropdown').length == 0) {
                $(".bed-advance-search").hide();
            }
            if (!$(e.target).is(".price-range-dropdown") && $(e.target).parents('.price-range-dropdown').length == 0) {
                $(".price-range-ul").hide();
            }
            if (!$(e.target).is(".search-fld") && $(e.target).parents('.neighborhood-search-advance').length == 0) {
                $(".neighborhood-search-dropdown").hide();
            }
            if (!$(e.target).is(".search-fld") && $(e.target).parents('.neighborhood-search-advance').length == 0) {
                $(".neighborhood-search-dropdown").hide();
            }

            if (!$(e.target).is(".dropdown-wrap .btn-primary") && $(e.target).parents('.dropdown-for-neigh').length == 0) {
                $(".dropdown-for-neigh").slideUp();
            }
            if (!$(e.target).is(".dropdown-wrap .btn-primary") && $(e.target).parents('.dropdown-for-beds , #advance-search-beds').length == 0) {
                $(".dropdown-for-beds").slideUp();
            }
            if (!$(e.target).is(".dropdown-wrap .btn-primary") && $(e.target).parents('.dropdown-for-baths , #advance-search-baths').length == 0) {
                $(".dropdown-for-baths").slideUp();

            }
            if (!$(e.target).is(".dropdown-wrap .btn-primary") && $(e.target).parents('.dropdown-for-price').length == 0) {
                $(".dropdown-for-price").slideUp();
            }
            if (!$(e.target).is(".dropdown-wrap .btn-primary") && $(e.target).parents('.dropdown-listiing-rent-page').length == 0) {
                $(".dropdown-wrap .btn-primary").removeClass('rent-active-dropdown');
            }

        });

        $('.close-signup-modal').click(function() {
            $('body').removeClass('signup-modal-scroll');
        });
        //
        $("#advance-search-chkbox input[type='checkbox']").change(function() {
            if ($(this).is(":checked")) {
                $(this).parent('#advance-search-chkbox ul li').addClass("white-border-chkbox");
            } else {
                $(this).parent('#advance-search-chkbox ul li').removeClass("white-border-chkbox");
            }
        });
    });

    //    filter data for agent dashboard
    $('.filter-mobile-data .filters-icon').click(function() {
        $(this).toggleClass('fa-bars fa-times');
        $('.filter-wrapper-mobile .filter-wrapper').slideToggle();
    });

    //appointment message counter
    $("#appointment-message").on('input', function() {
        $("#counter").text(500 - $("#appointment-message").val().length);
    });
    $('.stars-rating i').click(function() {
        $(this).toggleClass('far fa-star fas fa-star');
    })

    $('#stars li').on('mouseover', function() {
        let onStar = parseInt($(this).data('value'), 10); // The star currently mouse on

        $(this).parent().children('li.star').each(function(e) {
            if (e < onStar) {
                $(this).addClass('hover');
            } else {
                $(this).removeClass('hover');
            }
        });

    }).on('mouseout', function() {
        $(this).parent().children('li.star').each(function(e) {
            $(this).removeClass('hover');
        });
    });

    $('#stars li').on('click', function() {
        let onStar = parseInt($(this).data('value'), 10); // The star currently selected
        let stars = $(this).parent().children('li.star');
        for (i = 0; i < stars.length; i++) {
            $(stars[i]).removeClass('selected');
        }
        for (i = 0; i < onStar; i++) {
            $(stars[i]).addClass('selected');
        }
        let ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);
        $('input[name="rating"]').val(ratingValue);
    });

    //custom validation on schedule appointment
    $(document).on('click', '.appointment-submit-button', function() {
        let date = true;
        let time = true;
        let message = true;

        if ($("input[name='appointment_date']").is(':checked')) {
            date = true;
        } else {
            date = false;
            $(".app-date-error").text('Appointment Date is Required.');
        }

        if ($("input[name='appointment_time']").is(':checked')) {
            time = true;
        } else {
            time = false;
            $(".app-time-error").text('Appointment Time is Required.');
        }

        if ($("textarea[name='message']").val() !== '') {
            message = true;
        } else {
            message = false;
            $(".app-message-error").text('Appointment Message is Required.');
        }

        if (date && time && message) {
            $('#appointment-form').submit();
        }
    });

    $("input[name='appointment_date']").on("change", function() {

        if (!$('.app-date-error').is(':empty')) {
            $('.app-date-error').text('');
        }
    });
    $("input[name='appointment_time']").on("change", function() {

        if (!$('.app-time-error').is(':empty')) {
            $('.app-time-error').text('');
        }
    });
    $("textarea[name='message']").on("input", function() {

        if (!$('.app-message-error').is(':empty')) {
            $('.app-message-error').text('');
        }
    });

    $(".dropdown-beds").click(function() {
        $(".dropdown-beds #advance-search-beds").toggle();
    });

    $("#advance-search-beds ul > li > input").on("click", function(e) {
        let count = 0;
        $('#advance-search-beds ul > li > input').each(function(index) {
            if ($(this).is(":checked")) {
                ++count;
            }
        });
        var get_text = $(this).parent().find('span').text();
        var dropdown_show = get_text.replace(' +', '');
        if ($(this).is(":checked")) {
            $("#show-beds").find('.placeholder-text').hide();
            if (count == 1) {
                $('#show-beds').append('<span id="chk_' + dropdown_show + '_chk">' + ' ' + '' + get_text + ' ' + '</span>');
            }
            if (count > 1) {
                $('#show-beds').append('<span id="chk_' + dropdown_show + '_chk">' + ' ' + ', ' + get_text + '' + '</span>');
            }
            //$('#show-beds').append('<span id="chk_'+dropdown_show+'_chk">'+  ' ' + '' + get_text +  ' ,'+ '</span>');
        }
        if ($(this).is(":not(:checked)")) {
            $('#chk_' + dropdown_show + '_chk').remove();
        }
        var get_inputs = $(".dropdown-beds #advance-search-beds ul input");
        if ($(get_inputs).is(":checked")) {
            $("#show-beds").find('.placeholder-text').hide();
        } else {
            $("#show-beds").find('.placeholder-text').show();
        }

    });
    //rent dropdwon buttons
    $('.dropdown-wrap .btn-primary').click(function() {
        $('.dropdown-wrap .btn-primary').removeClass('rent-active-dropdown');
        $(this).toggleClass('rent-active-dropdown');
    });
    $('#beds-for-dropdown').click(function() {
        $('.dropdown-for-beds').slideToggle();
    });
    $('#bath-for-dropdown').click(function() {
        $('.dropdown-for-baths').slideToggle();
    });
    $('#neigh-for-dropdown').click(function() {
        $('.dropdown-for-neigh').slideToggle();
    });
    $('#price-for-dropdown').click(function() {
        $('.dropdown-for-price').slideToggle();
    });
    $('.dropdown-wrap .btn-primary').click(function() {
        $(".dropdown-listiing-rent-page").hide();
        $(this).next().addClass('active').show();
    });
    $(".price-range-dropdown").click(function(e) {
        if ($(e.target).parents('.price-range-dropdown').length !== 0) {
            return;
        }
        $(".price-range-ul").toggle();
    });

    $(".header-bg .search-property .search-fld").click(function(e) {
        $(".neighborhood-search-dropdown").toggle();
    });
    $(".checkbox-all").click(function () {
        $(".checkBoxClass").prop('checked', $(this).prop('checked'));
    });
    $('.notification-container .notification-content .cross-icon-noti').click(function () {
        $('.notification-container').removeClass('hide-notification');
        $(this).parents('.notification-container .notification-content').addClass('hide-notification');
    });
    $('.notification-main-wrapper i').click(function () {
        $(this).toggleClass('far fa-star fas fa-star');
    });
    $('.recent-star').click(function () {
        $(this).toggleClass('far fa-star fas fa-star');
    });

    $('[data-toggle="tooltip"]').tooltip();

    $(function() {
        $("input[name=min_price], input[name=max_price], input[name=price], input[name=renter_rebate], " +
            "input[name=rent], input[name=application_fee], input[name=deposit]").keypress(function (e) {
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                // $(".error").html("Number Only").stop().show().fadeOut("slow");
                return false;
            }
        });
    });
    $('body').find(".money-mask, .price-range-ul > ul > li > input[name=min_price], input[name=budget], .price-range-ul > ul > li >" +
        "input[name=max_price], .dropdown-for-price > ul > li > input[name=min_price], .dropdown-for-price > ul >" +
        " li > input[name=max_price], .neighborhood-flex > .form-group > input[name=renter_rebate]," +
        " .neighborhood-flex > .form-group > input[name=rent], .unit-flex > .form-group >" +
        " input[name=application_fee], .availability-flex > .form-group > input[name=deposit]," +
        " #invest > input[name=min_price]").simpleMoneyFormat();
});



