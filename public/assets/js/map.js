

"use strict";

let map, marker, coords;
let defaultCoords =  {lat: 40.785091, lng: -73.968285}; // New York Center point
let mapPoint = document.getElementById('map');
const ZOOM = 15;
const NAVIGATOR = navigator.geolocation;
const GEOCODER = new google.maps.Geocoder();
let infowindow = new google.maps.InfoWindow();

const MAP = {

    initMap: () => {
        map = new google.maps.Map(mapPoint, {
            center: new google.maps.LatLng(defaultCoords.lat, defaultCoords.lng),
            zoom: 10
        });
    },

    setMapLocation: (coords) => {
        let myStyles =[{
            featureType: "poi",
            elementType: "labels",
            stylers: [{ visibility: "off" }]
        }];
        map = new google.maps.Map(mapPoint, {
            center: new google.maps.LatLng(coords.latitude, coords.longitude),
            zoom: 12,
            styles: myStyles
        });
    },

    defaultBound: () => {
        let defaultbounds = new google.maps.LatLngBounds(
            new google.maps.LatLng(33.738045, 73.084488),
            new google.maps.LatLng(33.738045, 73.084488)
        );
        let options = {
            bounds: defaultbounds
        };
        return options;
    },

    toolTip: (place) => {
        infowindow.setContent(place);
        infowindow.open(map, marker);
        setTimeout(() => {
            infowindow.close(marker);
        }, 5000);
    },

    getLatLngByAddress: (address) => {
        return new Promise((res, rej) => {
            GEOCODER.geocode({address: address}, (latlng) => {
                res(latlng);
            }, rej);
        });
    },

    getAddressByLatLng: (coords) => {
        return new Promise((res, rej) => {
            GEOCODER.geocode({
                location: new google.maps.LatLng(coords.latitude, coords.longitude)
                }, (address) => {
                res(address);
            }, rej);
        });
    },

    getCurrentLocation: () => {
        if (NAVIGATOR) {
            return new Promise((res, rej) => {
                NAVIGATOR.getCurrentPosition(res, rej);
            });
        }

        alert('Your browser is not support the geolocation service.');
    },

    autoCompletePlaces: (selector) => {
        new google.maps.places.Autocomplete(selector, MAP.defaultBound());
    },

    addMarker: (coords, title = null) => {
        let icon = {
            url: document.location.origin+'/assets/images/map-icon.png', // url
            scaledSize: new google.maps.Size(30, 30), // scaled size
        };
        return new google.maps.Marker({
            map: map,
            title: title,
            icon: icon,
            animation: google.maps.Animation.DROP,
            position: new google.maps.LatLng(coords.lat, coords.lng)
        });
    },

    setMultiMarkers: (coords) => {
        coords.forEach((cord) => {
            MAP.setMapLocation(cord);
            MAP.getAddressByLatLng(cord).then(place => {
                marker = MAP.addMarker({lat: cord.latitude, lng: cord.longitude}, place[0].formatted_address);
                new google.maps.event.addListener(marker, 'click', function(e){
                    console.log(e);
                });
            });
        });
    }
};

// Document Ready Methods
$(() => {
  let $body = $('body');
  $body.on('keyup', '#controls', function() {
      MAP.autoCompletePlaces(document.getElementById('controls'));
  });

  $body.on('blur', '#controls', function() {
    setTimeout(() => {
      MAP.getLatLngByAddress($('body').find('#controls').val()).then(res => {
        coords = {latitude: res[0].geometry.location.lat(), longitude: res[0].geometry.location.lng()};
        $('input[name=map_location]').val(JSON.stringify(coords));
        MAP.setMapLocation(document.getElementById('map'), coords);
        marker = MAP.addMarker({ lat: coords.latitude, lng: coords.longitude });
        MAP.toolTip($('body').find('#controls').val());
      });
    }, 500);
  });
});

// Map Initialize
window.onload = function() {
    let coords = $('body').find('input[name=map_location]');
    if(coords.length > 1) {
        let coordsCollection = [];
        coords.each((index, value) => {
            coordsCollection.push(JSON.parse($(value).val()));
        });
        MAP.setMultiMarkers(coordsCollection);
        return;
    }

    coords = coords.val();
    if(coords !== null && coords !== '') {
        coords = JSON.parse(coords);
        MAP.setMapLocation(coords);
        MAP.getAddressByLatLng(coords).then(place => {
            marker = MAP.addMarker({ lat: coords.latitude, lng: coords.longitude });
            MAP.toolTip(place[0].formatted_address);
        });
        return;
    }

    MAP.getCurrentLocation().then(latlng => {
        MAP.setMapLocation(latlng.coords);
        MAP.getAddressByLatLng(latlng.coords).then(place => {
            marker = MAP.addMarker({lat: latlng.coords.latitude, lng: latlng.coords.longitude});
            MAP.toolTip(place[0].formatted_address);
        });
    });
};
