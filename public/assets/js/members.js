$(() => {

    $('body').on('click', '.unfriend-user > a', async function (e) {
        e.preventDefault();
        let name = $(this).parents('.team-listing').find('.name').text();
        if(await confirm(`You want to un-friend ${name}`)) {
            window.location.href = $(this).attr('href');
        }
    });

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
