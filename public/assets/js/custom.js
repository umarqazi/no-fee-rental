$(() => {
	new WOW().init();

    $("#signup-option1").trigger('click');
    $(".license_num").hide();
    $("#phone_number").addClass('col-sm-12');

	$("header .menu-icon").click(function () {
		$(".main-wrapper aside").slideDown();
	});

	$("aside .close-menu").click(function () {
		$(".main-wrapper aside").slideUp();
	});

	$(".list-view-btn").click(function () {
		$(".grid-view-btn").removeClass('active');
		$(this).addClass('active');
		$(".grid-view-wrapper").hide();
		$(".listing-wrapper").show();
	});

	$(".grid-view-btn").click(function () {
		$(".list-view-btn").removeClass('active');
		$(this).addClass('active');
		$(".listing-wrapper").hide();
		$(".grid-view-wrapper").show();
	});

	$(".additional-info .input-style").attr("disabled", true);

	$('#image-picker').hide();

	$(".edit-profile").click(function () {
		$('#image-picker').show();
		$(".additional-info .input-style").attr("disabled", false);
		$(this).hide();
		$(".update-profile").show();
	});

	$(".update-profile").click(function () {
		$(this).hide();
		$(".edit-profile").show()
	});

	$('#datepicker').datepicker({
		uiLibrary: 'bootstrap4'
	});

	$(".property-thumb .heart-icon").click(function () {
		$(this).toggleClass('favourite');
	});

	//

	$('#price-range-submit').hide();

	$("#min_price,#max_price").on('change', function () {
		$('#price-range-submit').show();
		let min_price_range = parseInt($("#min_price").val());
		let max_price_range = parseInt($("#max_price").val());
		if (min_price_range > max_price_range) {
			$('#max_price').val(min_price_range);
		}
		$("#slider-range").slider({
			values: [min_price_range, max_price_range]
		});
	});

	$("#min_price,#max_price").on("paste keyup", function () {
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

	$(function () {
		$("#slider-range").slider({
			range: true,
			orientation: "horizontal",
			min: 0,
			max: 10000,
			values: [0, 10000],
			step: 1,
			slide: function (event, ui) {
				if (ui.values[0] == ui.values[1]) {
					return false;
				}
				$("#min_price").val(ui.values[0]);
				$("#max_price").val(ui.values[1]);
                $('body').trigger('min-price', ui.values[0]);
                $('body').trigger('max-price', ui.values[1]);
			}
		});
		$("#min_price").val($("#slider-range").slider("values", 0));
		$("#max_price").val($("#slider-range").slider("values", 1));
	});

	$("#slider-range, #price-range-submit").click(function () {
		var min_price = $('#min_price').val();
		var max_price = $('#max_price').val();
		$("#searchResults").text("Here List of products will be shown which are cost between " + min_price + " " + "and" + " " + max_price + ".");
	});


//start range slider 2

$('#price-range-submit').hide();

	$("#min_price_2,#max_price_2").on('change', function () {

		$('#price-range-submit').show();

		var min_price_2_range = parseInt($("#min_price_2").val());

		var max_price_2_range = parseInt($("#max_price_2").val());

		if (min_price_2_range > max_price_2_range) {
			$('#max_price_2').val(min_price_2_range);
		}

		$("#slider-range-2").slider({
			values: [min_price_2_range, max_price_2_range]
		});

	});

	$("#min_price_2,#max_price_2").on("paste keyup", function () {

		$('#price-range-submit').show();

		var min_price_2_range = parseInt($("#min_price_2").val());

		var max_price_2_range = parseInt($("#max_price_2").val());

		if (min_price_2_range == max_price_2_range) {

			max_price_2_range = min_price_2_range + 100;

			$("#min_price_2").val(min_price_2_range);
			$("#max_price_2").val(max_price_2_range);
		}

		$("#slider-range-2").slider({
			values: [min_price_2_range, max_price_2_range]
		});

	});


	$(function () {
		$("#slider-range-2").slider({
			range: true,
			orientation: "horizontal",
			min: 0,
			max: 10000,
			values: [0, 10000],
			step: 1,

			slide: function (event, ui) {
				if (ui.values[0] == ui.values[1]) {
					return false;
				}

				$("#min_price_2").val(ui.values[0]);
				$("#max_price_2").val(ui.values[1]);
                $('body').trigger('square-min', ui.values[0]);
                $('body').trigger('square-max', ui.values[1]);
			}
		});

		$("#min_price_2").val($("#slider-range-2").slider("values", 0));
		$("#max_price_2").val($("#slider-range-2").slider("values", 1));

	});

	$("#slider-range-2,#price-range-submit").click(function () {

		var min_price_2 = $('#min_price_2').val();
		var max_price_2 = $('#max_price_2').val();

		$("#searchResults").text("Here List of products will be shown which are cost between " + min_price_2 + " " + "and" + " " + max_price_2 + ".");
	});

//start range slider 3

$('#price-range-submit').hide();

	$("#min_price_3,#max_price_3").on('change', function () {

		$('#price-range-submit').show();

		var min_price_3_range = parseInt($("#min_price_3").val());

		var max_price_3_range = parseInt($("#max_price_3").val());

		if (min_price_3_range > max_price_3_range) {
			$('#max_price_3').val(min_price_3_range);
		}

		$("#slider-range-3").slider({
			values: [min_price_3_range, max_price_3_range]
		});

	});


	$("#min_price_3,#max_price_3").on("paste keyup", function () {

		$('#price-range-submit').show();

		var min_price_3_range = parseInt($("#min_price_3").val());

		var max_price_3_range = parseInt($("#max_price_3").val());

		if (min_price_3_range == max_price_3_range) {

			max_price_3_range = min_price_3_range + 100;

			$("#min_price_3").val(min_price_3_range);
			$("#max_price_3").val(max_price_3_range);
		}

		$("#slider-range-3").slider({
			values: [min_price_3_range, max_price_3_range]
		});

	});


	$(function () {
		$("#slider-range-3").slider({
			range: true,
			orientation: "horizontal",
			min: 1995,
			max: 2018,
			values: [0, 2018],
			step: 1,

			slide: function (event, ui) {
				if (ui.values[0] == ui.values[1]) {
					return false;
				}

				$("#min_price_3").val(ui.values[0]);
				$("#max_price_3").val(ui.values[1]);
			}
		});

		$("#min_price_3").val($("#slider-range-3").slider("values", 0));
		$("#max_price_3").val($("#slider-range-3").slider("values", 1));

	});

	$("#slider-range-3,#price-range-submit").click(function () {

		var min_price_3 = $('#min_price_3').val();
		var max_price_3 = $('#max_price_3').val();

		$("#searchResults").text("Here List of products will be shown which are cost between " + min_price_3 + " " + "and" + " " + max_price_3 + ".");
	});

// end range slider 3


	$(".menu-btn").click(function () {
		$(".mobile-menu").slideDown();
	});

	$(".close-menu-btn").click(function () {
		$(".mobile-menu").slideUp();
	});

	$(".listing-large-view").click(function () {
		$(this).toggleClass("fa-th fa-th-large")
		$(".map-wrapper").toggleClass("map-small-view");
		$(".featured-properties .property-listing").toggleClass("grid-view");
	});

	$("#signup-wrapper").hide();

	$(".signup-modal-btn").click(function () {
		$("#signin-wrapper").hide();
		$("#signup-wrapper").fadeIn();
	});

	$(".row .custom-control-input").click(function () {
		var radioId = $("input[name=user_type]:checked").attr('id');
		if (radioId == 'signup-option1') {
			$(".finding-home-text").hide();
            $(".license_num").hide();
             $("#signup_form .btn-default").prop('disabled', false);
            $("#signup_form .agnet-input").prop('disabled', false);
		} else {
            $("#signup_form .agnet-input").prop('disabled', true);
            $("#signup_form .btn-default").prop('disabled', true);
			$(".finding-home-text").show();
            $(".license_num").show();
		}
	});

	$(".close-menu").click(function () {
		$(".mobile-menu").slideUp();
	});

	$(".let-us-hlep-form .btn-default").click(function () {
		var get_btn_id = $(this).data("target");
		if (get_btn_id != '') {
			$(".let-us-hlep-form").hide();
			$("#" + get_btn_id).fadeIn();
		}
	});

	$(function () {
		$('#multiple').pignoseCalendar({
			multiple: true
		});
	});

	$('#image-gallery').lightSlider({
		gallery: true,
		item: 1,
		thumbItem: 10,
		slideMargin: 0,
		speed: 900,
		auto: false,
		loop: false,
		responsive : [
            {
                breakpoint:1279,
                settings: {
                    item:1,
                    thumbItem:8,
                    slideMove:1,
                  }
            },
            {
                breakpoint:1024,
                settings: {
                    item:1,
                    thumbItem:6,
                    slideMove:1
                  },
                  breakpoint:991,
                settings: {
                    item:1,
                    thumbItem:5,
                    slideMove:1
                  },
                  breakpoint:767,
                settings: {
                    item:1,
                    thumbItem:5,
                    slideMove:1
                  }
            }
        ],
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
	});

	$('#subscribe').on('click', async function () {
		let res = JSON.parse(await ajaxRequest(
				`http://nofeerentalsblog.wp/newsletter`,
				'post',
				{email: $('#newsletter-form .fld').val()}));

		$('#newsletter-form').reset();
		$('#newsletterModal .modal-body').text(res.message);
		$('#newsletterModal').modal();
	});

    $(document).ready(function(){
        $(".minimize-button").click(function(){
            $(".new-found-results").toggleClass("summery-details");
        });
        $('.dropdown-toggle').dropdown();
        $('#divNewNotifications li').on('click', function() {
            $('#dropdown_title').html($(this).find('a').html());
        });
    	$("#signup-btn").click(function(){
      		$('body').addClass('signup-modal-scroll');
    	});
    	$("#login-btn").click(function() {
        $('body').addClass('signup-modal-scroll');
    });
    $("#login").click(function() {
        $('body').addClass('signup-modal-scroll');
    });
    	$('.close-signup-modal').click(function(){
    		$('body').removeClass('signup-modal-scroll');
    	});
    	$(document).on("click", function (e) {
        if ($(e.target).is("#signup-btn")==false && $(e.target).parents('#signup').length==0) {
            $("body").removeClass("signup-modal-scroll");
        }
    	});

    });

});
