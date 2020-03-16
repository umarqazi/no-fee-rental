"use strict";

let $query = [];
let $old_queries = [];
let decodedURL = new URL(decodeURIComponent(window.location.href));
let $beds = decodedURL.searchParams.getAll('beds[]') || [];
let $baths = decodedURL.searchParams.getAll('baths[]') || [];
let $min_price = decodedURL.searchParams.getAll('min_price');
let $max_price = decodedURL.searchParams.getAll('max_price');
let $neighborhoods = decodedURL.searchParams.getAll('neighborhood[]') || [];

window.onload = () => {
    $('body').find('.search-loader').hide();
    $old_queries = JSON.parse(localStorage.getItem('search-query'));

    if($old_queries === null) {
        pushRecentSearch(null, false); return;
    }

    $old_queries.forEach((v, i) => {
        makeString(v, i);
    });
};


let newPush = false;
function makeString(v, i) {
    if(v.isNew) {
        newPush = true;
        manageStorage(i);return;
    }

    let obj = {};
    obj.url = v.url;
    obj.title = 'Listings';
    obj.string = obj.title;
    obj.isSave = v.isSave;

    if(v.$min_price.length > 0) {
        obj.title += ` between $${formatNumber(v.$min_price)}`;
        obj.string += ` between $${formatNumber(v.$min_price)}`;
    }

    if(v.$max_price.length > 0) {
        obj.title += ` and $${formatNumber(v.$max_price)}`;
        obj.string += ` and $${formatNumber(v.$max_price)}`;
    }

    if(v.$neighborhoods.length > 0) {
        obj.title += ` in ${v.$neighborhoods.length > 1 ? v.$neighborhoods.join(', ') + ' Neighborhoods' : v.$neighborhoods + ' Neighborhood'}`;
        obj.string += ` in ${v.$neighborhoods.length > 1 ? v.$neighborhoods.length + ' Neighborhoods' : v.$neighborhoods + ' Neighborhood'}`;
    }

    if(v.$beds.length > 0) {
        let bed = ` with at least ${v.$beds.length > 1 ? v.$beds.join(', ') + ' bedrooms' : v.$beds + ' bedroom'}`;
        obj.title += bed; obj.string += bed;
    }

    if(v.$baths.length > 0) {
        let bath = ` with at least ${v.$baths.length > 1 ? v.$baths.join(', ') + ' bathrooms' : v.$baths + ' bathroom'}`;
        obj.string += bath; obj.title += bath;
    }

    if(newPush) {
        newPush = false;
        pushRecentSearch(obj, true, i);
    } else {
        pushRecentSearch(obj, false, i);
    }
}

/**
 * storage manager
 * @param index
 */
function manageStorage(index) {

    $query = {
        isNew: false,
        isSave: false,
        $min_price: $min_price,
        $max_price: $max_price,
        url: window.location.href,
        $beds: $beds.length > 0 ? $beds : [],
        $baths: $baths.length > 0 ? $baths : [],
        $neighborhoods: $neighborhoods.length > 0 ? $neighborhoods : [],
    };

    $old_queries.splice(index, 1);

    if($old_queries.length > 4) {
        $old_queries.shift();
    }

    $old_queries.splice(0, 0, $query);
    localStorage.setItem('search-query', JSON.stringify($old_queries));
    makeString($query, index);
}

/**
 *
 * @param res
 * @returns {Promise<boolean>}
 */
async function isUnique(res) {
    let isUnique = true;
    let a = JSON.parse(localStorage.getItem('search-query'));
    if(a !== null) {
        await a.forEach((v) => {
            if(v.url === res) isUnique = false;
        });
    }

    return isUnique;
}

/**
 *
 * @param data
 * @param $prepend
 * @param i
 */
function pushRecentSearch(data = null, $prepend, i) {
    let $target = $('body').find('.neighborhoods_amenities');

    if(data === null) {
        $target.append('<li><a href="javascript:void(0);" id="empty-keywords">You have no keywords yet to search</a></li>');
    } else {
        let html = null;

        if(Window.Laravel.userType == 4){
            html = `<li><a href="${data.url}" title="${data.title}" class="recent" data-id="${i}"> ${data.string}</a> 
                    <i class="${data.isSave ? 'fa fa-star saved-star' : 'far fa-star recent-star'}"></i> </li>`;
        } else {
            html = `<li><a href="${data.url}" title="${data.title}" class="recent" data-id="${i}"> ${data.string}</a> </li>`;
        }

        if($prepend) {
            $target.prepend(html);
        } else {
            $target.append(html);
        }
    }
}


