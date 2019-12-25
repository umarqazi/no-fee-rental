"use strict";

// $(() => {

    // let values = {};
    // let old_searches = JSON.parse(localStorage.getItem('search-query'));
    //
    // if(!old_searches) {
    //     old_searches = [];
    // } else {
    //     old_searches.forEach(function () {
    //         console.log($(this).val())
    //     });
    // }
    //
    // $('body').on('click', '.search', function (e) {
    //     let beds = [];
    //     let baths = [];
    //     e.preventDefault();
    //
    //     let id = $(this).parents('form').attr('id');
    //     let $select_field = $(`#${id}`).find('select');
    //     let $text_inputs = $(`#${id} :input[type=text]`);
    //     let $number_inputs = $(`#${id} :input[type=number]`);
    //     let $checkbox_inputs = $(`#${id} :input[type=checkbox]:checked`);
    //
    //     $text_inputs.each(function() {
    //         values[this.name] = $(this).val();
    //     });
    //
    //     $number_inputs.each(function () {
    //         values[this.name] = $(this).val();
    //     });
    //
    //     $checkbox_inputs.each(function () {
    //         let name = this.name.replace('[]', '');
    //         if(name === 'beds') beds.push($(this).val());
    //         if(name === 'baths') baths.push($(this).val());
    //         values['beds'] = beds; values['baths'] = baths;
    //     });
    //
    //     $select_field.each(function () {
    //         values[this.name] = $(this).val();
    //     });
    //
    //     values['isNew'] = true;
    //
    //     if(old_searches.length >= 5) {
    //         old_searches.shift();
    //     }
    //
    //     old_searches.push(values);
    //     localStorage.setItem('search-query', JSON.stringify(old_searches));
    //     $(this).parents('form').submit();
    // });

    // let search = location.search.substring(1);
    // let params = decodeURIComponent(search);
    //
    // JSON.parse('{"' + .replace(/"/g, '\\"').replace(/&/g, '","').replace(/=/g,'":"') + '"}')
