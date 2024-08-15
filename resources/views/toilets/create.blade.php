<x-app-layout>
    <h1 class="text-3xl font-semibold text-center mb-8">新しいトイレの投稿</h1>
    <form action="{{ route('toilets.store') }}" method="POST" enctype="multipart/form-data" class="max-w-4xl mx-auto p-6 bg-white shadow-lg rounded-lg">
        @csrf
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3">
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">タイトル:</label>
                <input type="text" id="title" name="title" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            </div>
            
            <div>
                <label for="photo_url" class="block text-sm font-medium text-gray-700">写真:</label>
                <input type="file" id="photo_url" name="image" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            </div>
            
            <div>
                <label for="opening_hours" class="block text-sm font-medium text-gray-700">営業時間:</label>
                <input type="text" id="opening_hours" name="opening_hours" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            </div>
        </div>

        <div class="flex justify-center mt-6">
            <button type="button" onclick="getLocation()" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-200">現在地を取得</button>
        </div>

        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 mt-8">
            <div>
                <label for="latitude" class="block text-sm font-medium text-gray-700">緯度:</label>
                <input type="text" id="latitude" name="latitude" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            </div>
            
            <div>
                <label for="longitude" class="block text-sm font-medium text-gray-700">経度:</label>
                <input type="text" id="longitude" name="longitude" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            </div>
        </div>

        <div class="flex justify-center mt-8">
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-200">投稿</button>
        </div>
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
</x-app-layout>