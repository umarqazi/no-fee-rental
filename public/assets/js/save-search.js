
$(() => {
    let $body = $('body');
    $body.find('.remove-save-search').on('click', function() {
        confirm('Sure to remove this search?').then(async res => {
            let url = `delete-save-search/${$(this).attr('id')}`;
            await ajaxRequest(url, 'get').then(res => {
                $(this).parents('.search-list:first').remove();
                if($body.find('.search-list').length < 1) {
                    $body.find('.search-header').after('<div><span>No Keywords Found</span></div>');
                }
            });
        });
    });
});
