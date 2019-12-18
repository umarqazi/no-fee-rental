"use strict";

let MAP, MARKER;
let defaultCoords =  {latitude: 40.785091, longitude: -73.968285}; // New York Center point
const BBOX = [
    -74.2590879797556, 40.477399, -73.7008392055224, 40.917576401307
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
    return new mapboxgl.LngLat(coords.longitude ? coords.longitude : coords[0], coords.latitude ? coords.latitude : coords[1]);
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

/**
 *
 * @param container
 * @returns {MapboxGeocoder}
 */
const autoComplete = (container) => {
    let $body = $('body');
    let geoCode = new MapboxGeocoder({
        container: container,
        countries: "us",
        region: 'US-NY',
        bbox: BBOX,
        accessToken: setToken(),
        mapboxgl: mapboxgl,
    });

    document.getElementById('address').appendChild(geoCode.onAdd(MAP));
    let $input = $body.find('.mapboxgl-ctrl > input');
    $body.find('.mapboxgl-ctrl > svg').remove();
    $input.attr('placeholder', 'Enter Street Address');
    $input.attr('name', 'street_address');

    return geoCode;
};

/**
 *
 * @param coords
 * @returns {*}
 */
const setMarker = (coords) => {
    MARKER = new mapboxgl.Marker()
        .setLngLat(setLatLng(coords))
        .addTo(MAP);

    return MARKER;
};

/**
 *
 * @param container
 * @param coords
 * @param addMarker
 * @param showPop
 * @returns {Map<any, any> | P.Map | Map}
 */
const setMap = (container, coords, addMarker = true, showPop = true, html = null) => {
    MAP = new mapboxgl.Map({
        accessToken: setToken(),
        container: container,
        maxBounds: defaultBounds, // Map View Bound To New York City Only
        style: 'mapbox://styles/mapbox/light-v10',
        center: setLatLng(coords),
        zoom: 13
    });

    mapControls(new mapboxgl.NavigationControl(), 'bottom-right');

    MAP.flyTo({center: setLatLng(coords)});
    (addMarker) ? setMarker(coords) : null;
    (showPop) ? showPopUp(MARKER, html) : null;

    return MAP;
};

/**
 *
 * @param m
 * @param html
 * @returns {*}
 */
const showPopUp = (m, html) => {
    let popup = new mapboxgl.Popup();
    popup.setHTML(html);
    return m.setPopup(popup);
};

/**
 *
 * @param coords
 * @param container
 * @param zoom
 */
const multiMarkers = (coords, container, zoom = 10) => {
    MAP = new mapboxgl.Map({
        accessToken: setToken(),
        container: container,
        maxBounds: defaultBounds,
        style: 'mapbox://styles/mapbox/light-v10',
        center: setLatLng(defaultCoords),
        zoom: zoom
    });

    coords.forEach((coords, i) => {
        coords = JSON.parse(coords);
        MAP.flyTo({center: setLatLng(coords)});

        i = new mapboxgl.Marker({
            style: "cursor:pointer",
        })
            .setLngLat(setLatLng(coords))
            .setPopup( new mapboxgl.Popup().setHTML('') )
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

    MAP.flyTo({center: setLatLng(defaultCoords)});
    mapControls(new mapboxgl.NavigationControl(), 'bottom-right');
    setMarker(defaultCoords);

    return MAP;
};

/**
 *
 * @param coords
 * @returns {Promise<void>}
 */
const schoolZone = async (coords) => {
    coords.range = 1200;
    await ajaxRequest('/nyc-data', 'post', coords, false).then(response => {
        response = JSON.parse(response);
        schoolData(response.schoolData);
        transportation(response.transportationData);
    }).catch(err => {
        console.log(err);
    });
};

/**
 *
 * @param data
 * @returns {Promise<void>}
 */
const transportation = async (data) => {
    if(data !== '' && data !== undefined) {
        data.forEach((res, i) => {
            let html = '<div class="transportation">';
            // setMarker(res.coords);
            res.line_badge.forEach(badge => {
                badge = badge.replace('Express', '');
                html += `<span class="span-box text-${badge.toLowerCase()}"> ${badge} </span> `;
            });

            html += `<span>  ${res.name}</span></div>`;
            $('body').find('#subways').append(html);

        });
    } else {
        $('body').find('#subways').append(`<span>No Transportation Found</span>`);
    }
};

/**
 *
 * @param data
 * @returns {Promise<void>}
 */
const schoolData = async (data) => {
    if(data !== '' && data !== undefined) {
        $('body').find('#insideschool').append(`<a href="${data[2]}" target="_blank">${data[1]}</a>`);
        data.forEach((res, i) => {
            drawPolygon(res, i);
        });
    } else {
        $('body').find('#insideschool').append(`<span>No School Zone Found</span>`);
    }
};

/**
 *
 * @param $coordinates
 * @param id
 */
const drawPolygon = ($coordinates, id) => {
    MAP.addLayer({
        'id': `maine-${id}`,
        'type': 'fill',
        'source': {
            'type': 'geojson',
            'data': {
                'type': 'Feature',
                'geometry': {
                    'type': 'Polygon',
                    'coordinates': $coordinates
                }
            }
        },
        'layout': {},
        'paint': {
            'fill-color': 'red',
            'fill-opacity': 0.5
        }
    });
};

/**
 * jquery api call
 */
$(() => {
    $('body').on('keyup, blur', '.mapboxgl-ctrl-geocoder--input', function() {
        let required = ['poi', 'address'];
        setTimeout(() => {
        var mapboxClient = mapboxSdk({ accessToken: setToken() });
        mapboxClient.geocoding.forwardGeocode({
            limit: 1,
            bbox: BBOX,
            countries: ['us'],
            query: $(this).val(),
        })
        .send()
        .then(function (response) {
            $('.loader').hide();
            response = JSON.parse(response.rawBody);
            if(response && response.features[0].place_type) {
                response.features[0].place_type.forEach(res => {
                   if(required.includes(res)) {
                       let streetAddress = null;
                       let displayAddress = null;
                       response = response.features[0];
                       let neighborhood = response.context[0];
                       let coords = response.geometry.coordinates;
                       let addressArray = response.place_name.split(',');

                       if(res === 'poi') {
                           streetAddress = addressArray[0];
                           displayAddress = addressArray[1];
                       } else {
                           streetAddress = addressArray[0];
                           displayAddress = streetAddress;
                       }

                       if(neighborhood.id.includes('neighborhood')) {
                           $('input[name=neighborhood]').attr('readonly');
                           $('input[name=neighborhood]').val(neighborhood.text);
                       } else {
                           $('input[name=neighborhood]').removeAttr('readonly');
                       }

                       $('input[name=display_address]').val(displayAddress);
                       $('body').find('.mapboxgl-ctrl > input').val(streetAddress);
                       $('body').find('input[name=map_location]').val(JSON.stringify({latitude: coords[1], longitude: coords[0]}));
                       setMap('map', response.center, true, true, streetAddress);

                   } else {
                       let $validator = $(`#${$('body').find('form').attr('id')}`).validate();
                       let errors = { street_address: "Not a valid street address" };
                       $validator.showErrors(errors);
                   }
                });
            }
        }).catch(function (error) {
            console.log('err => ',error);
            $('.loader').hide();
        });
        }, 100);
    });
});