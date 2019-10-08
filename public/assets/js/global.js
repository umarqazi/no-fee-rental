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
async function ajaxRequest(url, type, data, loading = true, form = null, contentType = 'true') {
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

            if(!res.status) {
                if(res.msg !== undefined) {
                    if (res.msg !== '' && res.msg !== null) {
                        toastr.error(res.msg);
                    }
                }
                return false;
            }

            if(res.status) {
                if(res.msg !== '' && res.msg !== null) {
                    toastr.success(res.msg);
                }
                return res;
            }
        },

        error: (err) => {
            (loading) ? $('.loader').hide() : '';
            if(err.status === 422) {
                populateErrors(form, err.responseJSON.errors);
                return;
            }
            if(err.responseJSON.msg !== '' || err.responseJSON.msg !== null) {
                toastr.error(err.responseJSON.msg);
            }
        }
    };
	if(contentType === 'false') {
	    settings.processData = false;
	    settings.contentType = false;
    }

	return await $.ajax(settings);
}

/**
 *
 * @param form
 * @param data
 */
function populateFields(form, data) {
    $.each(data, function(key, value) {
        var ctrl = $('[name='+key+']', form);
        switch(ctrl.prop("type")) {
            case "radio": case "checkbox":
                ctrl.each(function() {
                    if($(this).attr('value') === value) $(this).attr("checked",value);
                });
                break;
            default:
                ctrl.val(value);
        }
    });
}

/**
 * Set Default Request Headers
 */
function setHeaders() {
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
		}
	});
}

/**
 *
 * @param form
 * @param errors
 */
function populateErrors(form, errors) {
	$.each(errors, function (key, msg) {
		$(form).find(`input[name=${key}]`).after(`<label class="error">${msg}</label>`);
	});
}

$(() => {

	$('body').on('submit', '.ajax', async function(e) {
		e.preventDefault();
		let form    = $(this);
		let id      = $(this).attr('id');
		let url     = $(this).attr('action');
		let type    = $(this).attr('method');
		let data    = $(this).serialize();
		let reset   = $(this).attr('reset');
        let loading = $(this).attr('loading');
        let content = $(this).attr('content');

		if(!form.valid()) {
			return;
		}

		let res = await ajaxRequest(url, type, data, (loading !== 'false'), form, content);

		if(reset === 'true'){
            $(form).trigger("reset");
        }

		if(res.status){
			form.trigger(`form-success-${id}`, res.data);
		}
	});
});

/**
 *
 * @param msg
 * @returns {*}
 */
function confirm(msg) {
	return swal({
		title: "Are you sure?",
		text: msg,
		icon: "warning",
		buttons: [
			'No, cancel it!',
			'Yes, I am sure!'
		],
		dangerMode: true,
	}).then(function(isConfirm) {
		return !!(isConfirm);
	});
}

function reset(form) {
    $(form)
}

/**
 *
 * @param route
 * @returns {Promise<void>}
 */
async function deleteRecord(route, table, form) {
    if(await confirm('You want to delete?')) {
        let res = await ajaxRequest(route, 'post', null);
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
    if(await confirm('Sure to perform this action?')) {
        let res = await ajaxRequest(route, 'post', null);
        if(form.hasClass('fa-eye')) {
            form.addClass('fa-eye-slash').removeClass('fa-eye');
        } else if(form.hasClass('fa-eye-slash')) {
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
    reader.onload = function(e) {
        $(target).attr('src', e.target.result);
    };
    reader.readAsDataURL(file);
}

const fetchNeighbours = async (selector) => {
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
                    if($('.neigh').length > 0) return;
                    $neighbour.after('<label id="neighbors-error" class="error neigh" for="baths">Invalid Neighborhood.</label>');
                } else {
                    $('#neighbors-error').remove();
                }
            }
        });
    });
};

/**
 *
 * @param selector
 * @param allowTime
 */
const enableDatePicker = (selector, allowTime = true) => {
    console.log(selector);
    // Create start date
    var start = new Date(),
        prevDay,
        startHours = 9;

    // 09:00 AM
    start.setHours(9);
    start.setMinutes(0);

    // If today is Saturday or Sunday set 10:00 AM
    if ([6, 0].indexOf(start.getDay()) != -1) {
        start.setHours(10);
        startHours = 10
    }

    $(selector).datepicker({
        timepicker: allowTime,
        language: 'en',
        startDate: start,
        minHours: startHours,
        maxHours: 18,
        onSelect: function (fd, d, picker) {
            // Do nothing if selection was cleared
            if (!d) return;

            var day = d.getDay();

            // Trigger only if date is changed
            if (prevDay != undefined && prevDay == day) return;
            prevDay = day;

            // If chosen day is Saturday or Sunday when set
            // hour value for weekends, else restore defaults
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
        }
    });
};
