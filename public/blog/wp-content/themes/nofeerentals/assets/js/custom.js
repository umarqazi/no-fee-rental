$(document).ready(function () {

	new WOW().init();

	$(".property-thumb .heart-icon").click(function () {
		$(this).toggleClass('favourite');
	});

	$('#price-range-submit').hide();

	$("#min_price,#max_price").on('change', function () {

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
			step: 100,

			slide: function (event, ui) {
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

	$("#slider-range,#price-range-submit").click(function () {

		var min_price = $('#min_price').val();
		var max_price = $('#max_price').val();

		$("#searchResults").text("Here List of products will be shown which are cost between " + min_price + " " + "and" + " " + max_price + ".");
	});

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
	$(".signin-modal-btn").click(function () {
		$("#signup-wrapper").hide();
		$("#signin-wrapper").fadeIn();
	});
	$(".row .custom-control-input").click(function () {
		var radioId = $("input[name='signup-option']:checked").attr('id');
		if (radioId == 'signup-option1') {
			$(".finding-home-text").hide();
		} else {
			$(".finding-home-text").show();
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




<script type="text/javascript">
  

    function togglefooterlink() {
    if (window.matchMedia('(max-width: 1279px)').matches) {
        $(".collapseabe-link").click(function(){
                $(this).parent().find('.collapse-menu').slideToggle();
            });
    } else {
        //...
    }
}

togglefooterlink();
</script>
