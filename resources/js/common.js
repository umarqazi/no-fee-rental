
function populateFields(form, data) {
    $.each(data, function(key, value) {  
        var ctrl = $('[name='+key+']', form);  
        switch(ctrl.prop("type")) { 
            case "radio": case "checkbox":  
                ctrl.each(function() {
                    if($(this).attr('value') == value) $(this).attr("checked",value);
                });   
                break;
            default:
                ctrl.val(value); 
        }  
    });  
}

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
			if(!res.status) {
				toastr.error(res.msg);
				return false;
			}

			toastr.success(res.msg);
			return res;
		},

		error: (err) => {
			$('.loader').hide();
			if(err.status == 422) {
				populateErrors(form, err.responseJSON.errors);
				return;
			}

			toastr.error(err.responseJSON.msg);
			return;
		}
	});

		return res;
}



function setHeaders() {
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
		}
	});
}

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
		if(reset == 'true'){
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
		return (isConfirm) ? true : false
	});
}

function resetForm() {
	$('input[type=text], input[type=email], input[type=number], input[type=password], select').val('');
	$('input:checkbox, input:radio').prop('checked', false);
}
