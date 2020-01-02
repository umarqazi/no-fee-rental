
let $body = $('body');
let $get_start_form = $('#get_started');

$body.on('keydown', function(e) {
    if (e.keyCode === 13 && $body.find('#get_started > *').hasClass('show')) {
        e.preventDefault();
    }
});

$('.get_started_next_btn').on('click', function() {
    let next = $(this).attr('next');
    let current = $(this).attr('current');
    let beds = $(this).parents('.modal-dialog-centered').find('.modal-body > div > div > ul');
    if(beds[0]) {
        if(!beds.find('li').hasClass('white-border-chkbox')) {
            if($body.find('.get_start_error').length > 0) return;
            beds.after('<span class="error get_start_error">Bedrooms is required</span>'); return;
        }
    }
    if($get_start_form.valid()) {
        $('.get_start_error').remove();
        $(`#${current}`).modal('hide');
        $(`#${next}`).modal('show');
    }
});
