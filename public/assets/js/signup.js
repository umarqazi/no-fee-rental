$(() => {
    let response = false;
    let $selector = $('input[name=license_number]');
    let $first_name = $('input[name=first_name]');
    let $last_name = $('input[name=last_name]');
    $selector.on('blur', async () => {
        let license_number = $selector.val();
        let res = await ajaxRequest(
            `https://data.ny.gov/resource/yg7h-zjbf.json?license_number=${license_number}`,
            'GET',
            {"$limit" : 5000, "$$app_token" : "r2d5ljgcgGPadDzIIgzTzu5Qf"},
            false);

        if(res.length > 0) {
            if($('#license-number-error').length > 0) return;
            response = true;
            if($('#license-success').length > 0) $('#license-success').remove();
            if($('#license-number-error').length > 0) return;
            let splitted_string = res[0].license_holder_name.split(" ") ;
            $first_name.val(splitted_string[0]);
            $last_name.val(splitted_string[1]);
            $('#license-error').remove();
            $('input[type=submit]').removeAttr('disabled');
            $selector.after(`<label id="license-success" class="success" for="license_number">License Number verified.</label>`);
        } else {
            if($('#license-error').length > 0) return;console.log('run');
            $first_name.val('');
            $last_name.val('');
            $('#license-success').remove();
            $('input[type=submit]').attr({'disabled': 'true'});
            $selector.after(`<label id="license-error" class="neigh" for="license_number">Invalid License Number.</label>`);
        }
    },2000);
    
});


