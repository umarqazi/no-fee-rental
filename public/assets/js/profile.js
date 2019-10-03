$(() => {
    $('body').on('keydown', '.amsify-suggestags-input', function(event){
        if(event.keyCode === 13) {
            event.preventDefault();
            return false;
        }
    });

    $('input[name=profile_image]').on('change', async function(e) {
         let file = $(this)[0].files[0];
        await livePreview(file, '#view_profile');
    });
});
