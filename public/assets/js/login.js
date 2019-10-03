
$(() => {
	$('body').on('form-success-login_form', function(event, res) {
	    if(window.location.pathname !== '/') {
	        window.location.reload();
	        return;
        }
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
