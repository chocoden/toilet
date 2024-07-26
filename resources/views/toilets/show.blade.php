<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>{{ $toilet->title }}</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <h1>{{ $toilet->title }}</h1>
        <!-- 道案内ボタン -->
        <a href="https://www.google.com/maps/dir/?api=1&destination={{ $toilet->latitude }},{{ $toilet->longitude }}" target="_blank">
            <button>道案内</button>
        </a>
        @if($averageRating !== null)
            <h2>平均評価: {{ number_format($averageRating, 1) }}★</h2>
         @else
            <p>レビューがありません</p>
        @endif
        <p>住所:{{ $toilet->address }}</p>
        <p>営業時間:{{ $toilet->opening_hours }}</p>
        @if($toilet->photo_url)
            <p><img src="{{ $toilet->photo_url }}" alt="{{ $toilet->title }}"></p>
        @endif
        
        
        
        
        <a href="/toilets/{{ $toilet->id }}/reviews">このトイレの口コミ一覧を見る</a>
        
       
        <div class='footer'>
        　<a href="/map">マップに戻る</a>
    　　</div>
    </body>
</html>