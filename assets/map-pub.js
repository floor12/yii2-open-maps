const open_map_token = 'pk.eyJ1IjoiZmxvb3IxMiIsImEiOiJja3YzeW84NGcwajh2Mm5sdW5yOW9sYzNjIn0.wKlJ9RYHsP0rvAXZLt3YhA';

var mymap = '';
let satellite;
let streets;
var sat = false;


function drawPoints(points, line = false) {
    if (line)
        path = L.polyline(points, {color: '#342F2F', weight: 5}).addTo(mymap);

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
            }).bindPopup(elem[2]).addTo(mymap);
        }
    });
}

function initMap(id, lat, long, zoom) {
    mymap = L.map(id).setView([lat, long], zoom);
    const mapboxUrl = 'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=' + open_map_token;

    satellite = L.tileLayer(mapboxUrl, {
        id: 'mapbox/satellite-v9',
        tileSize: 512,
        maxZoom: 20,
        zoomOffset: -1
    });

    streets = L.tileLayer(mapboxUrl, {
        id: 'mapbox/streets-v11',
        tileSize: 512,
        maxZoom: 20,
        zoomOffset: -1
    });

    mymap.addLayer(streets);
}

function mapSwitchMode() {
    if (sat === false) {
        mymap.removeLayer(streets);
        mymap.addLayer(satellite);
        sat = true;
    } else {
        mymap.removeLayer(satellite);
        mymap.addLayer(streets);
        sat = false;
    }
}
