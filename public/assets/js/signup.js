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
            $('#license-error').remove();
            if($('#license-success').length > 0) return;
            $selector.after(`<label id="license-success" class="success" for="baths">License Number verified.</label>`);
            console.log(res);
        } else {
            if($('#license-error').length > 0) return;
            $selector.after(`<label id="license-error" class="neigh" for="baths">Invalid License Number.</label>`);
        }
    });

    $('body').on('submit', '#signup_form', (e) => {
        if(!response) {
            e.preventDefault();
            return;
        }
    });
});
