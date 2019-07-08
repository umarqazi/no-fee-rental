$(() => {

    $('.input-style').attr('disabled', false);

    $('body').on('change', '#upload-file', function(e) {
    	let file = e.target.files[0];
    	imagePreview(file, '#img');
    	$('#img').attr('style', 'width: 180px;height: 145px;margin-bottom: 15px;');
    });

    function imagePreview(file, targetId) {
    	let fr = new FileReader();
    	fr.onload = function(e) {
    		$(targetId).attr('src', e.target.result);
    	}

    	fr.readAsDataURL(file);
    }

    $('body').on('click', '#add-user', function() {
        $('#add_user').attr('action', '/admin/create-user');
        $('.modal-title').text('Add User');
        $('.modal-footer input').val('Add User');
        $('#user_type').val('');
        $('input[type=text], input[type=email]').val('');
    });

    $('body').on('click', '.page-link', async function(e) {
        e.preventDefault();
        var res = await ajaxRequest(e.target.href, 'get');
        $('.pagination').siblings('div.listing-row').remove();
        $('body').find('div.col-sm-6').remove();
        $('.page-item').removeClass('active');
        $(this).parents('.page-item').addClass('active');
        let currentTab = $(this).parents('div.active').attr('id');
        if(currentTab == 'listing-active') {
            res.listing.active.data.forEach((a, index) => {
                $('.pagination:first').before(listView(dataCollection(a), a.id, true));
                $('.pagination:last').before(gridView(dataCollection(a), a.id, true));
            });
        }

        if(currentTab == 'listing-inactive') {
            res.listing.inactive.data.forEach((a, index) => {
                $('.pagination').before(listView(dataCollection(a), a.id, false));
                $('.pagination:last').before(gridView(dataCollection(a), a.id, false));
            });
        }
    });
});

function dataCollection(data) {
    return obj = {
        title: data.display_address,
        baths: data.baths+' Baths',
        beds: data.bedrooms+ ' Beds',
        rent: '$ '+data.rent,
        img: '/storage/'+data.thumbnail,
        postedBy: data.created_at
    };
}

function confirm(msg) {
    return swal({
      title: "Are you sure?",
      text: msg,
      icon: "warning",
      buttons: [
        'No, cancel it!',
        'Yes, I am sure!'
      ],
      dangerMode: true,
    }).then(function(isConfirm) {
      return (isConfirm) ? true : false
    });
}
// call by inactive tab
async function active(id, target) {
    if(await confirm('You want to publish this property?')) {
        ajaxRequest(`/admin/listing-status/${id}`, 'post');
        
        let grid_view = null;
        let list_view = null;
        let collection = null;
        let active = parseInt(($('.nav-item:first').find('a').text()).match(/\d+/)[0]) + 1;
        let inactive = parseInt(($('.nav-item:eq(1)').find('a').text()).match(/\d+/)[0]) - 1;
        let grid_index = $(target).parents('div.listing-row').index();
        let list_index = $(target).parents('div.col-lg-3').index();

        if(grid_index < 0) {
            // Active Grid View
            collection = buildCollection($(target).parents('div.col-lg-3'));
            list_view = $('.listing-wrapper:eq(1)').find(`.listing-row:eq(${list_index})`);
            grid_view = $(target).parents('div.col-lg-3');
        }

        if(list_index < 0) {
            // list background changes
            collection = buildCollection($(target).parents('div.listing-row'));
            list_view = $(target).parents('div.listing-row');
            grid_view = $('.grid-view-wrapper:eq(1)').find(`.col-sm-6:eq(${grid_index})`);
        }

        $('.listing-wrapper:first, .grid-view-wrapper:first').find('.null').remove();

        $('.listing-wrapper:first').append(listView(collection, id, true, 'inactive('+id+', this)'));

        $('.grid-view-wrapper:first').find('.row').append(gridView(collection, id, true, 'inactive('+id+', this)'));
        $(grid_view).remove();
        $(list_view).remove();

        if(inactive < 1) {
            $('.listing-wrapper:eq(1), .grid-view-wrapper:eq(1)').append('<p class="null">No Record Found</p>');
        }
        $('.nav-item:first > a').text(`Active ( ${active} )`);
        $('.nav-item:eq(1) > a').text(`Inactive ( ${inactive} )`);
        toastr.success('Listing has been unpublished');
    }
}
// call by active tab
async function inactive(id, target) {
    if(await confirm('You want to unpublish this property?')) {
        ajaxRequest(`/admin/listing-status/${id}`, 'post');

        let grid_view = null;
        let list_view = null;
        let collection = null;
        let active = parseInt(($('.nav-item:first').find('a').text()).match(/\d+/)[0]) - 1;
        let inactive = parseInt(($('.nav-item:eq(1)').find('a').text()).match(/\d+/)[0]) + 1;
        let grid_index = $(target).parents('div.listing-row').index();
        let list_index = $(target).parents('div.col-lg-3').index();

        if(grid_index < 0) {
            // Active Grid View
            collection = buildCollection($(target).parents('div.col-lg-3'));
            list_view = $('.listing-wrapper:first').find(`.listing-row:eq(${list_index})`);
            grid_view = $(target).parents('div.col-lg-3');
        }

        if(list_index < 0) {
            // list background changes
            collection = buildCollection($(target).parents('div.listing-row'));
            list_view = $(target).parents('div.listing-row');
            grid_view = $('.grid-view-wrapper:first').find(`.col-sm-6:eq(${grid_index})`);
        }

        $('.listing-wrapper:eq(1), .grid-view-wrapper:eq(1)').find('.null').remove();

        $('.listing-wrapper:eq(1)').append(listView(collection, id, false, 'active('+id+', this)'));

        $('.grid-view-wrapper:eq(1)').find('.row').append(gridView(collection, id, false, 'active('+id+', this)'));
        $(grid_view).remove();
        $(list_view).remove();

        if(active < 1) {
            $('.listing-wrapper:first, .grid-view-wrapper:first').append('<p class="null">No Record Found</p>');
        }
        $('.nav-item:first > a').text(`Active ( ${active} )`);
        $('.nav-item:eq(1) > a').text(`Inactive ( ${inactive} )`);
        toastr.success('Listing has been unpublished');
    }
}

