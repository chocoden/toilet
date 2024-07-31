 

               function placeMarker(location, map) {
            var marker = new google.maps.Marker({
                position: location,
                map: map
            });
            var infoWindow = new google.maps.InfoWindow({
                content: '<button onclick="navigateToForm(' + location.lat() + ', ' + location.lng() + ')">詳細</button>'
            });
            marker.addListener('click', function() {
                infoWindow.open(map, marker);
            });
        }
        function navigateToForm(lat, lng) {
            window.location.href = '/input-form?lat=' + lat + '&lng=' + lng;
        }
    
                
