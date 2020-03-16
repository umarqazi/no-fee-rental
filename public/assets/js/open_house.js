
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
    });

    $('body').on('blur', '.open-house-date', function () {

        let start = $(this).parents('.openhouse').find('.start');
        let end = $(this).parents('.openhouse').find('.end');
        if($(this).val() !== '') {
            start.rules('add', {required: true, messages: { required: 'Start Time is required.' } });
            end.rules('add', {required: true, messages: { required: 'End Time is required.' }});
            return;
        }

        if($(this).val() === '') {
            start.rules('remove');
            end.rules('remove');
        }
    });
});
