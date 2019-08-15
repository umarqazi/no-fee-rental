/**
 *
 * @param url
 * @param type
 * @param data
 * @param processing
 * @param form
 * @returns {Promise<void>}
 */
async function ajaxRequest(url, type, data, processing = true, form) {
	setHeaders();
	var res = await $.ajax({
		url: url,
		type: type,
		data: data,
		processData: processing,

		beforeSend: (xhr) => {
			$('.loader').show();
		},

		success: (res) => {
			$('.loader').hide();

			if(!res.status && res.msg) {
				toastr.error(res.msg);
				return false;
			}

			if(res.msg) {
                toastr.success(res.msg);
                return res;
            }
		},

		error: (err) => {
			$('.loader').hide();
			if(err.status === 422) {
				populateErrors(form, err.responseJSON.errors);
				return;
			}
			toastr.error(err.responseJSON.msg);
			return;
		}
	});

		return res;
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
		let form = $(this);
		let id = $(this).attr('id');
		let url = $(this).attr('action');
		let type = $(this).attr('method');
		let data = $(this).serialize();
		let reset = $(this).attr('reset');

		if(!form.valid()) {
			return;
		}
		let res = await ajaxRequest(url, type, data, false, form);
		if(reset === 'true'){
			resetForm();
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

/**
 * Reset Current Form
 */
function resetForm() {
	$('input[type=text], input[type=email], input[type=number], input[type=password], select').val('');
	$('input:checkbox, input:radio').prop('checked', false);
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
        (res.status) ? toastr.success(res.msg) : toastr.error(res.msg);
        return res;
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
