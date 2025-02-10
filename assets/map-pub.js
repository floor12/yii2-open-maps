const open_map_token = 'pk.eyJ1IjoiZmxvb3IxMiIsImEiOiJja3YzeW84NGcwajh2Mm5sdW5yOW9sYzNjIn0.wKlJ9RYHsP0rvAXZLt3YhA';

let maps = {};
let satellite = {};
let streets = {};
let satMode = {};

const mapboxUrl = 'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=' + open_map_token;


function drawPoints(id, points, line = false) {
    if (line)
        path = L.polyline(points, {color: '#342F2F', weight: 5}).addTo(maps[id]);

    let icon = L.icon({
        iconUrl: '/design/map-marker.png',
        iconSize: [50, 45], // size of the icon
        iconAnchor: [18, 35], // point of the icon which will correspond to marker's location
        popupAnchor: [0, -35] // point from which the popup should open relative to the iconAnchor
    });

    points.forEach((elem) => {
        if (elem[2].length > 0) {
            L.marker([elem[0], elem[1]], {
                icon
            }).bindPopup(elem[2]).addTo(maps[id]);
        }
    });
}

function setMapCenter(id, lat, long, zoom) {
    maps[id].setView([lat, long], zoom);
}

function initMap(id, lat, long, zoom) {
    maps[id] = L.map(id).setView([lat, long], zoom);
    satellite[id] = L.tileLayer(mapboxUrl, {
        id: 'mapbox/satellite-v9',
        tileSize: 512,
        maxZoom: 20,
        zoomOffset: -1
    });

    streets[id] = L.tileLayer(mapboxUrl, {
        id: 'mapbox/streets-v11',
        tileSize: 512,
        maxZoom: 20,
        zoomOffset: -1
    });
    satMode[id] = false;
    maps[id].addLayer(streets[id]);
}

function mapSwitchMode(id) {
    if (satMode[id] === false) {
        maps[id].removeLayer(streets[id]);
        maps[id].addLayer(satellite[id]);
        satMode[id] = true;
    } else {
        maps[id].removeLayer(satellite[id]);
        maps[id].addLayer(streets[id]);
        satMode[id] = false;
    }
}
