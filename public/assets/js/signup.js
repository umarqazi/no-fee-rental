$(() => {
    let response = false;
    let $selector = $('input[name=license_number]');
    $selector.on('blur', async () => {
        let license_number = $selector.val();
        let res = await ajaxRequest(
            `https://data.ny.gov/resource/yg7h-zjbf.json?license_number=${license_number}`,
            'GET',
            {"$limit" : 5000, "$$app_token" : "r2d5ljgcgGPadDzIIgzTzu5Qf"},
            false);

        if(res.length > 0) {
            response = true;
            if($('#license-success').length > 0) return;
            $('#license-error').remove();
            $('input[type=submit]').removeAttr('disabled');
            $selector.after(`<label id="license-success" class="success" for="baths">License Number verified.</label>`);
        } else {
            if($('#license-error').length > 0) return;
            $('#license-success').remove();
            $('input[type=submit]').attr({'disabled': 'true'});
            $selector.after(`<label id="license-error" class="neigh" for="baths">Invalid License Number.</label>`);
        }
    });
});