$(document).ready(function () {
    let $body = $('body');
    $body.find('.search-loader').show();

    // Neighborhood Select Management
    $('.neighborhood-list > li > div > input').click(function(){
        let name = $(this).val();
        if($(this).prop("checked") === true){
            if(!$neighborhoods.includes(name)) {
                $neighborhoods.push(name);
            }
        }

        if($(this).prop("checked") === false){
            $neighborhoods.splice($neighborhoods.indexOf(name), 1);
            if($neighborhoods.length < 2) {
                index_neighborhood($neighborhoods[0]);
                return;
            }
        }

        index_neighborhood(name);

    });

    // On Advance Search Button Click Neighborhoods (Selected)
    $('.advance-search').on('click', function () {
        $body.find('.fs-label').text('Select Neighborhoods');
        $body.find('.fs-option').removeClass('selected');
        if($neighborhoods.length > 0) {
            $body.find('.fs-option').each((a, v) => {
                let text = $(v).find('div').text();
                if ($neighborhoods.includes(text)) {
                    let id = text.replace(/\s/g, '');
                    $('.ASN:first').find(`option[id=${id}]`).attr('selected', 'selected');
                    $body.find('.fs-label').text($body.find('.search-fld, .PN').text());
                    $(v).addClass('selected');
                }
            });
        }
    });

    $body.find('#advance-search').on('hidden.bs.modal', function () {
        if($neighborhoods.length > 0) {
            $('.neighborhood-list > li > div').each((i, b) => {
                let name = $(b).find('label').text();
                if($neighborhoods.includes(name) && $(b).find('input').prop('checked') === false) {
                    $(b).find('input').prop('checked', true);
                }
            });
        }
    });

    $body.find('.fs-option').on('click', function () {
        let name = $(this).find('div').text();
        if(!$neighborhoods.includes(name)) {
            $neighborhoods.push(name);
        } else {
            $neighborhoods.splice($neighborhoods.indexOf(name), 1);
            if($neighborhoods.length < 2) {
                index_neighborhood($neighborhoods[0]);
                return;
            }
        }

        index_neighborhood(name);
    });

    /**
     * Neighborhoods Text Emitter
     **/
    function index_neighborhood(get_text) {
        if($neighborhoods.length > 1) {
            $('.search-fld, .PN').text(`Neighborhoods (${$neighborhoods.length})`);
        } else if($neighborhoods.length < 1) {
            $('.search-fld, .PN').text('Neighborhoods');
        } else {
            $('.search-fld, .PN').text(get_text !== null ? get_text : $neighborhoods[0]);
        }
    }

    // Price Management

    // MIN
    $('.PPm').on('input', function () {
        let val = $(this).val();
        $('.ASPm').val(val).trigger('keyup');
    });

    // MAX
    $('.PPM').on('input', function () {
        let val = $(this).val();
        $('.ASPM').val(val).trigger('keyup');
    });

    // MIN Advance
    $('#min_price').on('input change', function () {
        $('.PPm').val($(this).val());
    });

    // MAX Advance
    $('#max_price').on('input change', function () {
        $('.PPM').val($(this).val());
    });

    // Beds Management (INDEX)
    $('.PBD > ul > li > input').click(function () {
        let $selector = $('body').find(`.ASBD > ul > li:eq(${$(this).parent('li').index()}) > input`);
        if($(this).prop('checked')) {
            $selector.trigger('click');
        }

        if(!$(this).prop('checked')) {
            $selector.trigger('click');
        }
    });

    // Beds Management (Advance)
    $('.ASBD > ul > li > input').click(function () {
        let $selector = $('body').find(`.PBD > ul > li:eq(${$(this).parent('li').index()}) > input`);
        if($(this).prop('checked')) {
            $selector.trigger('click');
        }

        if(!$(this).prop('checked')) {
            $selector.trigger('click');
        }
    });

    // Baths Management (INDEX)
    $('.PBA > ul > li > input').click(function () {
        let $selector = $('body').find(`.ASBA > ul > li:eq(${$(this).parent('li').index()}) > input`);
        if($(this).prop('checked')) {
            $selector.trigger('click');
        }

        if(!$(this).prop('checked')) {
            $selector.trigger('click');
        }
    });

    // Beds Management (Advance)
    $('.ASBA > ul > li > input').click(function () {
        let $selector = $('body').find(`.PBA > ul > li:eq(${$(this).parent('li').index()}) > input`);
        if($(this).prop('checked')) {
            $selector.trigger('click');
        }

        if(!$(this).prop('checked')) {
            $selector.trigger('click');
        }
    });

    $body.on('click', '.recent-star', async function () {
        let index = $(this).parents('li').find('a').attr('data-id');
        let search = $old_queries[index]; search.isSave = true;
        $old_queries[index] = search;
        await ajaxRequest('/renter/add-search', 'post', search, false).then(res => {
            $(this).removeClass('far recent-star').addClass('fa saved-star');
            localStorage.setItem('search-query', JSON.stringify($old_queries));
            toastr.success('Search marked as favourite.');
        });
    });

    $body.on('click', '.saved-star', async function () {
        let index = $(this).parents('li').find('a').attr('data-id');
        let search = $old_queries[index]; search.isSave = false;
        $old_queries[index] = search;
        await ajaxRequest('/renter/add-search', 'post', search, false).then(res => {
            $(this).removeClass('fa saved-star').addClass('far recent-star');
            localStorage.setItem('search-query', JSON.stringify($old_queries));
            toastr.success('Search removed from favourite.');
        });
    });

    // Submit FORM
    $('#index-search-from, #modal-search-from, #search').on('submit', async function (e) {
        e.preventDefault();
        let res = $(this).serialize();
        res= res.replace(/&?[^=&]+=(&|$)/g,'');
        res = res.replace(/neighborhood|&&neighborhood/, '&neighborhood');
        let url = `${$(this).attr('action')}${res !== '' ? '?' + res : ''}`;
        if($old_queries === null) $old_queries = [];
        if(await isUnique(url)) $old_queries.push({isNew: true});
        if(res !== '')  localStorage.setItem('search-query', JSON.stringify($old_queries));
        window.location.href = url;
    });
});
