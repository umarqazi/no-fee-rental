$(document).ready(function () {

	new WOW().init();

	$("header .menu-icon").click(function () {
		$(".main-wrapper aside").slideDown();
	});

	$("aside .close-menu").click(function () {
		$(".main-wrapper aside").slideUp();
	});

	$(".list-view-btn").click(function () {
		$(".grid-view-btn").removeClass('active');
		$(this).addClass('active')
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
		$(".update-profile").show()
	});

	$(".update-profile").click(function () {
		$(this).hide();
		$(".edit-profile").show()
	});

	$('#datepicker').datepicker({
		uiLibrary: 'bootstrap4'
	});

});