async function approve(id, target) {
    if(await confirm('You want to approve this property?')) {
        ajaxRequest(`/admin/approve-listing-request/${id}`, 'post');

        let grid_view = null;
        let list_view = null;
        let collection = null;
        let active = parseInt(($('.nav-item:first').find('a').text()).match(/\d+/)[0]) + 1;
        let remaining = parseInt(($('.nav-item:last').find('a').text()).match(/\d+/)[0]) - 1;
        let grid_index = $(target).parents('div.listing-row').index();
        let list_index = $(target).parents('div.col-lg-3').index();

        if(grid_index < 0) {
            // Active Grid View
            collection = buildCollection($(target).parents('div.col-lg-3'));
            list_view = $('.listing-wrapper:first').find(`.listing-row:eq(${list_index})`);
            grid_view = $(target).parents('div.col-lg-3');
        }

        if(list_index < 0) {
            // list background changes
            collection = buildCollection($(target).parents('div.listing-row'));
            list_view = $(target).parents('div.listing-row');
            grid_view = $('.grid-view-wrapper:first').find(`.col-sm-6:eq(${grid_index})`);
        }

        $('.listing-wrapper:first, .grid-view-wrapper:first').find('.null').remove();

        $('.listing-wrapper:first').append(listView(collection, id, true, 'inactive('+id+', this)'));

        $('.grid-view-wrapper:first').find('.row').append(gridView(collection, id, true, 'inactive('+id+', this)'));

        $(grid_view).remove();
        $(list_view).remove();
        if(remaining < 1) {
            $('.listing-wrapper:last').append('<p class="null">No Record Found</p>');
        }
        $('.nav-item:first > a').text(`Active ( ${active} )`);
        $('.nav-item:last > a').text(`Pending Requests ( ${remaining} )`);
        toastr.success('Listing has been approved');
    }
}

async function makeFeatured(id, target) {
    if(await confirm('You want to mark this property as featured?')) {
        ajaxRequest(`/admin/ad-feature-request/${id}`, 'post');

        let grid_view = null;
        let list_view = null;
        let collection = null;
        let featured = parseInt(($('.nav-item:first').find('a').text()).match(/\d+/)[0]) + 1;
        let requested_feature = parseInt(($('.nav-item:last').find('a').text()).match(/\d+/)[0]) - 1;
        let grid_index = $(target).parents('div.listing-row').index();
        let list_index = $(target).parents('div.col-lg-3').index();

        if(grid_index < 0) {
            // Active Grid View
            collection = buildCollection($(target).parents('div.col-lg-3'));
            list_view = $('.listing-wrapper:first').find(`.listing-row:eq(${list_index})`);
            grid_view = $(target).parents('div.col-lg-3');
        }

        if(list_index < 0) {
            // list background changes
            collection = buildCollection($(target).parents('div.listing-row'));
            list_view = $(target).parents('div.listing-row');
            grid_view = $('.grid-view-wrapper:first').find(`.col-sm-6:eq(${grid_index})`);
        }

        $('.listing-wrapper:first, .grid-view-wrapper:first').find('.null').remove();

        $('.listing-wrapper:first').append(listView(collection, id, true, 'removeFeatured('+id+', this)'));

        $('.grid-view-wrapper:first').find('.row').append(gridView(collection, id, true, 'removeFeatured('+id+', this)'));

        $(grid_view).remove();
        $(list_view).remove();
        if(requested_feature < 1) {
            $('.listing-wrapper:last').append('<p class="null">No Record Found</p>');
        }
        $('.nav-item:first > a').text(`Featured ( ${featured} )`);
        $('.nav-item:last > a').text(`Request Featured ( ${requested_feature} )`);
        toastr.success('Listing has been featured.');
    }
}

