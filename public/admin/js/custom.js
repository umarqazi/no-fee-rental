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

async function updateUser(id) {
	let res = await ajaxRequest(`/admin/edit-user/${id}`, 'post');
        $('#add_user').attr('action', `/admin/update-user/${id}`);
        $('.modal-title').text('Update User');
        $('.modal-footer input').val('Update');
        $('#first_name').val(res.data.first_name);
        $('#last_name').val(res.data.last_name);
        $('#email').val(res.data.email);
        $('#phone_number').val(res.data.phone_number);
        $('#user_type').val(res.data.user_type);
        $('#add-member').modal('show');
}

function ajaxRequest(url, type, loader = false) {
	return $.ajax({
		url: url,
        type: type,
        headers: {
        	'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content'),
        },
        success: function(res) {
        	return res;
        },

        error: function(err) {
        	toastr.error(err);
        }
	})
}