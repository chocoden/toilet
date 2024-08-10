<x-app-layout>
    <h1 class="text-3xl font-medium">新しいトイレの投稿</h1>
    <form action="{{ route('toilets.store') }}" method="POST">
        <div class="mt-10 flex flex-wrap justify-center gap-x-6 gap-y-8">
            <div class="sm:col-span-3">
            @csrf
                <label for="title" class="block text-sm font-medium leading-6 text-gray-900">タイトル:</label>
                    <div class="mt-2">
                        <input type="text" id="title" name="title" required class="block w-50 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
            </div>
            
            <div class="sm:col-span-3">
                <label for="photo_url" class="block text-sm font-medium leading-6 text-gray-900">写真のURL:</label>
                <div class="mt-2">
                    <input type="text" id="photo_url" name="photo_url" class="block w-100 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>
            
            <div class="sm:col-span-4">
                <label for="opening_hours" class="block text-sm font-medium leading-6 text-gray-900">営業時間:</label>
                <div class="mt-2">
                    <input type="text" id="opening_hours" name="opening_hours" class="block w-50 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>
        </div>
        <br>
        <div class="flex justify-center mt-6">
            <button type="button" onclick="getLocation()" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">現在地を取得</button>
        </div>
        <br>
        <div class="mt-10 flex justify-center space-x-8">
            <div>
                <label for="latitude"  class="block text-sm font-medium leading-6 text-gray-900">緯度:</label>
                <div class="mt-2">
                    <input type="text" id="latitude" name="latitude" class="block w-50 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>
            
            <div>
                <label for="longitude" class="block text-sm font-medium leading-6 text-gray-900">経度:</label>
                <div class="mt-2">
                    <input type="text" id="longitude" name="longitude" class="block w-50 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>
        </div>
        
        <div class="flex justify-center mt-6">
            <button type="submit" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">投稿</button>
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