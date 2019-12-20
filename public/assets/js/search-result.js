$(() => {
    if(sessionStorage.getItem("beds")){
        $($('#advance-search-chkbox > #beds').find('li > input') ).each(function(index) {
            if($(this).val() == sessionStorage.getItem("beds")){
                $(this).attr('checked' , true);
            }
        });
        inputsToDropdown('.radio-group-1', sessionStorage.getItem("beds"), 'radio', '.radio-group-1', '');
    }
    else  {
        inputsToDropdown('.radio-group-1', 'Beds', 'radio', '.radio-group-1', '');
    }
    if(sessionStorage.getItem("baths")){
        $($('#advance-search-chkbox > #baths').find('li > input') ).each(function(index) {
            if($(this).val() == sessionStorage.getItem("baths")){
                $(this).attr('checked' , true);
            }
        });
        inputsToDropdown('.radio-group-2', sessionStorage.getItem("baths") , 'radio', '.radio-group-2', '');
    }
    else  {
        inputsToDropdown('.radio-group-2', 'Baths', 'radio', '.radio-group-2', '');
    }


    $('.tabs > div > ul').find('a').on('click', function() {
        let url = window.location.origin;
        let value = $(this.childNodes[0]).val();
        let id = $(this).parent().parent().parent().parent().attr('id');
        if(id == 'beds'){
            if(sessionStorage.getItem("baths")){
                sessionStorage.setItem("beds", value);
                $('input[name=rent_beds]').val(value);
                $('input[name=rent_baths]').val(sessionStorage.getItem("baths"));
                $("#rent-search").submit();
            }
            else {
                sessionStorage.setItem("beds", value);
                $('input[name=rent_beds]').val(value);
                $("#rent-search").submit();
            }
        }
        else{
            if(sessionStorage.getItem("beds")){
                sessionStorage.setItem("baths", value);
                $('input[name=rent_beds]').val(sessionStorage.getItem("beds"));
                $('input[name=rent_baths]').val(value);
                $("#rent-search").submit();
            }
            else {
                sessionStorage.setItem("baths", value);
                $('input[name=rent_baths]').val(value);
                $("#rent-search").submit();
            }
        }
    });

});

