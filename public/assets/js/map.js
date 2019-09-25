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
    map = new google.maps.Map(displaySelector, {
        center: setLatLng(coords),
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
        animation: google.maps.Animation.DROP,
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
    coords = [JSON.parse(coords)];
    let markers = coords.map(function(location) {
        setMap(location, selector);
        let mark = addMarker(location);
        google.maps.event.addListener(mark, "click", async function (e) {
            console.log(e);
            let coords = JSON.stringify({latitude: e.latLng.lat(), longitude: e.latLng.lng()});
            let res = await ajaxRequest(`listing-detail`, 'post', {map_location: coords});
            showInfoWindow(`<a href="javascript:void(0)"><div class="location-thumbnaail"><img src="${document.location.origin}/storage/${res.data.thumbnail}"><div class="price-wrapp"><p class="price"> $${res.data.rent} </p><div class="additional-info"><p>${res.data.street_address} #2</p><ul><li><p>${res.data.bedrooms}</p>Beds</li><li><p>${res.data.baths}</p>Rooms</li></ul></div></div></div></a>`, mark);
        google.maps.event.addListener(map, 'click', function(e) {closeInfoWindow();});
        });
        return mark;
    });

    let cluster = new MarkerClusterer(map, markers, {
        imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'
    });
    google.maps.event.addListener(cluster, 'clusterclick', function (e) {
        let markers = e.markerClusterer_.markers_;
        markers.forEach(val => {
            let coord = {
                latitude: val.position.lat(),
                longitude: val.position.lng()
            };

            console.log(coord);
        });
    });
};

/**
 *
 * @param searchSelector
 * @returns {google.maps.places.Autocomplete}
 */
const autoComplete = (searchSelector) => {
    let autocomplete = new google.maps.places.Autocomplete(searchSelector);
    autocomplete.setFields(['adr_address']);
    return autocomplete;
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
        radius: 250,
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
 */
const initMap = (selector) => {
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
const mapWithNearbyLocations = (coords, mapSelector, nearByLocations = false, Zoom = 16) => {
    if (coords !== null && coords !== '') {
        coords = (typeof coords !== 'object') ? JSON.parse(coords) : coords;
        ZOOM = Zoom;
        setMap(coords, mapSelector);
        latLngToAddr(coords).then(location => {

            let index = location.findIndex(findIndex);

            if(nearByLocations) {
                findSubways(coords); findSchools(coords);
            }

            if (index !== -1) {
                marker = addMarker(coords, location[0].formatted_address);
                showInfoWindow(location[0].formatted_address, marker);
            }
        });
    }
};