// });
//
//     let $body = $('body');
//     let queries = JSON.parse(localStorage.getItem('search-queries'));
//     let bath = [], bed = [], square_feet_min = null, square_feet_max = null, neighborhood = null, price_min = null, price_max = null, open_house = null;
//
//
//     $('#advance-search-baths').find('li').on('change', function() {
//         let found = false ;
//         for(let i = 0 ; i < bath.length ; i++){
//            if(bath[i] == $(this).text().replace(/\s/g, '')){
//                    bath.splice(i,1);
//                    found = true ;
//            }
//         }
//         if(found !== true){
//             bath.push($(this).text().replace(/\s/g, ''));
//         }
//     });
//
//     $('#advance-search-beds').find('li').on('change', function() {
//         let found = false ;;
//         for(let i = 0 ; i < bed.length ; i++){
//             if(bed[i] == $(this).text().replace(/\s/g, '')){
//                 bed.splice(i,1);
//                 found = true ;
//             }
//         }
//         if(found !== true){
//             bed.push($(this).text().replace(/\s/g, ''));
//         }
//
//     });
//
//
//     $('#main-search-priceRange').on('change', function() {
//       if($("#main-search-priceRange option:selected").val() !== '') {
//           price_max = $("#main-search-priceRange option:selected").val();
//           $('#max_price').val(price_max);
//       }
//       else {
//           price_max = null ;
//       }
//     });
//
//     $('input[name=neighborhoods]').on('change', function() {
//         let $select = $("select[name=neighborhoods] option");
//         let $val = $('input[name=neighborhoods]').val();
//         let $currentSelect ;
//         if ($val.length > 0){
//             $( $select ).each(function(index) {
//                 if($(this).text() == $val){
//                     $currentSelect = $( this ).val() ;
//                 }
//             });
//                 $("select[name=neighborhoods]").val($currentSelect);
//         }
//         neighborhood = $val ;
//     });
//
//     $('select[name=neighborhoods]').on('change', function() {
//         let $nSelector = $("select[name=neighborhoods] option:selected");
//         $('input[name=neighborhoods]').val($nSelector.text());
//         neighborhood = $nSelector.text();
//     });
//
//     $body.on('min-price', function(e, res) {
//         price_min = res;
//     });
//
//     $body.on('max-price', function(e, res) {
//         price_max = res;
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
//     $body.on('submit', '#search , #advance-search', async function() {
//         let searchQuery = {
//             isNew: true,
//             baths: bath,
//             neighborhood: neighborhood,
//             beds: bed,
//             price_min: price_min,
//             price_max: price_max,
//             square_feet_min: square_feet_min,
//             square_feet_max: square_feet_max,
//             open_house  : open_house
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
//         let selected = queries[queries.length - 1] ;
//         if (selected.beds.length > 0 ){
//             $($('#advance-search-beds').find('li > input') ).each(function(index) {
//                 for (let i = 0 ; i < selected.beds.length ; i++) {
//                     if($(this).val() == selected.beds[i]){
//                         $(this).trigger( "click");
//                         $(this).attr('checked' , true);
//                         break ;
//                     }
//                 }
//
//             });
//         }
//         if (selected.baths.length > 0 ){
//             $($('#advance-search-baths').find('li > input') ).each(function(index) {
//                 for (let i = 0 ; i < selected.baths.length ; i++) {
//                     if($(this).val() == selected.baths[i]){
//                         $(this).trigger( "click" );
//                         $(this).attr('checked' , true)
//                         break ;
//                     }
//                 }
//
//             });
//         }
//         if (selected.price_min !== null){
//             setTimeout(() => {
//                 price_min = selected.price_min ;
//                 $('#min_price').val(selected.price_min);
//                 let percentage = (selected.price_min / 10000) * 100 ;
//                 $('#slider-range > span:first').css("left",percentage+'%');
//                 $('#slider-range > div').css("left",percentage+'%');
//                 $('#slider-range > div').css("width",100-percentage+'%');
//             }, 100);
//         }
//         if (selected.price_max !== null){
//             setTimeout(() => {
//                 price_max = selected.price_max // "use strict";
//
// $(() => {
//
//     let $body = $('body');
//     let queries = JSON.parse(localStorage.getItem('search-queries'));
//     let bath = [], bed = [], square_feet_min = null, square_feet_max = null, neighborhood = null, price_min = null, price_max = null, open_house = null;
//
//
//     $('#advance-search-baths').find('li').on('change', function() {
//         let found = false ;
//         for(let i = 0 ; i < bath.length ; i++){
//            if(bath[i] == $(this).text().replace(/\s/g, '')){
//                    bath.splice(i,1);
//                    found = true ;
//            }
//         }
//         if(found !== true){
//             bath.push($(this).text().replace(/\s/g, ''));
//         }
//     });
//
//     $('#advance-search-beds').find('li').on('change', function() {
//         let found = false ;;
//         for(let i = 0 ; i < bed.length ; i++){
//             if(bed[i] == $(this).text().replace(/\s/g, '')){
//                 bed.splice(i,1);
//                 found = true ;
//             }
//         }
//         if(found !== true){
//             bed.push($(this).text().replace(/\s/g, ''));
//         }
//
//     });
//
//
//     $('#main-search-priceRange').on('change', function() {
//       if($("#main-search-priceRange option:selected").val() !== '') {
//           price_max = $("#main-search-priceRange option:selected").val();
//           $('#max_price').val(price_max);
//       }
//       else {
//           price_max = null ;
//       }
//     });
//
//     $('input[name=neighborhoods]').on('change', function() {
//         let $select = $("select[name=neighborhoods] option");
//         let $val = $('input[name=neighborhoods]').val();
//         let $currentSelect ;
//         if ($val.length > 0){
//             $( $select ).each(function(index) {
//                 if($(this).text() == $val){
//                     $currentSelect = $( this ).val() ;
//                 }
//             });
//                 $("select[name=neighborhoods]").val($currentSelect);
//         }
//         neighborhood = $val ;
//     });
//
//     $('select[name=neighborhoods]').on('change', function() {
//         let $nSelector = $("select[name=neighborhoods] option:selected");
//         $('input[name=neighborhoods]').val($nSelector.text());
//         neighborhood = $nSelector.text();
//     });
//
//     $body.on('min-price', function(e, res) {
//         price_min = res;
//     });
//
//     $body.on('max-price', function(e, res) {
//         price_max = res;
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
//     $body.on('submit', '#search , #advance-search', async function() {
//         let searchQuery = {
//             isNew: true,
//             baths: bath,
//             neighborhood: neighborhood,
//             beds: bed,
//             price_min: price_min,
//             price_max: price_max,
//             square_feet_min: square_feet_min,
//             square_feet_max: square_feet_max,
//             open_house  : open_house
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
//         let selected = queries[queries.length - 1] ;
//         if (selected.beds.length > 0 ){
//             $($('#advance-search-beds').find('li > input') ).each(function(index) {
//                 for (let i = 0 ; i < selected.beds.length ; i++) {
//                     if($(this).val() == selected.beds[i]){
//                         $(this).trigger( "click");
//                         $(this).attr('checked' , true);
//                         break ;
//                     }
//                 }
//
//             });
//         }
//         if (selected.baths.length > 0 ){
//             $($('#advance-search-baths').find('li > input') ).each(function(index) {
//                 for (let i = 0 ; i < selected.baths.length ; i++) {
//                     if($(this).val() == selected.baths[i]){
//                         $(this).trigger( "click" );
//                         $(this).attr('checked' , true)
//                         break ;
//                     }
//                 }
//
//             });
//         }
//         if (selected.price_min !== null){
//             setTimeout(() => {
//                 price_min = selected.price_min ;
//                 $('#min_price').val(selected.price_min);
//                 let percentage = (selected.price_min / 10000) * 100 ;
//                 $('#slider-range > span:first').css("left",percentage+'%');
//                 $('#slider-range > div').css("left",percentage+'%');
//                 $('#slider-range > div').css("width",100-percentage+'%');
//             }, 100);
//         }
//         if (selected.price_max !== null){
//             setTimeout(() => {
//                 price_max = selected.price_max ;
//                 $('#max_price').val(selected.price_max);
//                 let percentage = (selected.price_max / 10000) * 100 ;
//                 let width =  parseFloat($('#slider-range > div').css('width')) ;
//                 $('#slider-range > span:last').css("left",percentage+'%');
//                 $('#slider-range > div').css("width",(width -(100-percentage)+'%'));
//             }, 100);
//         }
//         if (selected.neighborhood !== null){
//             let current ;
//             $('input[name=neighborhoods]').val(selected.neighborhood);
//             $('select[name=neighborhoods] option').each(function(index) {
//                 if($(this).text() == selected.neighborhood){
//                      current = $( this ).val() ;
//                 }
//             });
//             $('select[name=neighborhoods]').val(current);
//             neighborhood = selected.neighborhood ;
//         }
//
//         queries.forEach(async (v, i) => {
//             if(v.isNew === true) {
//                 let currentQuery = queries[i];
//                 currentQuery.isNew = false;
//                 currentQuery.url = window.location.href;
//                 localStorage.setItem('search-queries', JSON.stringify(queries));
//             }
//             $('#empty-keywords').remove();
//                 $('.dropDown > ul.neighborhoods_amenities').prepend(`<li>
//                 <a href="${v.url}" class="recent" data-id = "${i}" >
//                         ${
//                             (v.neighborhood !== null ? 'Listings in ' + v.neighborhood : 'Listings ') +
//                             (v.beds.length > 0  ?
//                                 (v.beds.length > 1 ?
//                                     ' with ' + v.beds.sort() + ' bedrooms' : (v.beds[0] > 1 || v.beds[0] == '5+' ? ' with ' + v.beds + ' bedrooms' : ' with ' + v.beds + ' bedroom')): '') +
//                             (v.baths.length > 0  ?
//                                 (v.baths.length > 1 ?
//                                     ' with at least ' + v.baths.sort() + ' bathrooms' : (v.baths[0] > 1 || v.baths[0] == '5+' ? ' with at least ' + v.baths + ' bathrooms' : ' with at least ' + v.baths + ' bathroom') ): '')+
//                             (v.price_min !== null ?
//                                 (v.price_max !== null ?
//                                     ' between $' + formatNumber(v.price_min) + ' and $' + formatNumber(v.price_max) : 'above $' + formatNumber(v.price_min) ) :
//                                 (v.price_max !== null ?
//                                     ' under $' + formatNumber(v.price_max) : '' ))+
//                             (v.square_feet_min !== null ?
//                                 (v.square_feet_max !== null ?
//                                     ' between ' + formatNumber(v.square_feet_min) + ' ft² and ' + formatNumber(v.square_feet_max) + ' ft² ' : 'above ' + formatNumber(v.square_feet_min) + 'ft²' ) :
//                                 (v.square_feet_max !== null ?
//                                     ' under ' + formatNumber(v.square_feet_max) + ' ft²' : '' ))+
//                             (v.open_house !== null && v.open_house !== ''  ? ' with Open House ' + v.open_house : '')}
//                 </a> </li>`);
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
//          for(let i = 0 ; i < temp.length ; i++){
//              if(i >= $(this).attr('data-id')) {
//                  temp[i] = temp[i + 1] ;
//              }
//          }
//          temp.pop();
//         localStorage.setItem('search-queries', JSON.stringify(temp)) ;
//     });
// });

