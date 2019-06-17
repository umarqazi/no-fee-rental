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



	$(".edit-profile").click(function () {
		$(".additional-info .input-style").attr("disabled", false);
		$("#image-picker").removeClass('d-none');
		$(this).hide();
		$(".update-profile").show()
	});



	$('#datepicker').datepicker({
		uiLibrary: 'bootstrap4'
	});

});
