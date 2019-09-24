"use strict";

let $body = $('body');
let ZOOM = 10;
const NAVIGATOR = navigator.geolocation;
const RADIUS = 1500;
const GEOCODER = new google.maps.Geocoder();

let map, marker;
let defaultCoords =  {latitude: 40.785091, longitude: -73.968285}; // New York Center point
let mapDisplayTag = document.getElementById('map');
let searchSelector = document.getElementById('controls');
let infowindow = new google.maps.InfoWindow();

const setLatLng = (coords) => {
    return new google.maps.LatLng(coords.latitude, coords.longitude);
};

const setMap = (coords = defaultCoords, radius = 0, types = [], styles = null) => {
    map = new google.maps.Map(mapDisplayTag, {
        center: setLatLng(coords),
        zoom: ZOOM,
        radius: radius,
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

const myLocation = () => {
    if (NAVIGATOR) {
        return new Promise((res) => {
            NAVIGATOR.getCurrentPosition(async (position) => {
                res(position.coords);
            });
        });
    }
};

const latLngToAddr = (coords) => {
    return new Promise((res) => {
        GEOCODER.geocode({location: setLatLng(coords)}, async (address) => {
            res(address);
        });
    });
};

const addrToLatLng = (address) => {
    return new Promise((res) => {
        GEOCODER.geocode({address: address}, (coords) => {
            res(coords);
        });
    });
};

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

const markerClusters = (coords) => {
    let markers = coords.map(function(location) {
        setMap();
        let mark = addMarker(location);
        mark.set("id", 1);
        console.log(mark.get("id"));
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

const autoComplete = () => {
    let autocomplete = new google.maps.places.Autocomplete(searchSelector);
    autocomplete.setFields(['adr_address']);
    return autocomplete;
};

const showInfoWindow = (content, marker) => {
    infowindow.setContent(content);
    infowindow.open(map, marker);
};

const closeInfoWindow = async () => {
    infowindow.close();
};

const findIndex = (location) => {
    return location.formatted_address === $('.title-subtext').text();
};

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
const findSubways = async (coords) => {
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

const setSubways = (title) => {
    $('#no-subway').remove();
    $('.location-map-sec').find('.row:last > div:first > ul').append(`<li>${title}</li>`);
};

const setSchools = (title) => {
    $('#no-school').remove();
    $('.mob-top-mrg').find('ul').append(`<li>${title}</li>`);
};

// Document Ready Methods
$(() => {
  $body.on('keyup', '#controls', function() {
      autoComplete();
  });

  $body.on('blur', '#controls', function() {
    setTimeout(() => {
      addrToLatLng($('body').find('#controls').val()).then(coords => {
          console.log(coords);
          coords = {
              latitude: coords[0].geometry.location.lat(),
              longitude: coords[0].geometry.location.lng()
          };
          $('input[name=map_location]').val(JSON.stringify(coords));
          setMap(coords);
          marker = addMarker(coords);
          showInfoWindow($('body').find('#controls').val(), marker);
      });
    }, 500);
  });
});

// Map Initialize
window.onload = function() {
    // Search listing
    let coords = $body.find('input[name=map_location]');
    if(coords.length > 0 && window.location.pathname === '/search') {
        let coordsCollection = [];
        coords.each((index, value) => {
            coordsCollection.push(JSON.parse($(value).val()));
        });
        markerClusters(coordsCollection);
        return;
    }

    // Update listing
    coords = coords.val();
    if(coords !== null && coords !== '') {
        coords = JSON.parse(coords);
        let location = $('body').find('#controls').val();
        ZOOM = 16;
        setMap(coords);
        if(location === undefined) {
            latLngToAddr(coords).then(location => {
                let index = location.findIndex(findIndex);
                findSubways(coords);findSchools(coords);
                if(index !== -1) {
                    marker = addMarker(coords, location[index].formatted_address);
                    showInfoWindow(location[index].formatted_address, marker);
                }
            });
        } else {
            marker = addMarker(coords, location);
            showInfoWindow(location, marker);
        }
        return;
    }

    // Add listing
    myLocation().then(coords => {
        setMap(coords);
        latLngToAddr(coords).then(address => {
            marker = addMarker(coords, address[0].formatted_address);
            showInfoWindow(address[0].formatted_address, marker);
        });
    });
};



