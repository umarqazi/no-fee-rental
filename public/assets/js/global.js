
const AWS = "https://nfr-bucket.s3.us-east-2.amazonaws.com/";

/**
 *
 * @param url
 * @param type
 * @param data
 * @param loading
 * @param form
 * @param contentType
 * @returns {Promise<void>}
 */
const ajaxRequest = async function (url, type, data, loading = true, form = null, contentType = 'true') {
    setHeaders();
    let settings = {
        url: url,
        type: type,
        data: data,
        processData: true,
        beforeSend: () => {
            (loading) ? $('.loader').show() : '';
        },

        success: (res) => {
            (loading) ? $('.loader').hide() : '';

            if (!res.status) {
                if (res.msg !== undefined) {
                    if (res.msg !== '' && res.msg !== null) {
                        toastr.error(res.msg);
                    }
                }
                return false;
            }

            if (res.status) {
                if (res.msg !== '' && res.msg !== null) {
                    toastr.success(res.msg);
                }
                return res;
            }
        },

        error: (err) => {
            (loading) ? $('.loader').hide() : '';
            if (err.status === 422) {
                populateErrors(form, err.responseJSON.errors);
                return;
            }
            if (
                err.responseJSON.msg !== '' &&
                err.responseJSON.msg !== null &&
                err.responseJSON.message !== null &&
                err.responseJSON.message !== ''
            ) {
                toastr.error(err.responseJSON.msg);
            }
        }
    };
    if (contentType === 'false') {
        settings.processData = false;
        settings.contentType = false;
    }

    return await $.ajax(settings);
};

/**
 *
 * @param num
 * @returns {string}
 */
const formatNumber = (num) => {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
};

/**
 *
 * @param key
 * @param value
 */
const insertParam = (key, value) => {
    key = encodeURI(key); value = encodeURI(value);
    let kvp = document.location.search.substr(1).split('&');
    let i=kvp.length; let x; while(i--) {
    x = kvp[i].split('=');
    if (x[0]==key) {
        x[1] = value;
        kvp[i] = x.join('=');
        break;
    }
}

    if(i<0) {kvp[kvp.length] = [key,value].join('=');}
    //this will reload the page, it's likely better to store this until finished
    return kvp.join('&');
};

/**
 *
 * @param form
 * @param data
 */
const populateFields = function (form, data) {
    $.each(data, function (key, value) {
        let ctrl = $('[name=' + key + ']', form);
        switch (ctrl.prop("type")) {
            case "radio":
            case "checkbox":
                ctrl.each(function () {
                    if ($(this).attr('value') === value) $(this).attr("checked", value);
                });
                break;
            default:
                ctrl.val(value);
        }
    });
};

/**
 * Set Default Request Headers
 */
const setHeaders = function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
        }
    });
};

/**
 *
 * @param form
 * @param errors
 */
const populateErrors = function (form, errors) {
    $.each(errors, function (key, msg) {
        $(form).find(`input[name=${key}]`).after(`<label class="error">${msg}</label>`);
    });
};

/**
 *
 * @param msg
 * @returns {*}
 */
const confirm = function (msg) {
    return swal({
        title: "Are you sure?",
        text: msg,
        icon: "warning",
        buttons: [
            'No, cancel it!',
            'Yes, I am sure!'
        ],
        dangerMode: true,
    }).then(function (isConfirm) {
        return !!(isConfirm);
    });
};

/**
 *
 * @param route
 * @param table
 * @param form
 * @returns {Promise<void>}
 */
async function deleteRecord(route, table, form) {
    if (await confirm('You want to delete?')) {
        await ajaxRequest(route, 'post', null);
        table.row($(form).parents('tr')).remove().draw();
    }
}

/**
 *
 * @param route
 * @param table
 * @param form
 * @returns {Promise<void>}
 */
async function toggleStatus(route, table, form) {
    if (await confirm('Sure to perform this action?')) {
        let res = await ajaxRequest(route, 'post', null);
        if (form.hasClass('fa-eye')) {
            form.addClass('fa-eye-slash').removeClass('fa-eye');
        } else if (form.hasClass('fa-eye-slash')) {
            form.addClass('fa-eye').removeClass('fa-eye-slash');
        }
        return res;
    }
}

/**
 *
 * @param form_id
 * @param route
 * @returns {Promise<void>}
 */
async function updateRecord(form_id, route) {
    let res = await ajaxRequest(route, 'post');
    populateFields(form_id, res.data);
    return res;
}

/**
 *
 * @param file
 * @param target
 * @returns {Promise<void>}
 */
async function livePreview(file, target) {
    let reader = new FileReader();
    reader.onload = function (e) {
        $(target).attr('src', e.target.result);
    };
    reader.readAsDataURL(file);
}

/**
 *
 * @param selector
 * @returns {Promise<void>}
 */
const fetchNeighbours = async (selector) => {
    console.log(selector);
    await ajaxRequest('/all-neighborhoods', 'post', null, false).then(neighbours => {
        let data = [];
        neighbours.data.forEach(v => {
            data.push(v.name);
        });
        let $neighbour = selector;
        $neighbour.autocomplete({
            source: data,
            select: function (event, ui) {
                $(this).val(ui.item ? ui.item : " ");
            },

            change: function (event, ui) {
                if (!ui.item) {
                    this.value = '';
                    if ($('.neigh').length > 0) return;
                    $('#search-error-message').after('<label id="neighbors-error" class="error neigh" for="baths" style="margin-top: 5px;">Invalid Neighborhood.</label>');
                } else {
                    $('#neighbors-error').remove();
                }
            }
        });
    }).catch(err => {
        console.log(err);
    });
};

