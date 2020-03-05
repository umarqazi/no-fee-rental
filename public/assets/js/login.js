
$(() => {

    // Form Success Event
	$('body').on('form-success-login_form', function(event, res) {
	    if(window.location.pathname !== '/') {
	        window.location.reload();
	        return;
        }

		window.location.href = res.url;
	});

	// Toggle Modal Sign-up to Login
	$('#login-btn').on('click', function() {
	    $('#signup').modal('hide');
	    $('#login').modal('show');
    });

    // Toggle Modal Login to Sign-up
    $('#signup-btn').on('click', function() {
        $('#signup').modal('show');
        $('#login').modal('hide');
    });

    // Login Form Password Show Hide
    $('#login').on('click', '.fa-eye', function () {
        toggleEye($(this));
    });
});
