"use strict";

let sortOrder;
$(() => {
    let $body = $('body');

    let queries = JSON.parse(localStorage.getItem('search-queries'));
    let bath = null, bed = null, square_feet_min = null, square_feet_max = null, neighborhood = null, price_min = null, price_max = null, open_house = null;

    $body.on('change', '.sorting', function() {
        let url = window.location.href;
        let sorting = $(this).val();
        window.location = sortOrder === '' ? window.location.href + sortValue(url, sorting) : removeOldSort(url, sorting);
    });

    $('#baths').find('li').on('click', function() {
        bath = $(this).text();
        bath = bath.replace(/\s/g, '');
    });

    $('#beds').find('li').on('click', function() {
        bed = $(this).text();
        bed = bed.replace(/\s/g, '');
    });

    $('input[name=neighborhoods]').on('keydown', function(e) {
        let $val = $('input[name=neighborhoods]').val();
        neighborhood = $val.length > 0 ? $val : null;
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

    $body.on('submit', '#search', function(e) {
        neighborhood = $(this).find('#neigh').val();
        let searchQuery = {
            baths: bath,
            neighborhood: neighborhood,
            beds: bed,
            price_min: price_min,
            price_max: price_max,
            square_feet_min: square_feet_min,
            square_feet_max: square_feet_max
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
        queries.forEach((v, i) => {
            let url = window.location.origin + `/search?neighborhoods=${v.neighborhood !== null ? v.neighborhood : '' + v.beds !== null ? '&beds=' + v.beds : '' + v.baths !== null ? '&baths=' + v.baths : '' + v.price_min !== null ? '&priceRange%5Bmin_price%5D=' + v.price_min : '' + v.price_max !== null ? '&priceRange%5Bmax_price%5D=' + v.price_max : '' + v.square_feet_min !== null ? '&priceRange%5Bmin_price_2%5D=' + v.square_feet_min : '' + v.square_feet_max !== null ? '&priceRange%5Bmax_price_2%5D=' + v.square_feet_max : ''}`;
            $('#empty-keywords').remove();
            $('.dropDown').prepend(`
                <a href="${url}">
                    <span>
                       NYC ${(v.neighborhood !== "" ? ' - ' + v.neighborhood : '') + (v.beds !== null ? ' ' + v.beds + ' bed' : '') + (v.baths !== null ? ' ' + v.baths + ' bath' : '')}
                    </span>
                </a>
             `);
        });
    } else {
        if($('#empty-keywords').length > 0) return;
        $('.dropDown').append('<a href="javascript:void(0);" id="empty-keywords">You have no keywords yet to search</a>');
    }
});

window.onload = function() {
    sortOrder = $('.sorting').val();
};

/**
 *
 * @param url
 * @param newSort
 * @returns {*}
 */
function removeOldSort(url, newSort) {
     let oldSort = sorting(sortOrder);
     oldSort = str_has(url, `?${oldSort}`) ? `?${oldSort}` : `&${oldSort}`;
     url = url.replace(`${oldSort}`, ' ');
     url = url.split(' ');
     return url[0] + sortValue(url, newSort);
}

/**
 *
 * @param url
 * @param sort
 * @returns {*}
 */
function sortValue(url, sort) {
    let sortBy = null;
    sortBy = sorting(sort);
    let operator = str_has(url, '?') ? '&' : '?';
    return  operator + sortBy;
}

/**
 *
 * @param sorting
 */
function sorting(sorting) {
    let sortBy = null;
    switch (sorting) {
        case 'recent':
            sortBy = 'recent=recent';
            break;
        case 'cheaper':
            sortBy = 'cheaper=cheaper';
            break;
        case 'petPolicy':
            sortBy = 'petPolicy=petPolicy';
            break;
    }

    return sortBy;
}

/**
 *
 * @param $string
 * @param $word
 * @returns {*}
 */
function str_has($string, $word) {
    return $string.includes($word);
}
