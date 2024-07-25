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
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDG3veKcXc5Tty1S-lL1L4i7KCZspaTRNE&callback=initMap" async defer></script>
        <script>
            function initMap() {
                var map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 12,
                    center: {lat: 35.6895, lng: 139.6917} // 東京の緯度経度
                });

                var toilets = @json($toilets);
                
                toilets.forEach(function(toilet) {
                    console.log(toilet); // コンソールにトイレのデータを表示

                    if (toilet.latitude && toilet.longitude) {
                        var lat = parseFloat(toilet.latitude);
                        var lng = parseFloat(toilet.longitude);

                        if (!isNaN(lat) && !isNaN(lng)) {
                            var marker = new google.maps.Marker({
                                position: {lat: lat, lng: lng},
                                map: map,
                                title: toilet.title
                            });

                            var infoWindow = new google.maps.InfoWindow({
                                content: `<h3>${toilet.title}</h3><p>${toilet.address}</p><a href="/toilets/${toilet.id}">詳細を見る</a>`
                            });

                            marker.addListener('click', function() {
                                infoWindow.open(map, marker);
                            });

                            console.log(marker); // コンソールにマーカーの情報を表示
                        }
                    }
                });
            }

            document.addEventListener("DOMContentLoaded", initMap);
        </script>
    </body>
</html>