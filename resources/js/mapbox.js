
let MAP;
// let fs = require('fs');
// let path = require('path');
let mapbox = require('mapbox-gl');
const defaultCoords =  {latitude: 40.785091, longitude: -73.968285}; // New York Center point
const defaultBounds = [
    [-74.04728500751165, 40.68392799015035], // Southwest coordinates
    [-73.91058699000139, 40.87764500765852]  // Northeast coordinates
];

// let env = require('dotenv').config({
//     path: `${path.dirname(__dirname)}/${path.basename(__dirname)}/.env`
// });

/**
 *
 * @param coords
 * @returns {LngLat}
 */
const setLatLng = (coords) => {
    return new mapboxgl.LngLat(coords.longitude, coords.latitude);
};

/**
 *
 * @returns {string}
 */
const setToken = () => {
    return mapbox.accessToken = 'pk.eyJ1IjoiZnJhbmsxMTIiLCJhIjoiY2szanJ4YWpvMDR2djNubXVpb3FnOHRuOCJ9.qeV9Ljfdoa-C5XjJI6qcsQ';
};

/**
 *
 * @param text
 * @returns {Popup}
 */
const drawPopUp = (text) => {
    let popup = new Popup({
        closeButton: true,
        closeOnClick: true
    });

    popup.setText(text);

    return popup;
};

/**
 *
 * @param coords
 * @param popup
 * @param text
 * @returns {Marker}
 */
const setMarker = (coords, popup = false, text = null) => {
    let marker = new mapbox.Marker()
        .setLngLat(setLatLng(coords));
    if(popup) marker.setPopup(drawPopUp(text));
    marker.addTo(MAP);

    return marker;
};

/**
 *
 * @param container
 */
function initMapBox(container) {
    MAP = new mapbox.Map({
        container: container,
        maxBounds: defaultBounds,
        scrollZoom: false,
        accessToken: setToken(),
        center: setLatLng(defaultCoords), // New York Center Point
        logoPosition: "top-left",
        attributionControl: true,
        customAttribution: "New York City Map",
        style: 'mapbox://styles/mapbox/light-v10',
        zoom: 12,
    });

    setMarker(defaultCoords);
}