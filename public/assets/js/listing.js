$(() => {

    $('.input-style').attr('disabled', false);

    $('body').on('change', '#upload-file', function(e) {
    	let file = e.target.files[0];
    	imagePreview(file, '#img');
    	$('#img').attr('style', 'width: 180px;height: 145px;margin-bottom: 15px;');
    });

    $('body').on('click', '#add-user', function() {
        $('#add_user').attr('action', '/admin/create-user');
        $('.modal-title').text('Add User');
        $('.modal-footer input').val('Add User');
        $('#user_type').val('');
        $('input[type=text], input[type=email]').val('');
    });



    if(localStorage.getItem('tab')) {
        $('body').find('.nav-item, .active').removeClass('active');
        $('span.page-link').parents('li.page-item').addClass('active');
        $(`a[href="#${localStorage.getItem('tab')}"]`).addClass('active');
        $('.tab-content').find('#'+localStorage.getItem('tab')).removeClass('fade');
        $('.tab-content').find('#'+localStorage.getItem('tab')).addClass('active');
        localStorage.removeItem('tab');
    } else {
        $('.nav-link:first, .tab-content > .tab-pane:first').addClass('active');
    }

    $('body').on('click', '.info > a', async function(e) {
        e.preventDefault();
        if(await confirm('Are you sure?')) {
            let currentTab = $(this).parents('div.active').attr('id');
            localStorage.setItem('tab', currentTab);
            window.location.href = $(this).attr('href');
        }
    });

    $('body').on('click', '.page-link', function(e) {
        e.preventDefault();
        let currentTab = $(this).parents('div.active').attr('id');
        localStorage.setItem('tab', currentTab);
        if(e.target.href) {
            window.location.href = e.target.href;
        }
    });
});

/**
 * live preview the image
 *
 * @return void
 */
function imagePreview(file, targetId) {
        let fr = new FileReader();
        fr.onload = function(e) {
            $(targetId).attr('src', e.target.result);
        }

        fr.readAsDataURL(file);
    }

/**
 * build collection for api
 * collected data.
 *
 * @return void
 */

async function remove(id, image) {
    await ajaxRequest(`/admin/remove-listing-image/${id}`, 'get');
    $(image).remove();
}

function confirm(msg) {
    return swal({
      title: "Are you sure?",
      text: msg,
      icon: "warning",
      buttons: [
        'No, cancel it!',
        'Yes, I am sure!'
      ],
      dangerMode: true,
    }).then(function(isConfirm) {
      return (isConfirm) ? true : false
    });
}

function ajaxRequest(url, type, loader = false) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
        },
    });
    
    return $.ajax({
        url: url,
        type: type,
        beforeSend: function() {

        },

        success: function(res) {
            return res;
        },

        error: function(err) {
            toastr.error(err);
        }
    });
}
