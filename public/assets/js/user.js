
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
        $('#add_user, #update_user').attr({'action': `/admin/update-user/${id}`, 'id': 'update_user','reset' : 'true' });
        $('label.error').remove();
        $('.error').removeClass('error');
        $('.modal-title').text('Update User');
        $('.modal-footer input').val('Update');
        $('#add-member').modal('show');
        $('[name="email"]').rules('remove', 'remote') ;
        await updateRecord('#update_user', route);
    });

    $body.on('click', '#add-user', function() {
        $('label.error').remove();
        $('.error').removeClass('error');
        $('#update_user').attr({'action': '/admin/create-user', 'id': 'add_user'});
        $('.modal-title').text('Add User');
        $('.modal-footer input').val('Add User');
        $('#first_name').val('');
        $('#last_name').val('');
        $('#email').val('');
        $('#phone_number').val('');
        $('#user_type').val('');
        $('[name="email"]').rules('add', {
            remote : {
                headers: {
                'X-CSRF-TOKEN': $('[name="_token"]').val()
            },
            url: "/verify-email",
            type: "post",
            },
            messages: {
                remote: "Email already taken."
            }
        });
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

    $body.on('click', '#viewAssociatedAgents', async function() {
        let route = $(this).attr('route');
        let count = 0 ;
        $('.agents_list_popup ol').empty();
        let res = await ajaxRequest(route, 'get');
        $('#add-company').modal('show');
        $('.share_list_popup ul').empty();
        $('.modal-header h4').empty();
        $('.modal-header h4').append(res[0]['company']['company'] +' Agent(s)');
        for(let i = 0 ; i < res.length ; i++) {
            count = i + 1 ;
            $('.agents_list_popup ol').append('<li style="color: black ; ">' + count +'- '+ res[i]['first_name'] +' '+res[i]['last_name'] +'</li></b><br>');
        }
    });

    // +++++ Agents Table +++++ //
    let columns = ['first_name', 'email', 'phone_number','license_number'];
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

    // +++++ Owner Table +++++ //
    columns = ['first_name', 'email', 'phone_number'];
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
        targets: 3
    }];
    dataTables('#owners_table', '/admin/get-owners', columns, columnDefs);

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
            targets: 3
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
    $('#owners_table').DataTable().ajax.reload();
    $('#companies_table').DataTable().ajax.reload();
}
