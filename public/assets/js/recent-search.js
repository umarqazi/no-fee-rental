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

    $('input[name=neighborhoods] , select[name=neighborhoods]').on('change', function() {
        let $nSelector = $("select[name=neighborhoods] option:selected");
        let $val = $('input[name=neighborhoods]').val();
        neighborhood = $val.length > 0 ? $val : ($nSelector.text().length > 0 ? $nSelector.text() :null);
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
            if(result.length > 2) {
                $('.dropDown > ul.ul-border-top > li ').prepend(`
                <a href="${v.url}">
                       NYC ${(v.neighborhood !== "" ? ' - ' + v.neighborhood : '') + (v.beds.length > 0  ? ' ' + v.beds + ' beds' : '') + (v.baths.length > 0 ? ' ' + v.baths + ' baths' : '')+(v.price_min !== "" ? ' - ' + v.price_min + ' Min Price' : '')+(v.price_max !== "" ? ' - ' + v.price_max+ ' Max Price' : '')+(v.square_feet_min !== "" ? ' - ' + v.square_feet_min + ' Min Square Feet' : '')+(v.square_feet_max !== "" ? ' - ' + v.square_feet_max + ' Max Square Feet' : '')+(v.open_house !== "" ? ' - ' + v.open_house  + ' Open House' : '')}
                </a> | `);
            } else {
                $('.dropDown > ul.neighborhoods_amenities > li ').prepend(`
                <a href="${v.url}">
                       NYC ${(v.neighborhood !== "" ? ' - ' + v.neighborhood : '') + (v.beds.length > 0  ? ' ' + v.beds + ' bed' : '') + (v.baths.length > 0  ? ' ' + v.baths + ' bath' : '')}
                </a> | `);
            }
        });
    } else {
        if($('#empty-keywords').length > 0) return;
        $('.dropDown').append('<a href="javascript:void(0);" id="empty-keywords">You have no keywords yet to search</a>');
    }
});
