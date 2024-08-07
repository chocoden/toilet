<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>新しいトイレの投稿</title>
</head>
<body>
    <h1>新しいトイレの投稿</h1>
    <form action="{{ route('toilets.store') }}" method="POST">
        @csrf
        <label for="title">タイトル:</label>
        <input type="text" id="title" name="title" required>
        <br>
        <label for="photo_url">写真のURL:</label>
        <input type="text" id="photo_url" name="photo_url">
        <br>
        <label for="opening_hours">営業時間:</label>
        <input type="text" id="opening_hours" name="opening_hours">
        <br>
        <button type="button" onclick="getLocation()">現在地を取得</button>
        <br>
        <label for="latitude">緯度:</label>
        <input type="text" id="latitude" name="latitude">
        <br>
        <label for="longitude">経度:</label>
        <input type="text" id="longitude" name="longitude">
        <br>
        <button type="submit">投稿</button>
    </form>
    <script>
        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    document.getElementById('latitude').value = position.coords.latitude;
                    document.getElementById('longitude').value = position.coords.longitude;
                    console.log("Latitude:", position.coords.latitude, "Longitude:", position.coords.longitude); // デバッグ用
                });
            } else {
                alert('Geolocation is not supported by this browser.');
            }
        }
    </script>
</body>
</html>