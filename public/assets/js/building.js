let representative = $('input[name=email]');

representative.on('blur', function() {
    ajaxRequest('check-representative', 'post', {email: $(this).val()}).then(res => {
        let username = $('input[name=username]');
        let phone = $('input[name=phone_number]');
        let representative = $('input[name=representative_exists]');

        if(res.data === false) {
            representative.val('false');
            username.val('').removeAttr('readonly');
            phone.val('').removeAttr('readonly');
            return;
        } else if(res.data === null) {
            let $validator = $(`#${$('body').find('form').attr('id')}`).validate();
            let errors = { email: "This email already exists as some other user type." };
            $validator.showErrors(errors);
            return;
        }

        representative.val('true');
        phone.val(res.data.phone_number).attr('readonly', 'readonly');
        username.val(`${res.data.first_name} ${res.data.last_name}`).attr('readonly', 'readonly');
    });
});
initMap('map');
autoComplete('controls');
$('#controls').on('input keydown', function(e) {
    if(e.keyCode === 13) {
        e.preventDefault();
    }
});

$('input[name=thumbnail]').on('change', function (e) {
    livePreview(e.target.files[0], '#preview-img');
});

$('#add_building').on('submit', function(e) {
    if(!$('#add_building').valid()) {
        e.preventDefault();
    }
});