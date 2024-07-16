<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaflet Map</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <style>
        #map {
            height: 500px;
            width: 100%;
        }
    </style>
</head>
<body>
<div id="map"></div>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
    var map = L.map('map').setView([{{ $cityData->latitude }}, {{ $cityData->longitude }}], 16);

    var southWest = L.latLng({{ $cityData->latitude_south_west }}, {{ $cityData->longitude_south_west }});
    var northEast = L.latLng({{ $cityData->latitude_north_east }}, {{ $cityData->longitude_north_east }});
    var bounds = L.latLngBounds(southWest, northEast);

    map.setMaxBounds(bounds);
    map.on('drag', function() {
        map.panInsideBounds(bounds, { animate: false });
    });

    var jawgSunny = L.tileLayer('https://{s}.tile.jawg.io/jawg-sunny/{z}/{x}/{y}{r}.png?access-token=gSy4xioyZfP4TisrJnuu5J8deA9cNz3mFVw88Y1jnQJpXT2ztwjfYiGYEyztnWo5', {
        attribution: '<a href="http://jawg.io" target="_blank">© Jawg</a> <a href="https://www.openstreetmap.org/copyright" target="_blank">© OpenStreetMap contributors</a>',
        maxZoom: 18,
        minZoom: 14
    }).addTo(map);

    var stadiaSatellite = L.tileLayer('https://tiles.stadiamaps.com/tiles/alidade_satellite/{z}/{x}/{y}{r}.png?access-token=YOUR_ACCESS_TOKEN', {
        attribution: '&copy; <a href="https://stadiamaps.com/">Stadia Maps</a>, &copy; <a href="https://openmaptiles.org/">OpenMapTiles</a> &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
        maxZoom: 18,
        minZoom: 14
    });

    var baseMaps = {
        "Klasicke": jawgSunny,
        "Satelit": stadiaSatellite
    };

    L.control.layers(baseMaps).addTo(map);

    var companies = @json($companies);

    companies.forEach(function(company) {
        var fullAddress = `${company.address}, ${company.city}`;
        geocodeAddress(fullAddress, function(latLng) {
            if (latLng) {
                var marker = L.marker([latLng.lat, latLng.lng]).addTo(map);
                marker.bindPopup(`<b>${company.name}</b><br>${fullAddress}`).openPopup();
            } else {
                console.error('Geocoding failed for address:', fullAddress);
            }
        });
    });

    function geocodeAddress(address, callback) {
        var url = `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(address)}`;
        fetch(url)
            .then(response => response.json())
            .then(data => {
                if (data && data.length > 0) {
                    var latLng = {
                        lat: data[0].lat,
                        lng: data[0].lon
                    };
                    callback(latLng);
                } else {
                    console.error('No results found for address:', address);
                    callback(null);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                callback(null);
            });
    }

    var parkingData = @json($parkingData);

    parkingData.forEach(function(lot) {
        var coordinates = JSON.parse(lot.coordinates);

        var polygon = L.polygon(coordinates, { color: lot.polygon_color })
            .addTo(map)
            .bindPopup(`<b>Parking Lot</b><br>${lot.description}<br>Capacity: ${lot.total_capacity}<br>${lot.address}`);
    });
</script>
</body>
</html>
