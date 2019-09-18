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
