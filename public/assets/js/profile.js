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


    $(".additional-info .input-style").attr("disabled", true);
    $(".edit-profile").click(function () {
        $('#image-picker').show();
        $(".additional-info .input-style").attr("disabled", false);
        CKEDITOR.replace( 'description' );
        $(this).hide();

        if($('#exclusive-3').is(":checked")){
            $('#exclusive-1').attr('disabled', true);
            $('#exclusive-2').attr('disabled', true);
        }

        $(".update-profile").show();
    });

    $(".update-profile").click(function () {
        $(this).hide();
        $(".edit-profile").show()
    });



});
