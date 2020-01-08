"use strict";

$(document).ready(function () {
    let $body = $('body');

    // Neighborhood Select Management
    let $neighborhoods = [];
    $('.index-neighborhood input[type="checkbox"]').click(function(){
        let get_text = null;
        get_text = $(this).next().text();
        if($(this).prop("checked") == true){
            if(!$neighborhoods.includes(get_text)) {
                $neighborhoods.push(get_text);
            }
        }


        if($(this).prop("checked") == false){
            $neighborhoods.splice($neighborhoods.indexOf(get_text), 1);
            if($neighborhoods.length < 2) {
                index_neighborhood($neighborhoods[0]);
                return;
            }
        }

        index_neighborhood(get_text);

    });

    $('.advance-search').on('click', function () {
        $body.find('.fs-label').text('Select Neighborhoods');
        $body.find('.g0').removeClass('selected');
        $body.find('.g0').each((a, v) => {
            if($neighborhoods.includes($(v).find('div').text())) {
                if(!$(v).hasClass('selected')) {
                    $(v).trigger('click');
                }
            }
        });
    });

    $body.find('.g0').on('click', function () {
        let text = $(this).find('div').text();

        if(!$neighborhoods.includes(text)) {
            $neighborhoods.push(text);
            $('.index-neighborhood input[type="checkbox"]').each((a, v) => {
                if($neighborhoods.includes($(v).val())) {
                    $(v).prop('checked', true);
                    return;
                }
            });
        }

        // Unselect Neighborhoods from index
        if($(this).hasClass('selected') && $neighborhoods.includes(text)) {
            $neighborhoods.splice($neighborhoods.indexOf(text), 1);
            $('.index-neighborhood input[type="checkbox"]').each((a, v) => {
                if($(v).prop('checked') && $(v).val() == text) {
                    $(v).prop('checked', false);
                    if($neighborhoods.length == 1) {
                        index_neighborhood($neighborhoods[0]);
                        return;
                    } else {
                        index_neighborhood(text);
                        return;
                    }
                }
            });
        }

        // Select Neighborhoods from index
        else if($(this).hasClass('selected') && !$neighborhoods.includes(text)) {
            $neighborhoods.push(text);
        }

        console.log($neighborhoods);


    });

    // Price Management
    // MIN
    let $slider = $('#slider-range');
    $('#index-min').on('input', function () {
        let val = $(this).val();
        let result = val / 10000;
        $('#min_price').val(val);
        $slider.find('span:first').css({'left': `${result}%`});
        $slider.find('div').css({'left': `${result}%`, 'width': `${100 - result}%`});
    });

    // MAX
    $('#index-max').on('input', function () {
        let val = $(this).val();
        let result = val / 10000;
        let min_val = $('input[name=min_price]').val();
        let rb = min_val / 1000;
        $slider.find('span:last').css({'left': `${result}%`});
        $slider.find('div').css({'left': `${rb}%`,'width': `${result - rb}%`});
        $('#max_price').val($(this).val());
    });

    // MIN Advance
    $('#min_price').on('input', function () {
        $('#index-min').val($(this).val());
    });

    // MAX Advance
    $('#max_price').on('input', function () {
        $('#index-max').val($(this).val());
    });

    // Beds Management
    $('.search-beds:first > ul > li').on('click', function () {
        let $index = $(this).index();
        if($(this).find('input').prop('checked') == true) {
            $('.search-beds:last').find(`ul > li > input:eq(${$index})`).trigger('click');
        }
    });

    $('.search-beds:last > li').on('click', function () {
        let $index = $(this).index();
        if($(this).find('input').prop('checked') == true) {
            $('body').find(`.search-beds:first > ul > li > input:eq(${$index})`).prop('checked', true);
        }
    });



    function index_neighborhood(get_text) {
        if($neighborhoods.length > 1) {
            $('.search-fld').text(`Neighborhoods (${$neighborhoods.length})`);
        } else if($neighborhoods.length < 1) {
            $('.search-fld').text('Neighborhoods');
        } else {
            $('.search-fld').text(get_text !== null ? get_text : $neighborhoods[0]);
        }
    }


    // let $indexNeighborhoods = $body.find('#index-search-from');
    // $indexNeighborhoods.find('.index-neighborhood:first').on('click', function () {
    //     console.log($(this));
    //     let target = $body.find('.search-fld');
    //     let selected = $(this).find('div > label').text();
    //     $neighborhoods.push(selected);
    //     if($neighborhoods.length > 1) {
    //         $(target).text(`Neighborhoods (${$neighborhoods.length})`);
    //     } else {
    //         $(target).text(selected);
    //     }
    //
    //     // advance_search_neighborhood($(this), selected);
    // });
});

