$(() => {

    fn.dataTable.ext.errMode = 'throw';

    $('#agent_invites_table').DataTable({
        "ajax": {
            "url": "/agent/all-invites"
        },
        columns: [
            {"data": "id"},
            {"data": "email"},
            {"data": "created_at"},
        ],
        columnDefs: [
            {
                render: (a, b, c) => {
                    return a;
                },
                targets: 0
            },
            {
                render: (a, b, c) => {
                    return a;
                },
                targets: 1
            },
            {
                render: (a, b, c) => {
                    return a;
                },
                targets: 2
            },
            {
                render: () => {
                    return 'abc';
                },
                targets: 3
            }
        ]
    });

});
