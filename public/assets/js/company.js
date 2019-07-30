
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
		await deleteRecord(route, $(`#${$(this).parents('table').attr('id')}`).DataTable(), $(this));
	});

	$('body').on('click', '#updateCompanyStatus', async function(e) {
        let route = $(this).attr('route');
        let res = await toggleStatus(route, $(`#${$(this).parents('table').attr('id')}`).DataTable(), $(this));
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
                    return `<i class="fa ${row.status ? 'fa-eye' : 'fa-eye-slash'} action-btn" id="updateCompanyStatus" ref_id="${row.id}" route="/admin/company-status-update/${row.id}"></i>
                            <i class="fa fa-edit px-2 action-btn" id="updateCompany" ref_id="${row.id}" route="/admin/edit-company/${row.id}"></i>
                            <i class="fa fa-trash action-btn" id="deleteCompany" ref_id="${row.id}" route="/admin/delete-company/${row.id}"></i>`;
                },
                targets: 3
            }
        ]
    });
});