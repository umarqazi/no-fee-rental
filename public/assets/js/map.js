"use strict";

let MAP, MARKER;
let defaultCoords =  {latitude: 40.785091, longitude: -73.968285}; // New York Center point
const BBOX = [
    -74.04728500751165, -73.91058699000139, 40.68392799015035, 40.87764500765852
];
const defaultBounds = [
    [-74.04728500751165, 40.68392799015035], // Southwest coordinates
    [-73.91058699000139, 40.87764500765852]  // Northeast coordinates
];

/**
 | ============================================================= |
 |                      Map Box Controls
 | ============================================================= |
 */


/**
 *
 * @param coords
 * @returns {LngLat}
 */
const setLatLng = (coords) => {
    return new mapboxgl.LngLat(coords.longitude, coords.latitude);
};

/**
 * Mapbox controls
 */
const mapControls = (control, position) => {
    MAP.addControl(control, position);
};

/**
 *
 * @returns {string}
 */
const setToken = () => {
    return mapboxgl.accessToken = "pk.eyJ1IjoiZnJhbmsxMTIiLCJhIjoiY2szanJ4YWpvMDR2djNubXVpb3FnOHRuOCJ9.qeV9Ljfdoa-C5XjJI6qcsQ";
};

const mapBoxMarker = (coords) => {
    let popup = new mapboxgl.Popup({
        closeButton: true,
        closeOnClick: true,
    });

    popup.setText('yousuf khalid');

    let marker = new mapboxgl.Marker()
        .setPopup(popup)
        .setLngLat(latLngMapBox(coords))
        .addTo(map);

    return marker;
};

const geocoder = (container) => {
    let gcoder = new MapboxGeocoder({
        container: container,
        accessToken: setToken(),
        maxBounds: defaultBounds,
        mapboxgl: mapboxgl
    });

    return gcoder;
};

const showPopUp = (m, html) => {
    m.getPopup().setHTML(html);
    return;
    let popup = new mapboxgl.Popup();
    popup.setHTML(html);
    return m.setPopup(popup);
};

const multiMarkers = (coords, container) => {
    MAP = new mapboxgl.Map({
        accessToken: setToken(),
        maxBounds: defaultBounds,
        container: container,
        style: 'mapbox://styles/mapbox/light-v10',
        center: setLatLng(defaultCoords),
        zoom: 10
    });

    coords.forEach((coords, i) => {
        coords = JSON.parse(coords);
        MAP.flyTo({center: setLatLng(coords)});

        i = new mapboxgl.Marker({
            style: "cursor:pointer",
        })
            .setLngLat(setLatLng(coords))
            .setPopup( new mapboxgl.Popup().setHTML('I AM COOL') )
            .addTo(MAP);

        i.getElement().addEventListener('click', async function(event) {
            MARKER = i;
            let html = '';
            let current = MARKER.getLngLat();
            let domain = window.location.origin;
            let map_location = JSON.stringify({'latitude': current.lat, 'longitude': current.lng});
            let resp = await ajaxRequest(`/listing-detail`, 'post', {map_location: map_location});

            if(resp.data.length > 1) {
                resp.data.forEach((res, b) => {
                    html += `<a href="${domain}/listing-detail/${res.id}"><div class="location-thumbnaail location-image-btm"><img style="height: 170px; width: 300px;" src="${domain}/${res.thumbnail}"><div class="price-wrapp price-wrap-location">
<p class="price" style="color:#223971">`+ '$'+res.rent.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,') +`</p><div class="additional-info">
 <ul><li><p>${res.bedrooms}</p>Beds</li><li><p>${res.baths}</p>Baths</li></ul>
 </div></div></div> <p>${res.street_address} </p></a>`;
                 });
                setTimeout(() => {
                    $('body').find('.mapboxgl-popup-content').addClass('single');
                    $('.single').css({'overflow-y': 'auto'});
                },10);
            } else {
                html += `<a href="${domain}/listing-detail/${resp.data[0].id}"><div class="location-thumbnaail location-image-btm"><img style="height: 170px; width: 300px;" src="${domain}/${resp.data[0].thumbnail}"><div class="price-wrapp price-wrap-location">
 <p class="price" style="color:#223971">` + '$' + resp.data[0].rent.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,') + `</p><div class="additional-info">
<ul><li><p>${resp.data[0].bedrooms}</p>Beds</li><li><p>${resp.data[0].baths}</p>Baths</li></ul>
</div></div></div> <p>${resp.data[0].street_address} </p></a>`;
             }

            i.getPopup().setHTML(html);
        });
    });

    mapControls(new mapboxgl.NavigationControl(), 'bottom-right');
};

/**
 *
 * @param container
 */
const initMap = (container) => {
    MAP = new mapboxgl.Map({
        container: container,
        style: "mapbox://styles/mapbox/light-v10",
        center: setLatLng(defaultCoords), // New York Center Point
        maxBounds: defaultBounds, // Map View Bound To New York City Only
        scrollZoom: false,
        accessToken: setToken(),
        logoPosition: "top-left",
        attributionControl: true,
        customAttribution: "New York City Map",
        zoom: 12,
    });



    // document.getElementById('address').appendChild(geocoder.onAdd(map));
    // $('body').find('.mapboxgl-ctrl > svg').remove();
    // $('body').find('.mapboxgl-ctrl > input').attr('placeholder', 'Enter Street Address');
    // geocoder.addTo('#controls');
    // map.addControl(geocoder);
    mapControls(new mapboxgl.NavigationControl(), 'bottom-right');
    mapBoxMarker(defaultCoords);

    return MAP;
};

$(() => {
    $('body').on('input', '#controls', function() {
        console.log($(this).val(), defaultBounds[0]);
        var mapboxClient = mapboxSdk({ accessToken: setMapBoxToken() });
        mapboxClient.geocoding.forwardGeocode({
            query: $(this).val(),
            autocomplete: true,
            bbox: BBOX,
            limit: 1
        })
        .send()
        .then(function (response) {
            console.log(response);
            if (response && response.body && response.body.features && response.body.features.length) {
                var feature = response.body.features[0];

                var map = new mapboxgl.Map({
                    container: 'map',
                    style: 'mapbox://styles/mapbox/streets-v11',
                    center: feature.center,
                    zoom: 10
                });
                new mapboxgl.Marker()
                    .setLngLat(feature.center)
                    .addTo(map);
            }
        });
    });
});