// function advance_search_neighborhood(selector, selected) {
//     let $index = $(selector).index();
//     $body.find(`.fs-options > .g0`).each((a, b) => {
//         if($(b).find('div').text() === selected) {
//             $(b).addClass('selected');
//         }
//     })
// }
//     let queries = JSON.parse(localStorage.getItem('search-queries'));
//     let bath = [], bed = [], square_feet_min = null, square_feet_max = null, neighborhood = null, price_min = null, price_max = null, open_house = null;
//
// // Price Range slider variables
//     let price_min_left = 0.0 , price_max_left = 100.0 , width = 100.0 ;
//
//     $('.search-bath').find('li > input').on('click', function(e){
//         if(e.originalEvent.isTrusted == true){
//             let index = $(this).val() !== 'any' ? $(this).val() : 0;
//             if($.inArray($(this).val(), bath) == -1) {
//                if(!$(this).prop('checked') == '') {
//                 $(this).parents('.main-bath-search').length !== 0 ?
//                 $('.search-bath:last').find('li > input')[index].click() : $('.search-bath:first').find('li > input')[index].click();
//                 bath.push($(this).val());
//                 }
//             }
//             else {
//                 bath.splice($.inArray($(this).val(), bed),1);
//                 $(this).parents('.main-bath-search').length !== 0 ?
//
//                 $('.search-bath:last').find('li > input')[index].click() : $('.search-bath:first').find('li > input')[index].click() ;
//             }
//         }
//     });
//
//     $('.search-beds').find('li > input').on('click', function(e){
//         if(e.originalEvent.isTrusted == true){
//             let index = $(this).val() !== 'studio' ? $(this).val() : 0;
//             if($.inArray($(this).val(), bed) == -1) {
//                 if(!$(this).prop('checked') == ''){
//                 $(this).parents('.main-search-beds').length !== 0 ?
//                 $('.search-beds:last').find('li > input')[index].click() : $('.search-beds:first').find('li > input')[index].click() ;
//                 bed.push($(this).val());
//                 }
//             }
//             else {
//                 bed.splice($.inArray($(this).val(), bed),1);
//                 $(this).parents('.main-search-beds').length !== 0 ?
//                 $('.search-beds:last').find('li > input')[index].click() : $('.search-beds:first').find('li > input')[index].click() ;
//             }
//         }
//     });
//
//     $('.search-neighborhood,.search-result-section-neighborhood').find('.neighborhood-list > li > div > label,select,ul > li > div > input').on('click change', function(e){
//         $(this).attr('class') == 'custom-control-label' ?
//             (   $('.search-neighborhood').find('select').val($(this).text()),
//                 $('body').find('.select2-selection__rendered:first').text($(this).text()),
//                 neighborhood = $(this).text()) :
//                 (   neighborhood = $(this).val() ,
//                     $('.search-neighborhood').find('.neighborhood-list > li > div > input').each(function() {
//                     $(this).val() == neighborhood ? $(this).attr('checked', true): null ;
//                 }),
//                 $('.search-fld').text($(this).val()),
//                 $('.neighborhood-field').text(neighborhood),
//                 $('.search-result-section-neighborhood').find('ul > li > div > input').each(function() {
//                     $(this).val() == neighborhood ? $(this).attr('checked', true): null ;
//                 })
//             );
//         $(this).parents('.search-result-section-neighborhood').length > 0 ?
//             (    $('.search-neighborhood').find('select').val($(this).val()),
//                  neighborhood = $(this).val(),
//                 $('body').find('.select2-selection__rendered:first').text($(this).val())) : null ;
//     });
//
//     $('input[name=min_price]').on('change', function() {
//         if($(this).val() > 0 && $(this).val() < 10000  ) {
//
//         width = parseFloat($('#slider-range > div').css('width'));
//         $(this).val() > price_min ?
//           ( width = width - ($(this).val()/10000 * 100 - price_min/10000 * 100),
//             price_min = $(this).val(),
//             price_min_left = $(this).val()/10000 * 100) :
//           ( width = width + (price_min/10000 * 100 - $(this).val()/10000 * 100),
//             price_min = $(this).val(),
//             price_min_left = $(this).val()/10000 * 100 ) ;
//         $('#min_price').val(price_min);
//         $('#slider-range > span:first').css("left",price_min_left+'%');
//         $('#slider-range > div').css("left",price_min_left+'%');
//         $('#slider-range > div').css("width",width+'%');
//
//         }
//
//         else {
//             price_min = $(this.val());
//         }
//
//     });
//
//     $('input[name=max_price]').on('change', function() {
//         if($(this).val() > 0 && $(this).val()<10000) {
//
//         width = parseFloat($('#slider-range > div').css('width'));
//         $(this).val()/10000 * 100 < price_max_left ?
//             ( width = width - (price_max_left - $(this).val()/10000 * 100) ,
//                     price_max = $(this).val(),
//                     price_max_left = $(this).val()/10000 * 100) :
//             ( width = width + (($(this).val()/10000 * 100) - price_max_left) ,
//                 price_max = $(this).val(),
//                 price_max_left = $(this).val()/10000 * 100 ) ;
//         $('#max_price').val(price_max);
//         $('#slider-range > span:last').css("left",price_max_left+'%');
//         $('#slider-range > div').css("width",width+'%');
//
//         }
//
//         else {
//             price_max = $(this).val();
//         }
//     });
//
//     $body.on('min-price', function(e, res) {
//         price_min = res;
//         $('input[name=min_price]').val(res);
//     });
//
//     $body.on('max-price', function(e, res) {
//         price_max = res;
//         $('input[name=max_price]').val(res);
//     });
//
//     $body.on('square-min', function(e, res) {
//         square_feet_min = res;
//     });
//
//     $body.on('square-max', function(e, res) {
//         square_feet_max = res;
//     });
//
//     $body.on('blur' ,'input[name=openHouse]', function() {
//         open_house = $(this).val();
//     });
//
//     $body.on('submit', '#search , #advance-search , #index-search-from', async function() {
//         let searchQuery = {
//             isNew: true,
//             baths: bath,
//             neighborhood: neighborhood,
//             beds: bed,
//             price_min: price_min,
//             price_max: price_max,
//             square_feet_min: square_feet_min,
//             square_feet_max: square_feet_max,
//             open_house : open_house
//         };
//
//         let query = [];
//         query.push(searchQuery);
//
//         if(!queries) {
//             localStorage.setItem('search-queries', JSON.stringify(query));
//             return;
//         }
//
//         if(queries.length < 5) {
//             if(queries.length > 0) {
//                 queries.push(searchQuery);
//                 localStorage.setItem('search-queries', JSON.stringify(queries));
//             } else {
//                 localStorage.setItem('search-queries', JSON.stringify(query));
//             }
//         } else {
//             queries.shift();
//             queries.push(searchQuery);
//             localStorage.setItem('search-queries', JSON.stringify(queries));
//         }
//     });
//
//     if(queries && queries.length > 0) {
//         /*let selected = queries[queries.length - 1] ;
//         if (selected.beds.length > 0 ){
//         $($('#advance-search-beds').find('li > input') ).each(function(index) {
//         for (let i = 0 ; i < selected.beds.length ; i++) {
//         if($(this).val() == selected.beds[i]){
//         $(this).trigger( "click");
//         $(this).attr('checked' , true);
//         break ;
//         }
//         }
//
//         });
//         }
//         if (selected.baths.length > 0 ){
//         $($('#advance-search-baths').find('li > input') ).each(function(index) {
//         for (let i = 0 ; i < selected.baths.length ; i++) {
//         if($(this).val() == selected.baths[i]){
//         $(this).trigger( "click" );
//         $(this).attr('checked' , true)
//         break ;
//         }
//         }
//
//         });
//         }
//         if (selected.price_min !== null){
//         setTimeout(() => {
//         price_min = selected.price_min ;
//         $('#min_price').val(selected.price_min);
//         let percentage = (selected.price_min / 10000) * 100 ;
//         $('#slider-range > span:first').css("left",percentage+'%');
//         $('#slider-range > div').css("left",percentage+'%');
//         $('#slider-range > div').css("width",100-percentage+'%');
//         }, 100);
//         }
//         if (selected.price_max !== null){
//         setTimeout(() => {
//         price_max = selected.price_max ;
//         $('#max_price').val(selected.price_max);
//         let percentage = (selected.price_max / 10000) * 100 ;
//         let width = parseFloat($('#slider-range > div').css('width')) ;
//         $('#slider-range > span:last').css("left",percentage+'%');
//         $('#slider-range > div').css("width",(width -(100-percentage)+'%'));
//         }, 100);
//         }
//         if (selected.neighborhood !== null){
//         let current ;
//         $('input[name=neighborhoods]').val(selected.neighborhood);
//         $('select[name=neighborhoods] option').each(function(index) {
//         if($(this).text() == selected.neighborhood){
//         current = $( this ).val() ;
//         }
//         });
//         $('select[name=neighborhoods]').val(current);
//         neighborhood = selected.neighborhood ;
//         }*/
//
//         queries.forEach(async (v, i) => {
//             if(v.isNew === true) {
//                 let currentQuery = queries[i];
//                 currentQuery.isNew = false;
//                 currentQuery.url = window.location.href;
//                 localStorage.setItem('search-queries', JSON.stringify(queries));
//             }
//             $('#empty-keywords').remove();
//             $('.dropDown > ul.neighborhoods_amenities').prepend(`<li>
// <a href="${v.url}" class="recent" data-id = "${i}" >
// ${
//             (v.neighborhood !== null ? 'Listings in ' + v.neighborhood : 'Listings ') +
//             (v.beds.length > 0 ?
//                 (v.beds.length > 1 ?
//                     ' with ' + v.beds.sort() + ' bedrooms' : (v.beds[0] > 1 || v.beds[0] == '5+' ? ' with ' + v.beds + ' bedrooms' : ' with ' + v.beds + ' bedroom')): '') +
//             (v.baths.length > 0 ?
//                 (v.baths.length > 1 ?
//                     ' with at least ' + v.baths.sort() + ' bathrooms' : (v.baths[0] > 1 || v.baths[0] == '5+' ? ' with at least ' + v.baths + ' bathrooms' : ' with at least ' + v.baths + ' bathroom') ): '')+
//             (v.price_min !== null ?
//                 (v.price_max !== null ?
//                     ' between $' + formatNumber(v.price_min) + ' and $' + formatNumber(v.price_max) : 'above $' + formatNumber(v.price_min) ) :
//                 (v.price_max !== null ?
//                     ' under $' + formatNumber(v.price_max) : '' ))+
//             (v.square_feet_min !== null ?
//                 (v.square_feet_max !== null ?
//                     ' between ' + formatNumber(v.square_feet_min) + ' ft² and ' + formatNumber(v.square_feet_max) + ' ft² ' : 'above ' + formatNumber(v.square_feet_min) + 'ft²' ) :
//                 (v.square_feet_max !== null ?
//                     ' under ' + formatNumber(v.square_feet_max) + ' ft²' : '' ))+
//             (v.open_house !== null && v.open_house !== '' ? ' with Open House ' + v.open_house : '')}
// </a> </li>`);
//         });
//     } else {
//         if($('#empty-keywords').length > 0) return;
//         $('.dropDown').append('<a href="javascript:void(0);" id="empty-keywords">You have no keywords yet to search</a>');
//         $('.dropDown > ul').removeClass('ul-border-top');
//     }
//
//     function formatNumber(num) {
//         return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
//     }
//
//     $body.on('click', '.recent', async function(e) {
//         let temp = JSON.parse(localStorage.getItem('search-queries'));
//         temp.push(temp[$(this).attr('data-id')]);
//         for(let i = 0 ; i < temp.length ; i++){
//             if(i >= $(this).attr('data-id')) {
//                 temp[i] = temp[i + 1] ;
//             }
//         }
//         temp.pop();
//         localStorage.setItem('search-queries', JSON.stringify(temp)) ;
//     });
//
// });
