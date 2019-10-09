
$(() => {
    let $body = $('body');

	$body.on('form-success-add_user', function(res, data) {
        reloadAllTables();
	});

    $body.on('form-success-update_user', function(res, data) {
        reloadAllTables();
        $('#add-member').modal('hide');
    });

    $body.on('click', '#updateUser', async function(e) {
        let id = $(this).attr('ref_id');
        let route = $(this).attr('route');
        $('#add_user, #update_user').attr({'action': `/admin/update-user/${id}`, 'id': 'update_user'});
        $('label.error').remove();
        $('.error').removeClass('error');
        $('.modal-title').text('Update User');
        $('.modal-footer input').val('Update');
        $('#add-member').modal('show');
        await updateRecord('#update_user', route);
    });

    $body.on('click', '#add-user', function() {
        $('label.error').remove();
        $('.error').removeClass('error');
        $('#update_user').attr({'action': '/admin/create-user', 'id': 'add_user'});
        $('.modal-title').text('Add User');
        $('.modal-footer input').val('Add User');
        $(this).find('form').trigger('reset');
    });

    $body.on('click', '#deleteUser', async function(e) {
        let route = $(this).attr('route');
        await deleteRecord(route, $(`#${$(this).parents('table').attr('id')}`).DataTable(), $(this));
    });

    $body.on('click', '#updateUserStatus', async function(e) {
        let route = $(this).attr('route');
        await toggleStatus(route, $(`#${$(this).parents('table').attr('id')}`).DataTable(), $(this));
    });

    $body.on('form-success-add_company', function(res, data) {
        $('#companies_table').DataTable().ajax.reload();
    });

    $body.on('form-success-update_company', function(res, data) {
        $('#companies_table').DataTable().ajax.reload();
        $('#add-company').modal('hide');
    });

    $body.on('click', '#updateCompany', async function(e) {
        let selector = $('#add-company');
        let id = $(this).attr('ref_id');
        let route = $(this).attr('route');
        $('#add_company, #update_company').attr({'action': `/admin/update-company/${id}`, 'id': 'update_company', 'reset': 'false'});
        $('label.error').remove();
        $('.error').removeClass('error');
        selector.find('.modal-body > .invites > label').text('Update Company');
        selector.find('.modal-body input[type=submit]').val('Update');
        selector.modal('show');
        let res = await ajaxRequest(route, 'post');
        populateFields('#update_company', res.data);
        return res;
    });

    $body.on('click', '#create-company', function(e) {
        let selector = $('#add-company');
        selector.find('.modal-body > .invites > label').text('Add Company');
        selector.find('.modal-body input[type=submit]').val('Add');
        $('#update_company').attr({'action': `/admin/add-company`, 'id': 'add_company', 'reset': 'true'});
    });

    $body.on('click', '#deleteCompany', async function(e) {
        let route = $(this).attr('route');
        await deleteRecord(route, $(`#${$(this).parents('table').attr('id')}`).DataTable(), $(this));
    });

    $body.on('click', '#updateCompanyStatus', async function(e) {
        let route = $(this).attr('route');
        await toggleStatus(route, $(`#${$(this).parents('table').attr('id')}`).DataTable(), $(this));
    });

    $body.on('click', '#viewAssociatedAgents', async function() {
        let route = $(this).attr('route');
        let res = await ajaxRequest(route, 'get');
        $('#add-company').modal('show');
        $('.share_list_popup > ul').empty();
        for(let i = 0 ; i < res.length ; i++) {
            $('.share_list_popup ul').append('<li>"' + res[i]['first_name'] + res[i]['last_name'] +'"</li><br>');
        }
    });

    let columns = ['id', 'first_name', 'email', 'phone_number'];
    // +++++ Agents Table +++++ //
    let columnDefs = [{
            render: (data, type, row) => {
                return row.first_name+' '+row.last_name;
            },
            targets: 0
        },
        {
            render: (data, type, row) => {
                return `<i class="fa fa-edit px-2 action-btn" id="updateUser" ref_id="${row.id}" route="/admin/edit-user/${row.id}"></i>
                        <i class="fa fa-trash action-btn" id="deleteUser" ref_id="${row.id}" route="/admin/delete-user/${row.id}"></i>`;
            },
            targets: 4
        }];
    dataTables('#agents_table', '/admin/get-agents', columns, columnDefs);

    // +++++ Renters Table +++++ //
    columnDefs = [{
        render: (data, type, row) => {
            return row.first_name+' '+row.last_name;
        },
        targets: 0
        },
        {
        render: (data, type, row) => {
            return `<i class="fa ${row.status ? 'fa-eye' : 'fa-eye-slash'} action-btn" id="updateUserStatus" ref_id="${row.id}" route="/admin/status-update/${row.id}"></i>
                    <i class="fa fa-edit px-2 action-btn" id="updateUser" ref_id="${row.id}" route="/admin/edit-user/${row.id}"></i>
                    <i class="fa fa-trash action-btn" id="deleteUser" ref_id="${row.id}" route="/admin/delete-user/${row.id}"></i>`;
        },
        targets: 4
    }];
    dataTables('#renters_table', '/admin/get-renters', columns, columnDefs);

    // +++++ Companies Table +++++ //
    columnDefs = [{
            render: (data, type, row, a) => {
                return ++ a.row;
                }, targets: 0
            },
        {
            render: (data, type, row) => {
                return `<i class="fa  fa-eye action-btn" id="viewAssociatedAgents" ref_id="${row.id}" route="/admin/view-associated-agents/${row.id}"></i>`;
            },
            targets: 2
    }];
    dataTables('#companies_table', '/admin/get-companies-with-agents', ['id', 'company', 'status'], columnDefs);
});

function reloadAllTables() {
    $('#agents_table').DataTable().ajax.reload();
    $('#renters_table').DataTable().ajax.reload();
}
