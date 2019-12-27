"use strict";

$(() => {

    let $body = $('body');
    let queries = JSON.parse(localStorage.getItem('search-queries'));
    let bath = [], bed = [], square_feet_min = null, square_feet_max = null, neighborhood = null, price_min = null, price_max = null, open_house = null;

    // Price Range slider variables
    let price_min_left = 0.0 , price_max_left = 100.0 , width = 100.0 ;

    $('.search-bath').find('li > input').on('click', function(e){
        if(e.originalEvent.isTrusted == true){
            let index = $(this).val() !== 'any' ? $(this).val() : 0;
            if($.inArray($(this).val(), bath) == -1) {
                $(this).parents('.main-bath-search').length !== 0 ?
                $($('.search-bath:last')).find('li > input')[index].click() : $($('.search-bath:first')).find('li > input')[index].click() ;
                bath.push($(this).val());
            }
            else {
                bath.splice($.inArray($(this).val(), bed),1);
                $(this).parents('.main-bath-search').length !== 0 ?
                $($('.search-bath:last')).find('li > input')[index].click() : $($('.search-bath:first')).find('li > input')[index].click() ;
            }
        }
    });

    $('.search-beds').find('li > input').on('click', function(e){
        if(e.originalEvent.isTrusted == true){
            let index = $(this).val() !== 'studio' ? $(this).val() : 0;
            if($.inArray($(this).val(), bed) == -1) {
                $(this).parents('.main-search-beds').length !== 0 ?
                $($('.search-beds:last')).find('li > input')[index].click() : $($('.search-beds:first')).find('li > input')[index].click() ;
                bed.push($(this).val());
            }
            else {
                bed.splice($.inArray($(this).val(), bed),1);
                $(this).parents('.main-search-beds').length !== 0 ?
                $($('.search-beds:last')).find('li > input')[index].click() : $($('.search-beds:first')).find('li > input')[index].click() ;
            }
        }
        console.log(bed);
    });

    $('.search-neighborhood').find('input,select').on('change', function(e){
        $(this).attr('id') ?
            ($('.search-neighborhood').find('select').val($(this).val()),
                neighborhood = $(this).val()) :
            ($('.search-neighborhood').find('input').val($(this).val()) ,
                neighborhood = $(this).val()) ;
    });

    $('input[name=min_price]').on('change', function() {
       width = parseFloat($('#slider-range > div').css('width'));
       $(this).val() > price_min ? (
             width = width - ($(this).val()/10000 * 100 - price_min/10000 * 100),
             price_min = $(this).val(),
             price_min_left = $(this).val()/10000 * 100) :
             ( width = width + (price_min/10000 * 100 - $(this).val()/10000 * 100),
             price_min = $(this).val(),
             price_min_left = $(this).val()/10000 * 100 ) ;
       $('#min_price').val(price_min);
       $('#slider-range > span:first').css("left",price_min_left+'%');
       $('#slider-range > div').css("left",price_min_left+'%');
       $('#slider-range > div').css("width",width+'%');
    });

    $('input[name=max_price]').on('change', function() {
        width = parseFloat($('#slider-range > div').css('width'));
           $(this).val()/10000 * 100 < price_max_left ? (
            width = width - (price_max_left - $(this).val()/10000 * 100) ,
            price_max = $(this).val(),
            price_max_left = $(this).val()/10000 * 100) :
            ( width = width + (($(this).val()/10000 * 100) - price_max_left) ,
            price_max = $(this).val(),
            price_max_left = $(this).val()/10000 * 100 ) ;
       $('#max_price').val(price_max);
       $('#slider-range > span:last').css("left",price_max_left+'%');
       $('#slider-range > div').css("width",width+'%');
    });

    $body.on('min-price', function(e, res) {
        price_min = res;
        $('input[name=min_price]').val(res);
    });

    $body.on('max-price', function(e, res) {
        price_max = res;
        $('input[name=max_price]').val(res);
    });

    $body.on('square-min', function(e, res) {
        square_feet_min = res;
    });

    $body.on('square-max', function(e, res) {
        square_feet_max = res;
    });

    $body.on('blur' ,'input[name=openHouse]', function() {
        open_house = $(this).val();
    });

    $body.on('submit', '#search , #advance-search , #index-search-from', async function() {
        let searchQuery = {
            isNew: true,
            baths: bath,
            neighborhood: neighborhood,
            beds: bed,
            price_min: price_min,
            price_max: price_max,
            square_feet_min: square_feet_min,
            square_feet_max: square_feet_max,
            open_house  : open_house
        };

        let query = [];
        query.push(searchQuery);

        if(!queries) {
            localStorage.setItem('search-queries', JSON.stringify(query));
            return;
        }

        if(queries.length < 5) {
            if(queries.length > 0) {
                queries.push(searchQuery);
                localStorage.setItem('search-queries', JSON.stringify(queries));
            } else {
                localStorage.setItem('search-queries', JSON.stringify(query));
            }
        } else {
            queries.shift();
            queries.push(searchQuery);
            localStorage.setItem('search-queries', JSON.stringify(queries));
        }
    });

    if(queries && queries.length > 0) {
        /*let selected = queries[queries.length - 1] ;
        if (selected.beds.length > 0 ){
            $($('#advance-search-beds').find('li > input') ).each(function(index) {
                for (let i = 0 ; i < selected.beds.length ; i++) {
                    if($(this).val() == selected.beds[i]){
                        $(this).trigger( "click");
                        $(this).attr('checked' , true);
                        break ;
                    }
                }

            });
        }
        if (selected.baths.length > 0 ){
            $($('#advance-search-baths').find('li > input') ).each(function(index) {
                for (let i = 0 ; i < selected.baths.length ; i++) {
                    if($(this).val() == selected.baths[i]){
                        $(this).trigger( "click" );
                        $(this).attr('checked' , true)
                        break ;
                    }
                }

            });
        }
        if (selected.price_min !== null){
            setTimeout(() => {
                price_min = selected.price_min ;
                $('#min_price').val(selected.price_min);
                let percentage = (selected.price_min / 10000) * 100 ;
                $('#slider-range > span:first').css("left",percentage+'%');
                $('#slider-range > div').css("left",percentage+'%');
                $('#slider-range > div').css("width",100-percentage+'%');
            }, 100);
        }
        if (selected.price_max !== null){
            setTimeout(() => {
                price_max = selected.price_max ;
                $('#max_price').val(selected.price_max);
                let percentage = (selected.price_max / 10000) * 100 ;
                let width =  parseFloat($('#slider-range > div').css('width')) ;
                $('#slider-range > span:last').css("left",percentage+'%');
                $('#slider-range > div').css("width",(width -(100-percentage)+'%'));
            }, 100);
        }
        if (selected.neighborhood !== null){
            let current ;
            $('input[name=neighborhoods]').val(selected.neighborhood);
            $('select[name=neighborhoods] option').each(function(index) {
                if($(this).text() == selected.neighborhood){
                    current = $( this ).val() ;
                }
            });
            $('select[name=neighborhoods]').val(current);
            neighborhood = selected.neighborhood ;
        }*/

        queries.forEach(async (v, i) => {
            if(v.isNew === true) {
                let currentQuery = queries[i];
                currentQuery.isNew = false;
                currentQuery.url = window.location.href;
                localStorage.setItem('search-queries', JSON.stringify(queries));
            }
            $('#empty-keywords').remove();
            $('.dropDown > ul.neighborhoods_amenities').prepend(`<li>
                <a href="${v.url}" class="recent" data-id = "${i}" >
                        ${
            (v.neighborhood !== null ? 'Listings in ' + v.neighborhood : 'Listings ') +
            (v.beds.length > 0  ?
                (v.beds.length > 1 ?
                    ' with ' + v.beds.sort() + ' bedrooms' : (v.beds[0] > 1 || v.beds[0] == '5+' ? ' with ' + v.beds + ' bedrooms' : ' with ' + v.beds + ' bedroom')): '') +
            (v.baths.length > 0  ?
                (v.baths.length > 1 ?
                    ' with at least ' + v.baths.sort() + ' bathrooms' : (v.baths[0] > 1 || v.baths[0] == '5+' ? ' with at least ' + v.baths + ' bathrooms' : ' with at least ' + v.baths + ' bathroom') ): '')+
            (v.price_min !== null ?
                (v.price_max !== null ?
                    ' between $' + formatNumber(v.price_min) + ' and $' + formatNumber(v.price_max) : 'above $' + formatNumber(v.price_min) ) :
                (v.price_max !== null ?
                    ' under $' + formatNumber(v.price_max) : '' ))+
            (v.square_feet_min !== null ?
                (v.square_feet_max !== null ?
                    ' between ' + formatNumber(v.square_feet_min) + ' ft² and ' + formatNumber(v.square_feet_max) + ' ft² ' : 'above ' + formatNumber(v.square_feet_min) + 'ft²' ) :
                (v.square_feet_max !== null ?
                    ' under ' + formatNumber(v.square_feet_max) + ' ft²' : '' ))+
            (v.open_house !== null && v.open_house !== ''  ? ' with Open House ' + v.open_house : '')}
                </a> </li>`);
        });
    } else {
        if($('#empty-keywords').length > 0) return;
        $('.dropDown').append('<a href="javascript:void(0);" id="empty-keywords">You have no keywords yet to search</a>');
        $('.dropDown > ul').removeClass('ul-border-top');
    }

    function formatNumber(num) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
    }

    $body.on('click', '.recent', async function(e) {
        let temp = JSON.parse(localStorage.getItem('search-queries'));
        temp.push(temp[$(this).attr('data-id')]);
        for(let i = 0 ; i < temp.length ; i++){
            if(i >= $(this).attr('data-id')) {
                temp[i] = temp[i + 1] ;
            }
        }
        temp.pop();
        localStorage.setItem('search-queries', JSON.stringify(temp)) ;
    });

});
