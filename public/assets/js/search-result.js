$(() => {
    if(sessionStorage.getItem("beds")){
        inputsToDropdown('.radio-group-1', sessionStorage.getItem("beds"), 'radio', '.radio-group-1', '');
    }
    else  {
        inputsToDropdown('.radio-group-1', 'Beds', 'radio', '.radio-group-1', '');
    }
    if(sessionStorage.getItem("baths")){
        inputsToDropdown('.radio-group-2', sessionStorage.getItem("baths") , 'radio', '.radio-group-2', '');
    }
    else  {
        inputsToDropdown('.radio-group-2', 'Baths', 'radio', '.radio-group-2', '');
    }
    $('body').on('change', '.sorting', function() {
        let url = window.location.origin;
        url = url.replace('/recent', '');
        url = url.replace('/cheapest', '');
        url = url.replace('/oldest', '');
        window.location.href = url+'/listing-by-rent/'+$(this).val();

    });

    $('.tabs > div > ul').find('a').on('click', function() {
        let url = window.location.origin;
        let value = $(this.childNodes[0]).val();
        let id = $(this).parent().parent().parent().parent().attr('id');
        if(id == 'beds'){
            if(sessionStorage.getItem("baths")){
                window.location.href = url+'/listing-by-rent-filter/'+value+'/'+sessionStorage.getItem("baths") ;
                sessionStorage.setItem("beds", value);
            }
            else {
                window.location.href = url+'/listing-by-rent-filter/'+value;
                sessionStorage.setItem("beds", value);
            }
        }
        else{
            if(sessionStorage.getItem("beds")){
                window.location.href = url+'/listing-by-rent-filter/'+sessionStorage.getItem("beds")+'/'+value ;
                sessionStorage.setItem("baths", value);
            }
            else {
                window.location.href = url+'/listing-by-rent-filter/'+value;
                sessionStorage.setItem("baths", value);
            }
        }
    });

});

