var map;
var ajaxRequest;
var plotlist;
var plotlayers = [];
var marker;
var feature;
var currentIco;

function createIcon(icoURL, icoShadow){
    currentIco = L.icon({
    iconUrl: icoURL,
    shadowUrl: icoShadow,

    iconSize:     [50, 35], // size of the icon
    shadowSize:   [41, 41], // size of the shadow
    iconAnchor:   [22, 94], // point of the icon which will correspond to marker's location
    shadowAnchor: [-20, 102],  // the same for the shadow
    popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
});
return currentIco;
}



function initmap(location) {
    map = new L.Map('map', { zoomControl: true });
    var osmUrl = 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
    var osmAttrib = 'Mapa';
    var osm = new L.TileLayer(osmUrl, { maxZoom: 18, attribution: osmAttrib });
    //map.setView(new L.LatLng(51.3, 0.7),9);
    map.setView(location, 10);
    map.addLayer(osm);
}

function addMarker(text, location, icon) {
    marker = L.marker(location, {icon: icon}).addTo(map);
    marker.bindPopup(text).openPopup();
}

function addr_search() {
    var inp = document.getElementById("addr");

    $.getJSON('http://nominatim.openstreetmap.org/search?format=json&limit=5&q=' + inp.value, function (data) {
        var items = [];

        $.each(data, function (key, val) {
            bb = val.boundingbox;
            items.push("<li><a href='#' onclick='chooseAddr(" + bb[0] + ", " + bb[2] + ", " + bb[1] + ", " + bb[3] + ", \"" + val.osm_type + "\");return false;'>" + val.display_name + '</a></li>');
        });

        $('#results').empty();
        if (items.length != 0) {
            $('<p>', { html: "Wyniki wyszukiwania:" }).appendTo('#results');
            $('<ul/>', {
                'class': 'my-new-list',
                html: items.join('')
            }).appendTo('#results');
        } else {
            $('<p>', { html: "<b>Nic nie znaleziono</b>" }).appendTo('#results');
        }
    });
}

function chooseAddr(lat1, lng1, lat2, lng2, osm_type) {
    var loc1 = new L.LatLng(lat1, lng1);
    var loc2 = new L.LatLng(lat2, lng2);
    var bounds = new L.LatLngBounds(loc1, loc2);

    if (feature) {
        map.removeLayer(feature);
    }
    if (osm_type == "node") {
        feature = L.circle(loc1, 25, { color: 'green', fill: false }).addTo(map);
        map.fitBounds(bounds);
        map.setZoom(18);
    } else {
        var loc3 = new L.LatLng(lat1, lng2);
        var loc4 = new L.LatLng(lat2, lng1);

        feature = L.polyline([loc1, loc4, loc2, loc3, loc1], { color: 'blue' }).addTo(map);
        map.fitBounds(bounds);
    }
    $('#results').empty();
}


function zaznacz(k){

var inp = document.getElementById("addr");

    $.getJSON('http://nominatim.openstreetmap.org/search?format=json&limit=1&q=' + inp.value, function (data) {
        var items = [];
		var lat1;
		var lng1;
		var lat2;
		var lng2;
		var osm_type;
        $.each(data, function (key, val) {
            bb = val.boundingbox;
		lat1= bb[0];
		lng1=bb[2];
		lat2 = bb[1];
		lng2=bb[3]
		osm_type = val.osm_type;
            
        });

        
		
		var loc1 = new L.LatLng(lat1, lng1);
    var loc2 = new L.LatLng(lat2, lng2);
    var bounds = new L.LatLngBounds(loc1, loc2);

    if (feature) {
        map.removeLayer(feature);
    }
    
        
        var loc3 = new L.LatLng(lat1, lng2);
        var loc4 = new L.LatLng(lat2, lng1);
		var a = loc1.lat + loc2.lat;
		a = a/2;
		var b = loc3.lng + loc4.lng;
		b = b/2;
		
		var l1 = a;
        var l2=b;
		
		var greenIcon = L.icon({
    iconUrl: k,
    shadowUrl: '',

    iconSize:     [50, 50], // size of the icon
    shadowSize:   [0, 0], // size of the shadow
    iconAnchor:   [22, 94], // point of the icon which will correspond to marker's location
    shadowAnchor: [4, 62],  // the same for the shadow
    popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
});
	if (osm_type == "node") {
        feature = L.circle(loc1, 25, { color: 'green', fill: false }).addTo(map);
        map.fitBounds(bounds);
        map.setZoom(18);
    } else {
        var loc3 = new L.LatLng(lat1, lng2);
        var loc4 = new L.LatLng(lat2, lng1);

        feature = L.polyline([loc1, loc4, loc2, loc3, loc1], { color: 'blue' }).addTo(map);
        map.fitBounds(bounds);
		map.setZoom(9);
    }
		var marker = L.marker([l1, l2],{icon: greenIcon}).addTo(map);
        map.fitBounds(bounds);
		
    });
}