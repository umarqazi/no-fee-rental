

"use strict"

let map;
let latLng = null;
const NAVIGATOR = navigator.geolocation;

function getLatLngByAddress(address) {
	let geocoder = new google.maps.Geocoder();
	geocoder.geocode({'address': address}, (results, status) => {
		if (status == google.maps.GeocoderStatus.OK) {
    		let latLng = {
    			lat: results[0].geometry.location.lat(),
    			lng: results[0].geometry.location.lng()
    		}

    		return latLng;
    	} 
	});
}

function getAddressByLatLng(lat, lng) {

}

function getCurrentLocation() {
	if(NAVIGATOR) {
		return new Promise((res, rej) => {
			NAVIGATOR.getCurrentPosition(res, rej);
		});
	} else {
		alert('Your browser is not support the geolocation service.');
	}
}

function initGoogleMap(target_path, position) {
	map = new google.maps.Map(target_path, {
		center: {
			lat: position.latitude,
			lng: position.longitude
		},
		zoom: 13,
	});
}

function addMarkers(lat, lng) {

}

function removeMarker() {

}

function markRadius(radius) {

}

function getTrams() {

}

function autoCompletePlaces(seletor) {
	new google.maps.places.SearchBox(seletor);
	map.controls[google.maps.ControlPosition.TOP_LEFT].push(seletor);
}

$(() => {
	$('body').on('input', '.controls', function(e) {
		autoCompletePlaces(document.getElementById('controls'));
	});

	$('body').on('change', '.controls', function(e) {
		console.log($(this).val());
		getLatLngByAddress($(this).val());
	});

	// $('body').on('submit', function(e) {
	// 	e.preventDefault();
	// 	console.log($('body').find('.controls').val());
	// 	getLatLngByAddress($('body').find('.controls').val());
	// });
});



      function initAutocomplete() {
//       	            var geocoder = new google.maps.Geocoder();
// var address = "multan";

// geocoder.geocode( { 'address': address}, function(results, status) {

// if (status == google.maps.GeocoderStatus.OK) {
//     var latitude = results[0].geometry.location.latitude;
//     var longitude = results[0].geometry.location.longitude;
//     alert(latitude);
//     } 
// }); 
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -33.8688, lng: 151.2195},
          zoom: 13,
          mapTypeId: 'roadmap'
        });
        // Create the search box and link it to the UI element.
        var input = document.getElementById('pac-input');
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        // Bias the SearchBox results towards current map's viewport.
        map.addListener('bounds_changed', function() {
          searchBox.setBounds(map.getBounds());
        });

        var markers = [];
        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener('places_changed', function() {
          var places = searchBox.getPlaces();

          if (places.length == 0) {
            return;
          }

          // Clear out the old markers.
          markers.forEach(function(marker) {
            marker.setMap(null);
          });
          markers = [];

          // For each place, get the icon, name and location.
          var bounds = new google.maps.LatLngBounds();
          console.log(bounds);
          places.forEach(function(place) {
            if (!place.geometry) {
              console.log("Returned place contains no geometry");
              return;
            }
            var icon = {
              url: place.icon,
              size: new google.maps.Size(71, 71),
              origin: new google.maps.Point(0, 0),
              anchor: new google.maps.Point(17, 34),
              scaledSize: new google.maps.Size(25, 25)
            };

            // Create a marker for each place.
            markers.push(new google.maps.Marker({
              map: map,
              icon: icon,
              title: place.name,
              position: place.geometry.location
            }));

            if (place.geometry.viewport) {
              // Only geocodes have viewport.
              bounds.union(place.geometry.viewport);
            } else {
              bounds.extend(place.geometry.location);
            }
          });
          map.fitBounds(bounds);
        });
      }

window.onload = async function() {
	getCurrentLocation().then(latlng => {
		initGoogleMap(document.getElementById('map'), latlng.coords);
	});
}