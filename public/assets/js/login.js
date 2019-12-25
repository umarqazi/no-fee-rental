
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

    let $login = $('#login');
    $login.on('click', '.fa-eye', function () {
        $(this).removeClass('fa-eye').addClass('fa-eye-slash');
        $(this).siblings('input').attr('type', 'text');
    });

    $login.on('click', '.fa-eye-slash', function () {
        $(this).removeClass('fa-eye-slash').addClass('fa-eye');
        setTimeout(() => {
            $(this).siblings('input').attr('type', 'password');
        }, 10);
    });

    let $signup = $('#signup');
    $signup.on('click', '.fa-eye:first', function () {
    	$(this).removeClass('fa-eye').addClass('fa-eye-slash');
        $(this).siblings('input').attr('type', 'text');
    });

    $signup.on('click', '.fa-eye-slash:first', function () {
        $(this).removeClass('fa-eye-slash').addClass('fa-eye');
        setTimeout(() => {
            $(this).siblings('input').attr('type', 'password');
        }, 10);
    });

    $signup.on('click', '.fa-eye:last', function () {
        $(this).removeClass('fa-eye').addClass('fa-eye-slash');
        $(this).siblings('input').attr('type', 'text');
    });

    $signup.on('click', '.fa-eye-slash:last', function () {
        $(this).removeClass('fa-eye-slash').addClass('fa-eye');
        setTimeout(() => {
            $(this).siblings('input').attr('type', 'password');
        }, 10);
    });
});
