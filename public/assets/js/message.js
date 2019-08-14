$(() => {
    $("#schedule").datepicker({
        showHour: true,
        showMinute: true,
        showSecond: true,
        showTime: true,
        stepHour: 1,
        stepMinute: 1,
        stepSecond: 1,
        stepMillisec: 1,
        stepMicrosec: 1,
        dateFormat: 'yy-mm-dd',
        alwaysSetTime: true,
        separator: ' ',
        altFieldTimeOnly: true,
        altTimeFormat: null,
        altSeparator: null,
        altTimeSuffix: null,
        altRedirectFocus: true,
        pickerTimeFormat: null,
        pickerTimeSuffix: null,
        showTimepicker: true,
        timezoneList: null,
        sliderAccessArgs: null,
        controlType: 'slider',
        oneLine: false,
        defaultValue: null,
        parse: 'strict',
        afterInject: null
    });

    /**
     * Confirm the accepted chat
     */
    $('#reply').on('click', async function(e) {
        e.preventDefault();
       if(await confirm('You want to set a meeting?')) {
           let meeting_id = $(this).attr('meeting_id');
           if(await ajaxRequest(`accept-meeting/${meeting_id}`, 'post')) {
               $('#message-modal').modal('show');
               return true;
           }
       }
    });

    /**
     * load chat history
     */
    $('#load_chat').on('click', async function(e) {
        e.preventDefault();
        let inbox_id = $(this).attr('inbox_id');
        if(await ajaxRequest(`load-chat/${inbox_id}`,'post')) {

        }
    });
});
