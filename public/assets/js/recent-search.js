"use strict";

$(() => {

    let $body = $('body');
    let queries = JSON.parse(localStorage.getItem('search-queries'));
    let bath = [], bed = [], square_feet_min = null, square_feet_max = null, neighborhood = null, price_min = null, price_max = null, open_house = null;


    $('#baths').find('li').one('click', function() {
        bath.push($(this).text().replace(/\s/g, ''));
    });

    $('#beds').find('li').one('click', function() {
        bed.push($(this).text().replace(/\s/g, ''));
    });

    $('#main-search-beds').on('change', function() {
        bed.push($("#main-search-beds option:selected").text());
        $($('#beds').find('li > input') ).each(function(index) {
            if($(this).attr('checked')){
                $(this).attr('checked', false);
            }
            if($(this).val() == $("#main-search-beds option:selected").val()){
                $(this).attr('checked' , true);
            }

        });
    });

    $('#main-search-priceRange').on('change', function() {
        price_max = $("#main-search-priceRange option:selected").val();
        $('#max_price').val(price_max);
    });

    $('input[name=neighborhoods]').on('change', function() {
        let $select = $("select[name=neighborhoods] option");
        let $val = $('input[name=neighborhoods]').val();
        let $currentSelect ;
        if ($val.length > 0){
            $( $select ).each(function(index) {
                if($(this).text() == $val){
                    $currentSelect = $( this ).val() ;
                }
            });
                $("select[name=neighborhoods]").val($currentSelect);
        }
        neighborhood = $val ;
    });

    $('select[name=neighborhoods]').on('change', function() {
        let $nSelector = $("select[name=neighborhoods] option:selected");
        neighborhood = $nSelector.text();
    });

    $body.on('min-price', function(e, res) {
        price_min = res;
    });

    $body.on('max-price', function(e, res) {
        price_max = res;
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

    $body.on('submit', '#search , #advance-search', async function() {
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
        queries.forEach(async (v, i) => {
            if(v.isNew === true) {
                let currentQuery = queries[i];
                currentQuery.isNew = false;
                currentQuery.url = window.location.href;
                localStorage.setItem('search-queries', JSON.stringify(queries));
            }

            let result = Object.entries(v).reduce((a,[key,val]) => {
                if(val && val.length)
                    a.push({name : key, value : val});
                return a;
            },[]);

            $('#empty-keywords').remove();
           /* if(result.length > 2) {
           */     $('.dropDown > ul.neighborhoods_amenities').prepend(`<li>
                <a href="${v.url}">
                        ${(v.neighborhood !== null ? ' - ' + v.neighborhood : '') + (v.beds.length > 0  ? ' ' + v.beds + ' beds' : '') + (v.baths.length > 0 ? ' ' + v.baths + ' baths' : '')+(v.price_min !== null ? ' - $' + v.price_min + ' Min Price' : '')+(v.price_max !== null ? ' - $' + v.price_max+ ' Max Price' : '')+(v.square_feet_min !== null ? ' - ' + v.square_feet_min + ' Min Square Feet' : '')+(v.square_feet_max !== null ? ' - ' + v.square_feet_max + ' Max Square Feet' : '')+(v.open_house !== null ? ' - ' + v.open_house  + ' Open House' : '')}
                </a> </li> `);
            /*} else {
                $('.dropDown > ul.neighborhoods_amenities > li ').prepend(`
                <a href="${v.url}">
                       NYC ${(v.neighborhood !== null ? ' - ' + v.neighborhood : '') + (v.beds.length > 0  ? ' ' + v.beds + ' bed' : '') + (v.baths.length > 0  ? ' ' + v.baths + ' bath' : '')}
                </a> | `);
            }*/
        });
    } else {
        if($('#empty-keywords').length > 0) return;
        $('.dropDown').append('<a href="javascript:void(0);" id="empty-keywords">You have no keywords yet to search</a>');
        $('.dropDown > ul').removeClass('ul-border-top');
    }
});
