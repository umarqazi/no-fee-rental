$(() => {
    $('body').on('form-success-signup_form', function() {
        $('.check').remove();
    });

    let form = $('#signup_form');
    let $selector = $('input[name=license_number]');
    let $first_name = $('input[name=first_name]');
    let $last_name = $('input[name=last_name]');
    $selector.on('keydown', async () => {
        let license_number = $selector.val();
        if(license_number !== '' && $('[name=license_number]').valid()) {
            let res = await ajaxRequest(
                `https://data.ny.gov/resource/yg7h-zjbf.json?license_number=${license_number}`,
                'GET',
                {"$limit" : 5000, "$$app_token" : "r2d5ljgcgGPadDzIIgzTzu5Qf"},
                true);

            if(res.length > 0) {
                form.append(`<input type="hidden" name="company" value="${res[0].business_name}">`);
                $('.times').remove();
                if($('.check').length > 0) return;
                let str_split = res[0].license_holder_name.split(" ") ;
                $first_name.val(str_split[0]);
                $last_name.val(str_split[1]);
                $('input[type=submit]').removeAttr('disabled');
                message('check', 'License Number Verified');
            } else {
                $('.check').remove();
                $('input[type=submit]').attr({'disabled': 'true'});
                if($('.times').length > 0) return;
                $first_name.val('');
                $last_name.val('');
                message('times', 'Invalid License Number');
            }
        }
    });
});

function message(type, msg) {
    $('.license_num > div > div')
        .after(`
            <div class="col-sm-6 ${type}">
                <div class="verified-icon">
                    <i class="fas fa-${type}-circle"></i>
                    <span>${msg}</span>
                </div>
            </div>`);
}
