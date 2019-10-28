
$(() => {
    $('.add-more').on('click', function() {
        let i = 0, $body = $('body');
        if($body.find('.datepicker-withtime > div.row').length > 4) return;
        $('.open-house-admin-section > div > .row:last').after($body.find('.datepicker-withtime > div.row:last').clone());
        enableDatePicker('.open-house-date:last', false);
        $('.by-add-only > input').each(function() {
            let id = 'chk' + (++ i);
            $(this).attr('id', id);
            $(this).siblings('label').attr('for', id);
        });
    });

    $('body').on('click', '.remove-open-house', function() {
        $(this).parents('.row:first').remove();
    })
});
