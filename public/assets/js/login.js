
$(() => {
	$('body').on('form-success-login_form', function(event, res) {
		window.location.href = res.url;
	});

	$('#login-btn').on('click', function() {
	    $('#signup').modal('hide');
	    $('#login').modal('show');
    });

    $('#signup-btn').on('click', function() {
        $('#signup').modal('show');
        $('#login').modal('hide');
    });
});