async function removeFeatured(id, target) {
    if(await confirm('You want to remove this property from featured?')) {
        ajaxRequest(`/admin/ad-feature-request/${id}`, 'post');

        let grid_view = null;
        let list_view = null;
        let collection = null;
        let featured = parseInt(($('.nav-item:first').find('a').text()).match(/\d+/)[0]) - 1;
        let requested_feature = parseInt(($('.nav-item:last').find('a').text()).match(/\d+/)[0]) + 1;
        let grid_index = $(target).parents('div.listing-row').index();
        let list_index = $(target).parents('div.col-lg-3').index();

        if(grid_index < 0) {
            // Active Grid View
            collection = buildCollection($(target).parents('div.col-lg-3'));
            list_view = $('.listing-wrapper:first').find(`.listing-row:eq(${list_index})`);
            grid_view = $(target).parents('div.col-lg-3');
        }

        if(list_index < 0) {
            // list background changes
            collection = buildCollection($(target).parents('div.listing-row'));
            list_view = $(target).parents('div.listing-row');
            grid_view = $('.grid-view-wrapper:first').find(`.col-sm-6:eq(${grid_index})`);
        }

        $('.listing-wrapper:eq(1), .grid-view-wrapper:eq(1)').find('.null').remove();

        $('.listing-wrapper:eq(1)').append(listView(collection, id, true, 'makeFeatured('+id+', this)'));

        $('.grid-view-wrapper:eq(1)').find('.row').append(gridView(collection, id, true, 'makeFeatured('+id+', this)'));

        $(grid_view).remove();
        $(list_view).remove();
        if(featured < 1) {
            $('.listing-wrapper:last').append('<p class="null">No Record Found</p>');
        }
        $('.nav-item:first > a').text(`Featured ( ${featured} )`);
        $('.nav-item:last > a').text(`Request Featured ( ${requested_feature} )`);
        toastr.success('Listing has been removed from featured');
    }
}

function listView(collection, id, isActive, method) {
    console.log(method);
    return `
            <div class="listing-row">
                <div class="img-holder">
                    <img src="${collection.img}" alt="" style="height: 205px;" class="main-img" />
                </div>
                <div class="info">
                    <p class="title">${collection.title}</p>
                    <p><i class="fa fa-tag"></i> ${collection.rent}</p>
                    <p>Freshmen Score : 90%</p>
                    <ul>
                        <li><i class="fa fa-bed"></i> ${collection.beds}</li>
                        <li><i class="fa fa-bath"></i> ${collection.baths}</li>
                    </ul>
                    <p><i class="fa fa-map-marker-alt"></i> ${collection.realtyMX}</p>
                    <p>${collection.postedBy}</p>
                    <a href="javascript:void(0);" onclick="${method}" title="Publish this property">${(isActive) ? '<span class="status">Active</span></a>' : '<span class="status" style="background:red;">Deactive</span></a>'}
                    <div class="actions-btns">
                        <a href="edit-list/${id}"><span><img src="images/edit-icon.png" alt=""></span></a>
                        <span><img src="images/copy-icon.png" alt=""></span>
                        <a href="listing-repost/${id}"><button type="button" class="border-btn">Repost</button></a>
                        <button type="button" class="border-btn">Request Feature</button>
                    </div>
                </div>
            </div>
        `;
}

function gridView(collection, id, isActive, method) {
    return `
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="listing-thumb">
                        <img src="${collection.img}" alt="" style="width: 400px;" class="main-img" />
                        <div class="info">
                            <p class="title">${collection.title}</p>
                            <p><i class="fa fa-tag"></i> ${collection.rent}</p>
                            <p>Freshmen Score : 90%</p>
                            <ul>
                                <li><i class="fa fa-bed"></i> ${collection.beds}</li>
                                <li><i class="fa fa-bath"></i> ${collection.baths}</li>
                            </ul>
                            <p><i class="fa fa-map-marker-alt"></i> ${collection.realtyMX}</p>
                            <p>${collection.postedBy}</p>
                            <a href="javascript:void(0);" onclick="${method}" title="Publish this property">${(isActive) ? '<span class="status">Active</span></a>' : '<span class="status" style="background:red;">Deactive</span></a>'}</a>
                            <div class="actions-btns">
                                <a href="listing-repost/${id}"><button type="button" class="border-btn">Repost</button></a>
                                <button type="button" class="border-btn">Request Feature</button>
                            </div>
                            <div class="list-actions-icons">
                                <a href="edit-list/${id}"><button><i class="fa fa-edit"></i></button></a>
                                <button><i class="fa fa-copy"></i></button>
                            </div>
                        </div>
                </div>
            </div>
        `;
}

function buildCollection(DOM) {
    return obj = {
        title: $(DOM).find('p.title').text(),
        img: $(DOM).find('img:first').attr('src'),
        baths: $(DOM).find('ul > li:last').text(),
        beds: $(DOM).find('ul > li:first').text(),
        rent: $(DOM).find('.info > p:eq(1)').text(),
        realtyMX: $(DOM).find('.info > p:eq(3)').text(),
        postedBy: $(DOM).find('.info > p:eq(4)').text(),
    }
}

function ajaxRequest(url, type, loader = false) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
        },
    });
    
    return $.ajax({
        url: url,
        type: type,
        beforeSend: function() {

        },

        success: function(res) {
            return res;
        },

        error: function(err) {
            toastr.error(err);
        }
    });
}