//                 $('#max_price').val(selected.price_max);
//                 let percentage = (selected.price_max / 10000) * 100 ;
//                 let width =  parseFloat($('#slider-range > div').css('width')) ;
//                 $('#slider-range > span:last').css("left",percentage+'%');
//                 $('#slider-range > div').css("width",(width -(100-percentage)+'%'));
//             }, 100);
//         }
//         if (selected.neighborhood !== null){
//             let current ;
//             $('input[name=neighborhoods]').val(selected.neighborhood);
//             $('select[name=neighborhoods] option').each(function(index) {
//                 if($(this).text() == selected.neighborhood){
//                      current = $( this ).val() ;
//                 }
//             });
//             $('select[name=neighborhoods]').val(current);
//             neighborhood = selected.neighborhood ;
//         }
//
//         queries.forEach(async (v, i) => {
//             if(v.isNew === true) {
//                 let currentQuery = queries[i];
//                 currentQuery.isNew = false;
//                 currentQuery.url = window.location.href;
//                 localStorage.setItem('search-queries', JSON.stringify(queries));
//             }
//             $('#empty-keywords').remove();
//                 $('.dropDown > ul.neighborhoods_amenities').prepend(`<li>
//                 <a href="${v.url}" class="recent" data-id = "${i}" >
//                         ${
//                             (v.neighborhood !== null ? 'Listings in ' + v.neighborhood : 'Listings ') +
//                             (v.beds.length > 0  ?
//                                 (v.beds.length > 1 ?
//                                     ' with ' + v.beds.sort() + ' bedrooms' : (v.beds[0] > 1 || v.beds[0] == '5+' ? ' with ' + v.beds + ' bedrooms' : ' with ' + v.beds + ' bedroom')): '') +
//                             (v.baths.length > 0  ?
//                                 (v.baths.length > 1 ?
//                                     ' with at least ' + v.baths.sort() + ' bathrooms' : (v.baths[0] > 1 || v.baths[0] == '5+' ? ' with at least ' + v.baths + ' bathrooms' : ' with at least ' + v.baths + ' bathroom') ): '')+
//                             (v.price_min !== null ?
//                                 (v.price_max !== null ?
//                                     ' between $' + formatNumber(v.price_min) + ' and $' + formatNumber(v.price_max) : 'above $' + formatNumber(v.price_min) ) :
//                                 (v.price_max !== null ?
//                                     ' under $' + formatNumber(v.price_max) : '' ))+
//                             (v.square_feet_min !== null ?
//                                 (v.square_feet_max !== null ?
//                                     ' between ' + formatNumber(v.square_feet_min) + ' ft² and ' + formatNumber(v.square_feet_max) + ' ft² ' : 'above ' + formatNumber(v.square_feet_min) + 'ft²' ) :
//                                 (v.square_feet_max !== null ?
//                                     ' under ' + formatNumber(v.square_feet_max) + ' ft²' : '' ))+
//                             (v.open_house !== null && v.open_house !== ''  ? ' with Open House ' + v.open_house : '')}
//                 </a> </li>`);
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
//          for(let i = 0 ; i < temp.length ; i++){
//              if(i >= $(this).attr('data-id')) {
//                  temp[i] = temp[i + 1] ;
//              }
//          }
//          temp.pop();
//         localStorage.setItem('search-queries', JSON.stringify(temp)) ;
//     });
// });
