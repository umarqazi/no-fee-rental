
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

    $('body').on('click', '#viewAssociatedAgents', async function() {
        let route = $(this).attr('route');
        let res = await ajaxRequest(route, 'get');
        $('#add-company').modal('show');
        $('.share_list_popup ul').empty();
        for(let i = 0 ; i < res.length ; i++)
        {
            $('.share_list_popup ul').append('<li>"' + res[i]['first_name'] + res[i]['last_name'] +'"</li><br>');

        }
    });

    // +++++ Companies Table +++++ //
    $('#companies_table').DataTable({
        serverSide: true,
        processing: true,
        "ajax": {
            "url": "/admin/get-companies-with-agents"
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
                render: (data, type, row, a) => {
                    return row.company;
                },
                targets: 1
            },

            {
                render: (data, type, row) => {
                    return `<i class="fa  fa-eye action-btn" id="viewAssociatedAgents" ref_id="${row.id}" route="/admin/view-associated-agents/${row.id}"></i>`;
                },
                targets: 2
            }
        ]
    });
});
