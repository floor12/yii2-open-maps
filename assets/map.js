const open_map_token = 'pk.eyJ1IjoiZmxvb3IxMiIsImEiOiJja3YzeW84NGcwajh2Mm5sdW5yOW9sYzNjIn0.wKlJ9RYHsP0rvAXZLt3YhA';

var mymap = '';

function onMapMove(event) {
    $('#map-init_zoom').val(mymap.getZoom());
    $('#map-init_lat').val(mymap.getCenter().lat);
    $('#map-init_lng').val(mymap.getCenter().lng);
}

function addNewPoint(lat, lng) {
    console.log(lng)
    const cnt = $('#map-point-list li').length
    let field_lat = '<input value="' + lat + '" class="form-control" name="Map[points][' + cnt + '][lat]">';
    let field_lng = '<input value="' + lng + '"  class="form-control" name="Map[points][' + cnt + '][lng]">';
    let field_txt = '<input value=""  class="form-control" name="Map[points][' + cnt + '][title]">';
    let btn_delete = '<button type="button" onclick="removePoint(event)" class="btn btn-xs">X</button>';
    let html = '<div class="row"><div class="col-md-3">' + field_lat + '</div><div class="col-md-3">' + field_lng + '</div><div class="col-md-5">' + field_txt + '</div><div class="col-md-1">' + btn_delete + '</div></div>';
    $('#map-point-list').append($('<li>').append(html));
    drawCurrentPoints();
}

let path = null;

function drawCurrentPoints() {
    if (path !== null) {
        path.removeFrom(mymap);
    }
    let points = [];

    let icon = L.icon({
        iconUrl: '/design/map-marker.png',
        iconSize: [50, 45], // size of the icon
        iconAnchor: [18, 35], // point of the icon which will correspond to marker's location
        popupAnchor: [0, -35] // point from which the popup should open relative to the iconAnchor
    });

    $('#map-point-list li').each((key, elem) => {
        let lat = $($(elem).find('input')[0]).val();
        let lng = $($(elem).find('input')[1]).val();
        let title = $($(elem).find('input')[2]).val();
        points.push([lat, lng]);

        if (title.length > 0) {
            L.marker([lat, lng], {
                icon
            }).bindPopup(title).addTo(mymap);
        }
    })
    path = L.polyline(points, {color: '#B49A67', weight: 5}).addTo(mymap);
}

function drawPoints(points) {
    path = L.polyline(points, {color: 'blue', weight: 10}).addTo(mymap);
}

function removePoint(event) {
    $(event.target).parents('li').remove();
    drawCurrentPoints();
}

function onMapClick(event) {
    addNewPoint(event.latlng.lat, event.latlng.lng)
}


function initMap(lat, lng, zoom) {
    setTimeout(() => {
        mymap = L.map('map').setView([lat, lng], zoom);

        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=' + open_map_token, {
            maxZoom: 20,
            id: 'mapbox/streets-v11', // id: 'mapbox/dark-v10',
            tileSize: 512,
            zoomOffset: -1
        }).addTo(mymap);

        mymap.on('move', onMapMove);
        mymap.on('zoom', onMapMove);
        mymap.on('click', onMapClick);
        drawCurrentPoints();
    }, 300);
}

$(document).on('keyup', '.map-point-name', () => {
    drawCurrentPoints();
});