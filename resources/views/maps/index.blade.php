<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>Google Maps with Toilets</title>
        <style>
            #map {
                height: 100%;
                width: 100%;
            }
            html, body {
                height: 100%;
                margin: 0;
                padding: 0;
            }
        </style>
    </head>
    <body>
        <h1>トイレのマップ</h1>
        <div id="map"></div>
        <button id="cancelDirections">道案内を取り消す</button>
        <script src="{{ config('services.google-map.apikey') }}" async defer></script>
        <script>
            let map;
            let directionsService;
            let directionsRenderer;
            let placesService;

            function initMap() {
                map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 12,
                    center: {lat: 35.6895, lng: 139.6917} // 東京の緯度経度
                });

                directionsService = new google.maps.DirectionsService();
                directionsRenderer = new google.maps.DirectionsRenderer();
                directionsRenderer.setMap(map);
                placesService = new google.maps.places.PlacesService(map);

                const toilets = @json($toilets);

                // ユーザー登録のトイレのピン
                toilets.forEach(function(toilet) {
                    console.log(toilet); // コンソールにトイレのデータを表示

                    if (toilet.latitude && toilet.longitude) {
                        const lat = parseFloat(toilet.latitude);
                        const lng = parseFloat(toilet.longitude);

                        if (!isNaN(lat) && !isNaN(lng)) {
                            const marker = new google.maps.Marker({
                                position: {lat: lat, lng: lng},
                                map: map,
                                title: toilet.title
                            });

                            const infoWindow = new google.maps.InfoWindow({
                                content: `<h3>${toilet.title}</h3><p>${toilet.address}</p><a href="/toilets/${toilet.id}">詳細を見る</a>`
                            });

                            marker.addListener('click', function() {
                                infoWindow.open(map, marker);
                                showDetails(toilet);
                            });

                            console.log(marker); // コンソールにマーカーの情報を表示
                        }
                    }
                });

                // Google Places APIを使用してトイレを取得し、ピンを立てる
                const request = {
                    location: map.getCenter(),
                    radius: '1500',
                    keyword: 'public toilet'
                };

                placesService.nearbySearch(request, function(results, status) {
                    if (status === google.maps.places.PlacesServiceStatus.OK) {
                        results.forEach(function(place) {
                            const marker = new google.maps.Marker({
                                map: map,
                                position: place.geometry.location,
                                title: place.name
                            });

                            google.maps.event.addListener(marker, 'click', function() {
                                placesService.getDetails({ placeId: place.place_id }, function(details, status) {
                                    if (status === google.maps.places.PlacesServiceStatus.OK) {
                                        const content = `
                                        <h3>${details.name}</h3>
                                        <p>${details.formatted_address}</p>
                                        <button onclick="window.location.href='/public-toilets/${details.place_id}'">詳細を見る</button>
                                        <button onclick="calculateAndDisplayRoute(${details.geometry.location.lat()}, ${details.geometry.location.lng()})">道案内</button>
                                    `;
                                        const infoWindow = new google.maps.InfoWindow({
                                            content: content
                                        });
                                        infoWindow.open(map, marker);
                                        
                                    }
                                });
                            });

                            console.log(marker); // コンソールにマーカーの情報を表示
                        });
                    }
                });

                document.getElementById('cancelDirections').addEventListener('click', function() {
                    directionsRenderer.set('directions', null);
                });
            }

            function calculateAndDisplayRoute(lat, lng) {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function(position) {
                        const start = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
                        const end = new google.maps.LatLng(lat, lng);
                        const request = {
                            origin: start,
                            destination: end,
                            travelMode: google.maps.TravelMode.WALKING
                        };
                        directionsService.route(request, function(result, status) {
                            if (status === google.maps.DirectionsStatus.OK) {
                                directionsRenderer.setDirections(result);
                            } else {
                                alert('Directions request failed due to ' + status);
                            }
                        });
                    }, function() {
                        alert('Geolocation failed.');
                    });
                } else {
                    alert('Geolocation is not supported by this browser.');
                }
            }
            
            

           
            document.addEventListener("DOMContentLoaded", initMap);
        </script>
    </body>
</html>