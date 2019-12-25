
$('body').on('input select', '#neighborhood', function () {
    window.location.href = `${window.location.origin}/listing-by-neighborhood/${$(this).val()}`;
})