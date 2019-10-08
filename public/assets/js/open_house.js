
$(() => {
    $('.add-more').on('click', function() {
        let i = 0;
        $('.add-more-btn').before($('body').find('.datepicker-withtime > div.row:first').clone());
        enableDatePicker('.open-house-date', false);
        $('.by-add-only > input').each(function() {
            let id = 'chk' + (++ i);
            $(this).attr('id', id);
            $(this).siblings('label').attr('for', id);
        });
    });
});
