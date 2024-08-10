<x-app-layout>
    <h1>{{ $name }}</h1>
    <!-- 道案内ボタン -->
    <a href="https://www.google.com/maps/dir/?api=1&destination={{ $lat }},{{ $lng }}" target="_blank">
        <button>道案内</button>
    </a>
    @if($averageRating !== null)
        <h2>平均評価: {{ number_format($averageRating, 1) }}★</h2>
     @else
        <p>レビューがありません</p>
    @endif
    <p>住所: {{ $vicinity }}</p>

    <a href="{{ route('map-toilets.reviews.index', ['lat' => $lat, 'lng' => $lng, 'name' => $name, 'vicinity' => $vicinity]) }}">このトイレの口コミ一覧を見る</a>

    <div class='footer'>
        <a href="/map">マップに戻る</a>
    </div>
</x-app-layout>