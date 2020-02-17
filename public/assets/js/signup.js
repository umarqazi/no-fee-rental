$(() => {

    let $body = $('body');

    $body.on('form-success-signup_form', function (e, v) {
        $('#signup').modal('hide');
        window.location.href = `/resend-email/${v}`;
    });

    $body.on('click', '#signup-option1', function(e) {
        $('#signup_form').attr({'action': `${window.location.origin}/renter/sign-up`});
    });

    $body.on('click', '#signup-option2', function(e) {
        $('#signup_form').attr({'action': `${window.location.origin}/user/sign-up`});
    });

    $("#signup-option2").trigger('click');
    let form = $('#signup_form');
    let $selector = $('input[name=license_number]');
    let $first_name = $('input[name=first_name]');
    let $last_name = $('input[name=last_name]');
    $selector.prop("disabled",false);
    $selector.on('keyup', async () => {
        let license_number = $selector.val();
        let license_verify = await ajaxRequest(
            `/verify-license`,
            'POST',
            {license_number},
            false);

        if (license_number !== '' && license_verify === 'true' && $selector.val().length > 6) {
            let res = await ajaxRequest(
                `/license-verification/${license_number}`,
                'GET',
                {"$limit": 5000, "$$app_token": "r2d5ljgcgGPadDzIIgzTzu5Qf","$license_number": license_number },
                false);

            if (res.length > 0) {
                form.append(`<input type="hidden" name="company" value="${res[0].business_name}">
                             <input type="hidden" name="address" value="${res[0].business_address_1}">`);

                $('#invited_agent_signup_form').append(`<input type="hidden" name="company" value="${res[0].business_name}">
                             <input type="hidden" name="address" value="${res[0].business_address_1}">`);
                $('.input-style').removeAttr("disabled");
                $('.license_valid-text').text("You provided a valid license. You are welcome to fill the details below and and become a part of NO FEE Rentals NYC.");
                $('.times').remove();
                if ($('.check').length > 0) return;
                let str_split = res[0].license_holder_name ?  res[0].license_holder_name.split(" ") : null ;
                str_split !== null ? $first_name.val(str_split[1]):'' ;
                str_split !== null ? $last_name.val(str_split[0]):'' ;
                $('input[type=submit]').removeAttr('disabled');
                message('check', 'Verified');
            } else {
                $('.license_valid-text').text("We are sorry your license is invalid. Please check your license Number again.");
                $('.check').remove();
                $('input[type=submit]').attr({'disabled': 'true'});
                if ($('.times').length > 0) return;
                $first_name.val('');
                $last_name.val('');
                message('times', 'Invalid License Number');
            }
        }
    });
});

/**
 *
 * @param type
 * @param msg
 */
function message(type, msg) {
    $('.license_num > div.col-sm-6').after(`
            <div class="col-sm-6 ${type}">
                <div class="verified-icon">
                    <i class="fas fa-${type}-circle"></i>
                    <span>${msg}</span>
                </div>
            </div>`);
}
