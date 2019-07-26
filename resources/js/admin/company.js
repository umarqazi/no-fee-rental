
$(() => {

	$('body').on('form-success-add_company', function(res, data) {
		$('#companies_table').DataTable().ajax.reload();
	});

	$('body').on('form-success-update_company', function(res, data) {
		$('#companies_table').DataTable().ajax.reload();
		$('#add-company').modal('hide');
	});	

	$('body').on('click', '#updateCompany', async function(e) {
		let id = $(this).attr('ref_id');
        let route = $(this).attr('route');
        $('#add_company, #update_company').attr({'action': `/admin/update-company/${id}`, 'id': 'update_company', 'reset': 'false'});
        $('label.error').remove();
        $('.error').removeClass('error');
        $('#add-company').find('.modal-body > .invites > label').text('Update Company');
        $('#add-company').find('.modal-body input[type=submit]').val('Update');
        $('#add-company').modal('show');
		let res = await ajaxRequest(route, 'post');
		populateFields('#update_company', res.data);
		return res;
	});

	$('body').on('click', '#create-company', function(e) {
		$('#add-company').find('.modal-body > .invites > label').text('Add Company');
		$('#add-company').find('.modal-body input[type=submit]').val('Add');
		$('#update_company').attr({'action': `/admin/add-company`, 'id': 'add_company', 'reset': 'true'});
		resetForm();
	});

	$('body').on('click', '#deleteCompany', async function(e) {
		let route = $(this).attr('route');
		if(await confirm('You want to delete?')) {
	        let res = await ajaxRequest(route, 'post', null);
	        $('#companies_table').DataTable().row($(this).parents('tr')).remove().draw();
	        (res.status) ? toastr.success(res.msg) : toastr.error(res.msg);
	        return res;
    	}
	});

	$('body').on('click', '#companyStatus', async function(e) {
        let route = $(this).attr('route');
        if(await confirm('Sure to perform this action?')) {
	        let res = await ajaxRequest(route, 'post', null);
	        if($(this).hasClass('fa-eye')) {
	            $(this).addClass('fa-eye-slash').removeClass('fa-eye');
	        } else if($(this).hasClass('fa-eye-slash')) {
	            $(this).addClass('fa-eye').removeClass('fa-eye-slash');
	        }
	        $('#companies_table').DataTable().ajax.reload();
	        (res.status) ? toastr.success(res.msg) : toastr.error(res.msg);
    	}
    });

	// +++++ Companes Table +++++ //
    $('#companies_table').DataTable({
        serverSide: true,
        processing: true,
        "ajax": {
            "url": "/admin/get-companies"
        },
        "columns": [
            { data: "id" },
            { data: "company" },
            { data: "status" },
        ],

        columnDefs: [
            {
                render: (data, type, row, a) => {
                    return ++ a.row;
                },
                targets: 0
            },
            {
                render: (data, type, row) => {
                    return (row.status) ? 'Approved' : 'Not Approved';
                },
                targets: 2
            },
            {
                render: (data, type, row) => {
                    return `<i class="fa ${row.status ? 'fa-eye' : 'fa-eye-slash'} action-btn" id="companyStatus" ref_id="${row.id}" route="/admin/company-status-update/${row.id}"></i>
                            <i class="fa fa-edit px-2 action-btn" id="updateCompany" ref_id="${row.id}" route="/admin/edit-company/${row.id}"></i>
                            <i class="fa fa-trash action-btn" id="deleteCompany" ref_id="${row.id}" route="/admin/delete-company/${row.id}"></i>`;
                },
                targets: 3
            }
        ]
    });
});

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

function resetForm() {
    $('input[type=text], input[type=email], input[type=number], input[type=password], select').val('');
    $('input:checkbox, input:radio').prop('checked', false);
}
