
let $let_us_help_form = $('#let_us_help');

$body.on('keydown', function(e) {
    if (e.keyCode === 13 && $body.find('#let_us_help > *').hasClass('show')) {
        e.preventDefault();
    }
});

$('.let_us_help_prev_btn').on('click', function () {
    let prev = $(this).attr('prev');
    let current = $(this).attr('current');
    $(`#${current}`).modal('hide');
    $(`#${prev}`).modal('show');
});

$('.let_us_help_next_btn').on('click', function() {
    let next = $(this).attr('next');
    let current = $(this).attr('current');
    let name = $('#let-us-step4').find('input[name=username]').val();
    if(name !== '') {
        name = name.split(' ');
        $body.find('#thanks-name').text('Thanks '+name[0]);
    }
    let beds = $(this).parents('.modal-dialog-centered').find('.modal-body > div > div > ul');
    if(beds[0]) {
        if(!beds.find('li').hasClass('white-border-chkbox')) {
            if($body.find('.let_us_help_error').length > 0) return;
            beds.after('<span class="error let_us_help_error">Bedrooms is required</span>'); return;
        }
    }
    if($let_us_help_form.valid()) {
        $('.let_us_help_error').remove();
        $(`#${current}`).modal('hide');
        $(`#${next}`).modal('show');
    }
});

let $location = null;
$('input[name=location_preference]').on('click', function () {
    $location = $(this).attr('id');
});

$('#location-preference-button').on('click', function () {
    $(`#let-us-step8`).modal('hide');
    $(`#${$location}-modal`).modal('show');
});

$('input[name=location-preference]').on('click', function () {
    console.log($(this));
});

$('.next-modal').on('click', function () {
    $('#let-us-step2').modal('show');
});

$('#spend').on('input', function () {
    let price = $(this).val();
    $('#invest').text('$'+price);
});