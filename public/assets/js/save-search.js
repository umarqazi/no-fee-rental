
$(() => {
    let $body = $('body');
    $body.find('.remove-save-search').on('click', async function() {

        if(await confirm('Sure to remove this search?')) {
            let url = `delete-save-search/${$(this).attr('id')}`;
            await ajaxRequest(url, 'get').then(res => {
                $(this).parents('.search-list:first').remove();
                if($body.find('.search-list').length < 1) {
                    $body.find('.search-header').after('<div class="save-search-keywords"><span>No Keywords Found</span></div>');
                }
            });
        }

    });
});
