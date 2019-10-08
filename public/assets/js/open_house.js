
$(() => {
    $('.add-more').on('click', function() {
        let i = 0;
        $('.add-more-btn').before($('body').find('.datepicker-withtime > div.row:first').clone(true));
        $('.open-house-date').each(function() {
            $(this).attr('id', ++ i);
            // console.log('#'+$(this).attr('id'));
            enableDatePicker('#'+$(this).attr('id'), false);
        })
    });
});
