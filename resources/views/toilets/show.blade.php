<x-app-layout>
    <div class="max-w-2xl mx-auto p-6 bg-white shadow-md rounded-lg">
        <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $toilet->title }}</h1>
        
        <!-- 道案内ボタン -->
        <div class="mb-6">
            <a href="https://www.google.com/maps/dir/?api=1&destination={{ $toilet->latitude }},{{ $toilet->longitude }}" target="_blank" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10l2 2m0 0l-2 2m2-2H3m17 0a9 9 0 11-9-9 9 9 0 019 9z" />
                </svg>
                道案内
            </a>
        </div>
        
        @if($averageRating !== null)
            <h2 class="text-xl font-semibold text-gray-700 mb-2">平均評価:  <span class="text-yellow-500">{{ number_format($averageRating, 1) }}★</span>/<h2>
         @else
            <p class="text-gray-500 mb-4">レビューがありません</p>
        @endif
        
        <p class="text-gray-600 mb-6">住所:{{ $toilet->address }}</p>
        <p class="text-gray-600 mb-6">営業時間:{{ $toilet->opening_hours }}</p>
        
        @if($toilet->photo_url)
            <p><img src="{{ $toilet->photo_url }}" alt="{{ $toilet->title }}"></p>
        @endif
        
        <a href="/toilets/{{ $toilet->id }}/reviews" class="text-blue-600 hover:underline">このトイレの口コミ一覧を見る</a>
        
        <div class="border-t mt-6 pt-4">
        　<a href="/map" class="text-gray-500 hover:text-gray-700">マップに戻る</a>
    　　</div>
 </x-app-layout>