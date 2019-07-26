
$(() => {

	$('body').on('form-success-add_user', function(res, data) {
        reloadAllTables();
	});

    $('body').on('form-success-update_user', function(res, data) {
        reloadAllTables();
        $('#add-member').modal('hide');
    });

    $('body').on('click', '#updateUser', async function(e) {
        let id = $(this).attr('ref_id');
        let route = $(this).attr('route');
        $('#add_user, #update_user').attr({'action': `/admin/update-user/${id}`, 'id': 'update_user'});
        $('label.error').remove();
        $('.error').removeClass('error');
        $('.modal-title').text('Update User');
        $('.modal-footer input').val('Update');
        $('#add-member').modal('show');
        let res = await updateRecord('#update_user', route);
    });

    $('body').on('click', '#add-user', function() {
        $('label.error').remove();
        $('.error').removeClass('error');
        $('#update_user').attr({'action': '/admin/create-user', 'id': 'add_user'});
        $('.modal-title').text('Add User');
        $('.modal-footer input').val('Add User');
        resetForm();
    });

    $('body').on('click', '#deleteUser', async function(e) {
        let route = $(this).attr('route');
        await deleteRecord(route, $(`#${$(this).parents('table').attr('id')}`).DataTable(), $(this));
        
    });

    $('body').on('click', '#updateStatus', async function(e) {
        let route = $(this).attr('route');
        let res = await toggleStatus(route, $(`#${$(this).parents('table').attr('id')}`).DataTable(), $(this));
        (res.status) ? toastr.success(res.msg) : toastr.error(res.msg);
    });

    // +++++ Agents Table +++++ //
	$('#agents_table').DataTable({
        serverSide: true,
        processing: true,
        "ajax": {
            "url": "/admin/get-agents"
        },
        "columns": [
            { data: "id" },
            { data: "first_name", name: "first_name" },
            { data: "email" ,name: "email" },
            { data: "phone_number",name: "phone_number" }
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
                    return row.first_name+' '+row.last_name;
                },
                targets: 1
            },
            {
                render: (data, type, row) => {
                    return `<i class="fa ${row.status ? 'fa-eye' : 'fa-eye-slash'} action-btn" id="updateStatus" ref_id="${row.id}" route="/admin/status-update/${row.id}"></i>
                            <i class="fa fa-edit px-2 action-btn" id="updateUser" ref_id="${row.id}" route="/admin/edit-user/${row.id}"></i>
                            <i class="fa fa-trash action-btn" id="deleteUser" ref_id="${row.id}" route="/admin/delete-user/${row.id}"></i>`;
                },
                targets: 4
            }
        ]
    });

    // +++++ Renters Table +++++ //
    $('#renters_table').DataTable({
        serverSide: true,
        processing: true,
        "ajax": {
            "url": "/admin/get-renters"
        },
        "columns": [
            { data: "id", name: 'id' },
            { data: "first_name", name: "first_name" },
            { data: "email" ,name: "email" },
            { data: "phone_number",name: "phone_number" }
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
                    return row.first_name+' '+row.last_name;
                },
                targets: 1
            },
            {
                render: (data, type, row) => {
                    return `<i class="fa ${row.status ? 'fa-eye' : 'fa-eye-slash'} action-btn" id="updateStatus" ref_id="${row.id}" route="/admin/status-update/${row.id}"></i>
                            <i class="fa fa-edit px-2 action-btn" id="updateUser" ref_id="${row.id}" route="/admin/edit-user/${row.id}"></i>
                            <i class="fa fa-trash action-btn" id="deleteUser" ref_id="${row.id}" route="/admin/delete-user/${row.id}"></i>`;
                },
                targets: 4
            }
        ]
    });
});

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

function reloadAllTables() {
    $('#agents_table').DataTable().ajax.reload();
    $('#renters_table').DataTable().ajax.reload();
}

/**
 *
 * @param id
 * @returns {Promise<void>}
 */
async function updateRecord(form_id, route) {
    let res = await ajaxRequest(route, 'post');
    populateFields(form_id, res.data);
    return res;
}

/**
 *
 * @param from
 * @param data
 * @returns {*}
 */
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
