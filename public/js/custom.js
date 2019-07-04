$(() => {
    $.ajaxSetup({
    	headers: {
    		'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
    	},
    });

    $('.input-style').attr('disabled', false);


    $('body').on('change', '#upload-file', function(e) {
    	let file = e.target.files[0];
    	imagePreview(file, '#img');
    	$('#img').attr('style', 'width: 180px;height: 145px;margin-bottom: 15px;');
    });

    function imagePreview(file, targetId) {
    	let fr = new FileReader();
    	fr.onload = function(e) {
    		$(targetId).attr('src', e.target.result);
    	}

    	fr.readAsDataURL(file);
    }

    $('body').on('click', '#add-user', function() {
        $('#add_user').attr('action', '/admin/create-user');
        $('.modal-title').text('Add User');
        $('.modal-footer input').val('Add User');
        $('#user_type').val('');
        $('input[type=text], input[type=email]').val('');
    });
});