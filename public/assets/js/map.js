"use strict";

let ZOOM = 10;
const NAVIGATOR = navigator.geolocation;
const RADIUS = 1500;
const GEOCODER = new google.maps.Geocoder();
let map, marker;
let defaultCoords =  {latitude: 40.785091, longitude: -73.968285}; // New York Center point
let infowindow = new google.maps.InfoWindow();

/**
 *
 * @param coords
 * @returns {google.maps.LatLng}
 */
const setLatLng = (coords) => {
    if(coords === null) return;
    return new google.maps.LatLng(coords.latitude, coords.longitude);
};

/**
 *
 * @param coords
 * @param displaySelector
 * @param radius
 * @param types
 * @param styles
 * @returns {Map<any, any>}
 */
const setMap = (coords = defaultCoords, displaySelector, radius = 0, types = [], styles = null) => {
    coords = (typeof coords === 'object') ? coords : JSON.parse(coords);
    map = new google.maps.Map(displaySelector, {
        center: setLatLng(coords === null ? defaultCoords : coords),
        zoom: ZOOM,
        radius: radius !== 0 ? radius : RADIUS,
        types: types,
        styles: [
            {
                featureType: "poi",
                elementType: "labels",
                stylers: [
                    { visibility: "off" }
                ]
            }
        ]
    });

    addMarker(coords);
    return map;
};

/**
 *
 * @returns {Promise<unknown>}
 */
const myLocation = () => {
    if (NAVIGATOR) {
        return new Promise((res) => {
            NAVIGATOR.getCurrentPosition(async (position) => {
                res(position.coords);
            });
        });
    }
};

/**
 *
 * @param coords
 * @returns {Promise<unknown>}
 */
const latLngToAddr = (coords) => {
    return new Promise((res) => {
        GEOCODER.geocode({location: setLatLng(coords)}, async (address) => {
            res(address);
        });
    });
};

/**
 *
 * @param address
 * @returns {Promise<unknown>}
 */
const addrToLatLng = (address) => {
    return new Promise((res) => {
        GEOCODER.geocode({address: address}, (coords) => {
            res(coords);
        });
    });
};

/**
 *
 * @param coords
 * @param title
 * @param icon
 * @returns {google.maps.Marker}
 */
const addMarker = (coords, title = null, icon = null) => {
    marker = new google.maps.Marker({
        map: map,
        title: title,
        position: setLatLng(coords),
        icon: {
            url: icon !== null ? icon : `${document.location.origin}/assets/images/map-icon.png`, // url
            scaledSize: new google.maps.Size(30, 30), // scaled size
        },
    });

    return marker;
};

/**
 *
 * @param coords
 * @returns {[]}
 */
const setMultiMarkers = (coords) => {
    let markers = [];
    coords.forEach((cord) => {
        setMap();
        latLngToAddr(cord).then(address => {
            markers.push(addMarker(cord, address[0].formatted_address));
        });
    });

    return markers;
};

/**
 *
 * @param coords
 * @param selector
 */
const markerClusters = (coords, selector) => {
    let markers = null; ZOOM = 10;
    setMap(null, selector);
    markers = coords.map(function(coords) {
        coords = JSON.parse(coords);
        let mark = addMarker(coords);
        mark.addListener("click", async function(e) {
            let coords = JSON.stringify({latitude: e.latLng.lat(), longitude: e.latLng.lng()});
            let res = await ajaxRequest(`/listing-detail`, 'post', {map_location: coords});
            showInfoWindow(showListInfo(res), mark);
                google.maps.event.addListener(map, 'click', function(e) {closeInfoWindow();});
        });

        return mark;
    });

    // let cluster = new MarkerClusterer(map, markers, {
    //     imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'
    // });
};

/**
 *
 * @param res
 * @returns {string}
 */
