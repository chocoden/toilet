<x-app-layout>
    @push('styles')
        <link href="{{ asset('css/MapStyle.css') }}" rel="stylesheet">
    @endpush
    
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">トイレのマップ</h1>
        <button id="postToiletButton">トイレを投稿する</button>
        <div id="map"></div>
        <button id="cancelDirections">道案内を取り消す</button>
    </div>
    
        <script>
            /* global google */
            let map;
            let directionsService;
            let directionsRenderer;
            let placesService;
            let markers = [];

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
                                content: `
                                        <h3 class="text-lg font-semibold text-gray-800 mb-2">${toilet.title}</h3>
                                        <p class="text-sm text-gray-600 mb-2">${toilet.address}</p>
                                        <button onclick="window.location.href='/toilets/${toilet.id}'" class="bg-blue-600 text-white px-3 py-2 rounded hover:bg-blue-800 text-sm">
                                            詳細を見る
                                        </button>
                                        `
                            });

                            marker.addListener('click', function() {
                                infoWindow.open(map, marker);
                            });

                            console.log(marker); // コンソールにマーカーの情報を表示
                        }
                    }
                });
                
                // 初期位置の公衆トイレを取得
                loadToilets(map.getBounds());

                // マップの範囲が変更されるたびにトイレを再取得
                map.addListener('bounds_changed', function() {
                    loadToilets(map.getBounds());
                });

                document.getElementById('cancelDirections').addEventListener('click', function() {
                    directionsRenderer.set('directions', null);
                });
                
                document.getElementById('postToiletButton').addEventListener('click', function() {
                window.location.href = "{{ route('toilets.create') }}";
                });
            }

            function loadToilets(bounds) {
                // 既存のマーカーを削除
                markers.forEach(marker => marker.setMap(null));
                markers = [];

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
                                const content = `
                                    <h3>${place.name}</h3>
                                    <p>${place.vicinity}</p>
                                    <button onclick="navigateToForm(${place.geometry.location.lat()}, ${place.geometry.location.lng()}, '${place.name}', '${place.vicinity}')">詳細を見る</button>
                                    <button onclick="calculateAndDisplayRoute(${place.geometry.location.lat()}, ${place.geometry.location.lng()})">道案内</button>
                                `;
                                const infoWindow = new google.maps.InfoWindow({
                                    content: content
                                });
                                infoWindow.open(map, marker);
                            });

                            console.log(marker); // コンソールにマーカーの情報を表示
                        });
                    }
                });


                document.getElementById('cancelDirections').addEventListener('click', function() {
                    directionsRenderer.set('directions', null);
                });
            }
            
            function navigateToForm(lat, lng, name, vicinity) {
                const url = new URL('/map-toilets/show', window.location.origin);
                url.searchParams.append('lat', lat);
                url.searchParams.append('lng', lng);
                url.searchParams.append('name', name);
                url.searchParams.append('vicinity', vicinity);
                window.location.href = url;
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
      
        <script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google-map.apikey') }}&libraries=places&callback=initMap" async defer></script>
 </x-app-layout>