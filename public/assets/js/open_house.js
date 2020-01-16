
$(() => {
    let i = 0;
    $('.add-more').on('click', function() {
        let $body = $('body');
        let string = $body.find('.datepicker-withtime > div.row:last').find('input:first').attr('name');
        i = string.match(/\d+/g);
        let mark = ++ i;
        let newEntry = $body.find('.datepicker-withtime > div.row:last').clone();
        if($body.find('.datepicker-withtime > div.row').length > 4) return;
        $('.open-house-admin-section > div > .row:last').after(newEntry);
        $(newEntry).find('input:first').attr('name', `open_house[${mark}][date]`);
        $(newEntry).find('select:first').attr('name', `open_house[${mark}][start_time]`);
        $(newEntry).find('select:last').attr('name', `open_house[${mark}][end_time]`);
        $(newEntry).find('input:last').attr({'name': `open_house[${mark}][by_appointment]`, 'id': mark});
        $(newEntry).find('.by-add-only > label').attr('for', mark);
        enableDatePicker('.open-house-date:last', false);
    });

    $('body').on('click', '.remove-open-house', function() {
        $(this).parents('.row:first').remove();
    })
});
