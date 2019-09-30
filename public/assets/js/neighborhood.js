
$(() => {
    $(".neighborhood-search .search-result-wrapper .map-wrapper .swipe-btn").click(function() {
        $(this).find('i').toggleClass('fa-angle-left fa-angle-right');
        $(".neighborhood-search .search-result-wrapper .search-listing").toggleClass('hide-list');
        $(".neighborhood-search .search-result-wrapper .map-wrapper").toggleClass('full-map');
    });

    $(".mobile-view-dropdown").click(function(){
        $(this).find("i").toggleClass('fa-bars fa-times');
        $("#mobile-tabs-collapse").slideToggle();
    });

    $(".mobile-map-icon").click(function(){
        $(this).find("i").toggleClass('fa-map-marker-alt fa-times');
        $("#mobile-map-listing-view").slideToggle();
    });

    $('.owl-slider #carouselNeighbour').owlCarousel({
        autoplay: true,
        responsiveClass: true,
        autoHeight: true,
        smartSpeed: 1000,
        dots:false,
        autoplaySpeed:1000,
        autoplayTimeout: 1000,
        nav: true,
        responsive: {
            0: {
                items: 1
            },

            600: {
                items: 3
            },

            1024: {
                items: 3
            },

            1366: {
                items: 3
            }
        }
    });
});

window.onload = function() {
    let coords = $('body').find('input[name=map_location]').val();
    if (coords !== null && coords !== '') {
        coords = JSON.parse(coords);
        let location = $('body').find('#controls').val();
        ZOOM = 16;
        setMap(coords, document.getElementById('map'));
        if (location === undefined) {
            latLngToAddr(coords).then(location => {
                let index = location.findIndex(findIndex);
                findSubways(coords); findSchools(coords);
                if (index !== -1) {
                    marker = addMarker(coords, location[index].formatted_address);
                    showInfoWindow(location[index].formatted_address, marker);
                }
            });
        } else {
            marker = addMarker(coords, location);
            showInfoWindow(location, marker);
        }
    }

    // Add listing
    // myLocation().then(coords => {
    //     setMap(coords);
    //     latLngToAddr(coords).then(address => {
    //         marker = addMarker(coords, address[0].formatted_address);
    //         showInfoWindow(address[0].formatted_address, marker);
    //     });
    // });
};