const showListInfo = (resp) => {
    let html = '';
    let domain = window.location.origin;
    if(resp.data.length > 1) {
    resp.data.forEach((res, b) => {
        html += `<a href="${domain}/listing-detail/${res.id}"><div class="location-thumbnaail location-image-btm"><img style="height: 170px; width: 300px;" src="${domain}/${res.thumbnail}"><div class="price-wrapp price-wrap-location">
<p class="price" style="color:#223971">`+ '$'+res.rent.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,') +`</p><div class="additional-info">
<ul><li><p>${res.bedrooms}</p>Beds</li><li><p>${res.baths}</p>Baths</li></ul>
</div></div></div> <p>${res.street_address} </p></a>`;
    });
    }
    else {

        html += `<a href="${domain}/listing-detail/${resp.data[0].id}"><div class="location-thumbnaail location-image-btm"><img style="height: 170px; width: 300px;" src="${domain}/${resp.data[0].thumbnail}"><div class="price-wrapp price-wrap-location">
<p class="price" style="color:#223971">`+ '$'+resp.data[0].rent.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')+`</p><div class="additional-info">
<ul><li><p>${resp.data[0].bedrooms}</p>Beds</li><li><p>${resp.data[0].baths}</p>Baths</li></ul>
</div></div></div> <p>${resp.data[0].street_address} </p></a>`;
        setTimeout(() => {
        $('body').find('.gm-style-iw-d > div').addClass('single');
        $('.single').css({height: '100px', overflow: 'hidden'});
        },5);
    }
    return html;
};

/**
 *
 * @param searchSelector
 * @returns {google.maps.places.Autocomplete}
 */
const autoComplete = (searchSelector) => {
    let isValid = 0;
    let streetAddress = '';
    let displayAddress = '';
    let open = ['route'];
    let exclusive = ['street_number', 'route'];
    let autocomplete = new google.maps.places.Autocomplete(searchSelector);
    google.maps.event.addListener(autocomplete, 'place_changed', function() {
        let address = autocomplete.getPlace();
        console.log(address);
        address.address_components.forEach(_match => {
            _match.types.forEach(matchCriteria => {

                if(exclusive.includes(matchCriteria)) {
                    streetAddress += _match.short_name + ' ';
                    isValid ++;
                }

                if(open.includes(matchCriteria)) {
                    displayAddress += _match.long_name + ' ';
                }

            });
        });

        if(isValid < 1) {
            // address error
            let $validator = $("#listing-form").validate();
            let errors = { street_address: "Not a valid street address" };
            $validator.showErrors(errors);
        } else {
            $('#autofill').val(displayAddress);
            searchSelector.value = streetAddress;
        }
    });
    autocomplete.setComponentRestrictions({'country': ['us']});
    return streetAddress;
};

/**
 *
 * @param content
 * @param marker
 */
const showInfoWindow = (content, marker) => {
    infowindow.setContent(content);
    infowindow.open(map, marker);
};

/**
 *
 * @returns {Promise<void>}
 */
const closeInfoWindow = async () => {
    infowindow.close();
};

/**
 *
 * @param location
 * @returns {boolean}
 */
const findIndex = (location) => {
    return location.formatted_address === $('.title-subtext').text();
};

/**
 *
 * @param position
 * @param keyword
 * @returns {Promise<unknown>}
 */
const nearByPlaces = async (position, keyword) => {
    let request = {
        location: setLatLng(position),
        radius: 10000,
        keyword: keyword
    };

    let service = new google.maps.places.PlacesService(map);
    return new Promise(res => {
        service.nearbySearch(request, results => {
            res(results);
        });
    })
};

/**
 *
 * @param coords
 */
const findSubways = (coords) => {
    nearByPlaces(coords, 'station').then(res => {
        console.log(res);
        if(res.length > 0) {
            res.forEach(value => {
                let coords = {
                    latitude: value.geometry.location.lat(),
                    longitude: value.geometry.location.lng()
                };
                let icon = value.icon;
                let title = value.name;
                setSubways(title);
                addMarker(coords, title, icon);
            });
        } else {
            if($('#no-subway').length > 0) return;
            $('.location-map-sec').find('.row:last > div:first').append('<p id="no-subway">No Subways Found</p>');
        }
    });
};

/**
 *
 * @param coords
 */
const findSchools = (coords) => {
    nearByPlaces(coords, 'school').then(res => {
        if(res.length > 0) {
            res.forEach(value => {
                let coords = {
                    latitude: value.geometry.location.lat(),
                    longitude: value.geometry.location.lng()
                };
                let icon = value.icon;
                let title = value.name;
                setSchools(title);
                addMarker(coords, title, icon);
            });
        } else {
            if($('#no-school').length > 0) return;
            $('.mob-top-mrg').append('<p id="no-school">No Schools Found</p>');
        }
    });
};

/**
 *
 * @param title
 */
const setSubways = (title) => {
    $('#no-subway').remove();
    $('.location-map-sec').find('.row:last > div:first > ul').append(`<li>${title}</li>`);
};

/**
 *
 * @param title
 */
const setSchools = (title) => {
    $('#no-school').remove();
    $('.mob-top-mrg').find('ul').append(`<li>${title}</li>`);
};

/**
 *
 * @param selector
 * @param zoom
 */
const initMap = (selector, zoom = ZOOM) => {
    ZOOM = zoom;
    myLocation().then(coords => {
        setMap(coords, selector);
        latLngToAddr(coords).then(address => {
            marker = addMarker(coords, address[0].formatted_address);
            showInfoWindow(address[0].formatted_address, marker);
        });
    });
};

/**
 *
 * @param coords
 * @param mapSelector
 * @param nearByLocations
 * @param Zoom
 */
const mapWithNearbyLocations = (coords, mapSelector, nearByLocations = false, Zoom = 15) => {
    if (coords !== null && coords !== '') {
        ZOOM = Zoom;
        setMap(coords, mapSelector);
        latLngToAddr(coords).then(location => {

            let index = location.findIndex(findIndex);

            if(nearByLocations) {
                findSubways(coords);
                schoolZone(coords);
            }

            if (index !== -1) {
                marker = addMarker(coords, location[0].formatted_address);
                showInfoWindow(location[0].formatted_address, marker);
            }
        });
    }
};

/**
 *
 * @param coords
 * @returns {Promise<void>}
 */
const schoolZone = async (coords) => {
    coords = JSON.parse(coords);
    coords.range = 1200;

    await ajaxRequest('/school-zone', 'post', coords, false).then(polygonCoords => {
        polygonCoords = JSON.parse(polygonCoords);
        polygonCoords.forEach(coords => {
            let latLng = [];
            coords.forEach(res => {
                latLng.push(setLatLng(res));
            });

            let polygon = new google.maps.Polygon({
                paths: latLng
            });

            polygon.setMap(map);
        });

    }).catch(err => {
        console.log(err);
    });
};
