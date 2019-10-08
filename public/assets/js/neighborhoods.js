$(() => {
    let $body = $('body');

    function neighborhoodForm(current) {
        let form = current.parents('form');
        let val = $('input[name=neighborhoods]').val();
        form.attr('action', `${window.location.origin}/listing-by-neighborhood/${val}`);
        form.submit();
    }

    $body.find('.submit-neighbor').on('click', function () {
        neighborhoodForm($(this));
    });

    $(window).keydown(function(event){
        if(event.keyCode === 13) {
            event.preventDefault();
            return false;
        }
    });

    $body.on('change', '.sorting', function() {
        let append = true;
        let url = window.location.href;
        $('select[name=sorting]').find('option').each((i, v) => {
            let value = $(v).attr('value');
            if(value !== '' && url.includes(value)) {
                append = false;
            }
        });
        url = url.split('/');
        if(append) {
            url.push($(this).val());
        } else {
            url[url.length - 1] = $(this).val();
        }
        window.location.href = url.join('/');
    });

    $(".neighborhood-search .search-result-wrapper .map-wrapper .swipe-btn").on('click', function () {
        $(this).find('i').toggleClass('fa-angle-left fa-angle-right');
        $(".neighborhood-search .search-result-wrapper .search-listing").toggleClass('hide-list');
        $(".neighborhood-search .search-result-wrapper .map-wrapper").toggleClass('full-map');
    });

/*
    $(".mobile-view-dropdown").on('click', function () {
        $(this).find("i").toggleClass('fa-bars fa-times');
        $("#mobile-tabs-collapse").slideToggle();
    });
*/

    $(".mobile-map-icon").on('click', function () {
        $(this).find("i").toggleClass('fa-map-marker-alt fa-times');
        $("#mobile-map-listing-view").slideToggle();
    });

    $('.owl-slider #carouselNeighbour').owlCarousel({
        autoplay: true,
        responsiveClass: true,
        autoHeight: true,
        smartSpeed: 1000,
        dots: false,
        autoplaySpeed: 1000,
        autoplayTimeout: 1000,
        nav: true,
        responsive: {
            0: {
                items: 1
            },

            600: {
                items: 1
            },

            1024: {
                items: 3
            },

            1366: {
                items: 3
            }
        }
    });

    $body.on('form-success-add_neighborhood', function (res, data) {
        reloadTable();
    });

    $body.on('form-success-update_neighborhood', function (res, data) {
        reloadTable();
        $('#add-neighborhood').modal('hide');
    });

    $body.on('click', '#updateNeighborhood', async function (e) {
        let id = $(this).attr('ref_id');
        let route = $(this).attr('route');
        $('#add_neighborhood, #update_neighborhood').attr({
            'action': `/admin/neighborhood/update/${id}`,
            'id': 'update_neighborhood'
        });
        $('label.error').remove();
        $('.error').removeClass('error');
        $('.modal-title').text('Update Neighborhood');
        $('.modal-footer input').val('Update');
        $('#add-neighborhood').modal('show');
        let res = await updateRecord('#update_neighborhood', route);
        $('#neighborhood_name').val(res.data.name);
        $('#neighborhood_content').val(res.data.content);
    });

    $body.on('click', '#new-neighborhood', async function (e) {
        $('#add_neighborhood, #update_neighborhood').attr({
            'action': `/admin/neighborhood/create`,
            'id': 'add_neighborhood'
        });
        $('.modal-title').text('Add Neighborhood');
        $('.modal-footer input').val('Add Neighborhood');
        $('#neighborhood_name').val('');
        $('#neighborhood_content').val('');
        $('#add-neighborhood').modal('show');
    });

    $body.on('click', '#deleteNeighborhood', async function (e) {
        let route = $(this).attr('route');
        await deleteRecord(route, $(`#${$(this).parents('table').attr('id')}`).DataTable(), $(this));
    });

    $body.on('click', '#viewNeighborhoodContent', async function (e) {
        let route = $(this).attr('route');
        $('.modal-title').text('Neighborhood Content');
        $('#view-content').modal('show');
        let res = await updateRecord('#add_neighborhood', route);
        $('#neighborhood_content_view').val(res.data.content).attr('readonly', true);
    });

    function reloadTable() {
        $('#neighborhoods_table').DataTable().ajax.reload();
    }
});
