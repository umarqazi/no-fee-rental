
let $body = $('body');

$body.on('input select', '#neighborhood', function () {
    window.location.href = `${window.location.origin}/listing-by-neighborhood/${$(this).val()}`;
});

$('#add_neighborhood').on('click', function () {
    $body.find('input[type=submit]').val('Create');
})

$body.on('click', '#viewNeighborhoodContent', async function() {
    let $id = $(this).attr('ref_id');
    await ajaxRequest(`neighborhood/edit/${$id}`, 'post').then(res => {
        let $src = res.data.banner !== null ? res.data.banner : `assets/images/default-images/listing.jpeg`;
        $('#boro').text(res.data.boro.boro);
        $('#name').text(res.data.name);
        $('#banner').attr('src', `${window.location.origin}/${$src}`);
        $('#content').text(res.data.content !== null ? res.data.content : 'Null');
        $('#view-content').modal('show');
    }).catch(err => {

    });
});

$body.on('click', '#updateNeighborhood', async function() {
    let $id = $(this).attr('ref_id');
    await ajaxRequest(`neighborhood/edit/${$id}`, 'post').then(res => {
        let $neighborhood = $('#neighborhood-from');
        $neighborhood.attr('action', `/admin/neighborhood/update/${$id}`);
        $body.find('input[name=neighborhood]').val(res.data.name);
        $neighborhood.append(`<input type="hidden" value="${res.data.banner}" name="banner">`);
        $body.find('select[name=boro_id]').val(res.data.boro_id);
        $body.find('textarea[name=content]').val(res.data.content);
        $body.find('input[type=submit]').val('Update');
        $('#add-neighborhood').modal('show');
    });
});

$body.on('click', '#deleteNeighborhood', async function() {
    if(await confirm('Want to delete this neighborhood?')) {
        let $id = $(this).attr('ref_id');
        ajaxRequest(`/admin/neighborhood/delete/${$id}`, 'post');
        $(`#${$(this).parents('table').attr('id')}`).DataTable().ajax.reload();
    }
});