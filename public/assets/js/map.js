

"use strict"

let map;
let marker;
let coords;
// Bound Search location to Pakistan Region
const bound = {
    lat: 33.738045,
    lng: 73.084488
};
const ZOOM = 15;
const NAVIGATOR = navigator.geolocation;
const GEOCODER = new google.maps.Geocoder();
let infowindow = new google.maps.InfoWindow();

const MAP = {
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
  },

  getLatLngByAddress: (address) => {
  	return new Promise((res, rej) => {
        GEOCODER.geocode({address: address}, (latlng) => {
          res(latlng);
        }, rej);
    });
  },

  getAddressByLatLng: (position) => {
    return new Promise((res, rej) => {
      GEOCODER.geocode({location: {lat: position.latitude, lng: position.longitude}}, (address) => {
        res(address);
      }, rej);
    });
  },

  getCurrentLocation: () => {
  	if(NAVIGATOR) {
  		return new Promise((res, rej) => {
  			NAVIGATOR.getCurrentPosition(res, rej);
  		});
  	}

  		alert('Your browser is not support the geolocation service.');
  },

  setGoogleMapLocation: (target_path, position) => {
  	map = new google.maps.Map(target_path, {
  		center: { lat: position.latitude, lng: position.longitude },
      zoom: ZOOM
    });
  },

  addMarkers: (coords) => {
    return new google.maps.Marker({ map: map, position: coords});
  },

  autoCompletePlaces: (selector) => {
        console.log(MAP.defaultBound());
    new google.maps.places.Autocomplete(selector, MAP.defaultBound());
  }
};

function removeMarker() {

}

function markRadius(radius) {

}

function getTrams() {

}

$(() => {
  $('body').on('keyup', '#controls', function() {
      MAP.autoCompletePlaces(document.getElementById('controls'));
  });

  $('body').on('blur', '#controls', function() {
    setTimeout(() => {
      MAP.getLatLngByAddress($('body').find('#controls').val()).then(res => {
        coords = {latitude: res[0].geometry.location.lat(), longitude: res[0].geometry.location.lng()};
        $('input[name=map_location]').val(JSON.stringify(coords));
        MAP.setGoogleMapLocation(document.getElementById('map'), coords);
        marker = MAP.addMarkers({ lat: coords.latitude, lng: coords.longitude });
        MAP.toolTip($('body').find('#controls').val());
      });
    }, 500);
  });
});

window.onload = function() {
    let lat_lng = $('body').find('input[name=map_location]').val();
    if(lat_lng !== null && lat_lng !== '') {
        alert('hi');
        lat_lng = JSON.parse(lat_lng);
        MAP.setGoogleMapLocation(document.getElementById('map'), lat_lng);
        MAP.getAddressByLatLng(lat_lng).then(place => {
            marker = MAP.addMarkers({ lat: lat_lng.latitude, lng: lat_lng.longitude });
            MAP.toolTip(place[0].formatted_address);
        });
    } else {
        MAP.getCurrentLocation().then(latlng => {
            MAP.setGoogleMapLocation(document.getElementById('map'), latlng.coords);
            MAP.getAddressByLatLng(latlng.coords).then(place => {
                marker = MAP.addMarkers({lat: latlng.coords.latitude, lng: latlng.coords.longitude});
                MAP.toolTip(place[0].formatted_address);
            });
        });
    }
}
