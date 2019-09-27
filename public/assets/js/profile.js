$(() => {
    $('body').on('keydown', '.amsify-suggestags-input', function (event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            return false;
        }
    });


    $('input[name=profile_image]').on('change', async function (e) {
        let file = $(this)[0].files[0];
        await livePreview(file, '#view_profile');
    });


    $('#image-picker').hide();

    $(".edit-profile").click(function () {
        $('#image-picker').show();
        $(".additional-info .input-style").attr("disabled", false);
        $(this).hide();
        $(".update-profile").show();
    });

    $(".update-profile").click(function () {
        $(this).hide();
        $(".edit-profile").show()
    });

});