/**
 *
 * @param selector
 * @param allowTime
 * @param appendTag
 * @param appendTarget
 */
const enableDatePicker = (selector, allowTime = true) => {
    var start = new Date(),
        prevDay,
        startHours = 9;

    start.setHours(9);
    start.setMinutes(0);
    if ([6, 0].indexOf(start.getDay()) != -1) {
        start.setHours(10);
        startHours = 10
    }

    $(selector).datepicker({
        timepicker: allowTime,
        language: 'en',
        startDate: start,
        dateFormat: "mm-d-yyyy",
        minDate: new Date(),
        minHours: startHours,
        maxHours: 18,
        onSelect: function (fd, d, picker) {
            if (!d) return;
            var day = d.getDay();
            if (prevDay != undefined && prevDay == day) return;
            prevDay = day;
            if (day == 6 || day == 0) {
                picker.update({
                    minHours: 10,
                    maxHours: 16
                })
            } else {
                picker.update({
                    minHours: 9,
                    maxHours: 18
                })
            }

            $('label[for=lease-3]').text(`Choose Specific date...  (${fd})`);
        }
    });
};

/**
 *
 * @returns {{serverSide: boolean, processing: boolean}}
 */
const dataTableSettings = function () {
    return {
        serverSide: true,
        processing: true,
    };
};

/**
 *
 * @param selector
 * @param url
 * @param column
 * @param columnDef
 * @param target
 */
const dataTables = function (selector, url, column = null, columnDef = null, target = null) {
    let columns = column === null ? setBySelector(selector) : pushColumns(column);
    let settings = dataTableSettings();
    $(selector).DataTable({
        serverSide: settings.serverSide,
        processing: settings.processing,
        "ajax": {
            "url": url
        },
        "columns": columns,
        columnDefs: columnDef
    });
};

/**
 *
 * @param column
 * @returns {[]}
 */
const pushColumns = function (column) {
    let columns = [];
    column.forEach(col => {
        columns.push({data: col});
    });
    return columns;
};

/**
 *
 * @param selector
 * @returns {*[]}
 */
const setBySelector = function (selector) {
    let columns = [];
    $(selector).find('th').each((i, a) => {
        if ($(a).text() !== 'action') {
            columns.push($(a).text().replace(/\s+/g, '_').toLowerCase());
        }
    });
    return pushColumns(columns);
};

/**
 *
 * @param image
 * @returns {string}
 */
const is_realty_listing = (image) => {
    return image.indexOf('http') > -1
        ? image : AWS + image;
};

/**
 *
 * @param listing
 * @returns {*}
 */
const is_exclusive = (listing) => {
    return listing.building_type === 'exclusive' ? listing.street_address + ' - (' + listing.unit + ')' : listing.display_address
};

/**
 *
 * @param selector
 */
const scrollDown = (selector) => {
    selector.animate({scrollTop: selector[0].scrollHeight});
};

/**
 *
 * @param value
 * @param phrase
 * @returns {string}
 */
const str_formatting = (value, phrase) => {
    return value < 1 ? 'Studio' : (value > 1 ? value + ' '+ phrase + "s" : value + ' '+ phrase);
};

$(() => {

    let $body = $('body');
    $body.on('submit', '.ajax', async function (e) {
        e.preventDefault();
        let form = $(this);
        let id = $(this).attr('id');
        let url = $(this).attr('action');
        let type = $(this).attr('method');
        let data = $(this).serialize();
        let reset = $(this).attr('reset');
        let loading = $(this).attr('loading');
        let content = $(this).attr('content');

        if (!form.valid()) {
            return;
        }

        let res = await ajaxRequest(url, type, data, (loading !== 'false'), form, content);

        if (reset === 'true') {
            $(form).trigger("reset");
        }

        if (res.status) {
            form.trigger(`form-success-${id}`, res.data);
        }
    });

    $body.on('click', 'button[data-target="#check-availability"]', function () {
        let $listing = $(this).parents('.property-thumb');
        let img = $listing.find('img').attr('src');
        let info = $listing.find('.info > div');
        let data = $listing.find('.feaure-policy-text > span').text();
        let rent = info.find('p:first').text();
        let address = info.find('p:last').text();
        data = data.split(',');
        let modal = $('body').find('#check-availability');
        modal.find('.row > div > img').attr('src', img);
        modal.find('#address').text(address);
        modal.find('.bedroms-baths-text > span:first').text(data[0]);
        modal.find('.bedroms-baths-text > span:last').text(data[1]);
        modal.find('.row > div:eq(1) > small').text(rent);
        modal.find('input[name=listing_id]').val($(this).attr('list_id'));
        modal.find('input[name=to]').val($(this).attr('to'));
    });

    /**
     * Do Listing Favourite/Remove Favourite
     */
    $body.on('click', '.heart-icon', async function () {
        let id = $(this).attr('id');
        $(this).toggleClass('favourite');
        if ($(this).hasClass('favourite')) {
            return await ajaxRequest(`/favourite/${id}`, 'GET', true, false);
        }

        return await ajaxRequest(`/remove/favourite/${id}`, 'GET', true, false);
    });

    /**
     * Open Log in Modal when a guest click on favourite Icon
     */
    $body.on('click', '.display-heart-icon', async function () {
        $('#login').modal('show');
    });

    /**
     * Open Log in Modal when a guest click on Listing Report Icon
     */
    $body.on('click', '#listing-report-flag', async function () {
        $('#login').modal('show');
    });

    $body.find('input[name=phone_number]').mask('(000) 000-000');

});
