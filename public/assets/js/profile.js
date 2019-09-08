$(() => {
    $('body').on('keydown', '.amsify-suggestags-input', function(event){
        if(event.keyCode === 13) {
            event.preventDefault();
            return false;
        }
    });
});
