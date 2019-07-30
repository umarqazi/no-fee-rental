
$(() => {
	$('body').on('form-success-login_form', function(event, res) {
		window.location.href = res.url;
	});
});