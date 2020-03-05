
let $body = $('body');
let $form = $('#signup_form #invited_sign_up');

$(() => {

    // Form Success Event Call
    $body.on('form-success-signup_form', function (e, v) {
        $('#signup').modal('hide');
        window.location.href = `/resend-email/${v}`;
    });

    // Form Action For Renter
    $body.on('click', '#signup-option1', function(e) {
        $form.attr({'action': `${window.location.origin}/renter/sign-up`});
    });

    // Form Action For Agent
    $body.on('click', '#signup-option2', function(e) {
        $form.attr({'action': `${window.location.origin}/agent/sign-up`});
    });

    // Sign-up Password Show Hide
    $form.find('.fa-eye:first').on('click', function () {
        toggleEye($(this));
    });

    $form.find('.fa-eye:last').on('click', function () {
        toggleEye($(this));
    });

    // License Number Verification
    let $license_number = $('input[name=license_number]');
    $("#signup-option2").trigger('click');
    $license_number.prop("disabled",false);

    $license_number.on('input blur', async () => {
        let license_number = $license_number.val();
        if(license_number.length >= 11) {
            ajaxRequest(`/verify-license`,'POST',{license_number},false).then(res => {
                if (res === 'true') {
                    ajaxRequest(`/license-verification/${license_number}`,'GET',
                        {"$limit": 5000, "$$app_token": "r2d5ljgcgGPadDzIIgzTzu5Qf","$license_number": license_number },
                        false).then(res => {
                        if(res.length > 0) {

                            success(res);

                        } else { error(); }
                    });

                }
            });
        } else { error(); }
    });
});

let $submit = $('input[type=submit]');
let $first_name = $('input[name=first_name]');
let $last_name = $('input[name=last_name]');

/**
 * Success Handler
 * @param res
 */
function success(res) {
    $('.input-style').removeAttr("disabled");
    $('.license_valid-text').text("You provided a valid license. You are welcome to fill the details below and become a part of NO FEE Rentals NYC.");
    $('.times').remove();
    $form.append(`<input type="hidden" name="company" value="${res[0].business_name}">
                  <input type="hidden" name="address" value="${res[0].business_address_1}">
    `);

    if(res[0].license_holder_name) {
        let str_split = res[0].license_holder_name.split(" ");
        $first_name.val(str_split[1]);  $last_name.val(str_split[0]);
    }

    $submit.removeAttr('disabled');

    if ($body.find('.check').length < 1) {
        message('check', 'Verified');
    }
}

/**
 * Error Handler
 */
function error() {
    $body.find('.check').remove();
    if ($('.times').length < 1) {
        message('times', 'Invalid License Number');
    }

    $body.find('.license_valid-text').text("We are sorry your license is invalid. Please check your license Number again.");
    $submit.attr({'disabled': 'true'});
    $first_name.val(''); $last_name.val('');
    $('.agnet-input').attr('disabled', true);
}

/**
 * Message Display
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