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
        bed = [];
    if($("#main-search-beds option:selected").text() !== 'Beds') {
        bed.push($("#main-search-beds option:selected").text());
        $($('#beds').find('li > input') ).each(function(index) {
            if($(this).attr('checked')){
                $(this).attr('checked', false);
            }
            if($(this).val() == $("#main-search-beds option:selected").val()){
                $(this).attr('checked' , true);
            }

        });
    }

    else  {
         bed = [];
    }

    });

    $('#main-search-priceRange').on('change', function() {
      if($("#main-search-priceRange option:selected").val() !== '') {
          price_max = $("#main-search-priceRange option:selected").val();
          $('#max_price').val(price_max);
      }
      else {
          price_max = null ;
      }
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
        $('input[name=neighborhoods]').val($nSelector.text());
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
        let selected = queries[queries.length - 1] ;
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
                                    ' between $' + formatNumber(v.price_min) + ' and $' + formatNumber(v.price_max) +' and' : 'above $' + formatNumber(v.price_min) ) :
                                (v.price_max !== null ?
                                    ' under $' + formatNumber(v.price_max) : '' ))+
                            (v.square_feet_min !== null ?
                                (v.square_feet_max !== null ?
                                    ' between ' + formatNumber(v.square_feet_min) + ' ft² and ' + formatNumber(v.square_feet_max) + ' ft² ' : 'above ' + formatNumber(v.square_feet_min) + 'ft²' ) :
                                (v.square_feet_max !== null ?
                                    ' under ' + formatNumber(v.square_feet_max) + ' ft²' : '' ))+
                            (v.open_house !== null ? ' with Open House ' + v.open_house : '')}
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
});
