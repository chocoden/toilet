<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>{{ $name }}</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
</head>
<body>
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

    <h2>口コミ一覧</h2>
    @if($reviews->isEmpty())
        <p>まだ口コミがありません。最初の口コミを投稿しましょう！</p>
    @else
        @foreach($reviews as $review)
            <div class='review'>
                <p>評価: {{ $review->rating }}★</p>
                <p>{{ $review->comment }}</p>
            </div>
        @endforeach
    @endif

    <h2>口コミを投稿する</h2>
    <form action="{{ route('map-toilets.reviews.store') }}" method="POST">
        @csrf
        <input type="hidden" name="lat" value="{{ $lat }}">
        <input type="hidden" name="lng" value="{{ $lng }}">
        <input type="hidden" name="name" value="{{ $name }}">
        <input type="hidden" name="vicinity" value="{{ $vicinity }}">
        <label for="rating">評価:</label>
        <select name="rating" id="rating">
            @for($i = 1; $i <= 5; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
            @endfor
        </select>
        <br>
        <label for="comment">コメント:</label>
        <textarea name="comment" id="comment" rows="4" cols="50"></textarea>
        <br>
        <button type="submit">口コミを投稿する</button>
    </form>

    <div class='footer'>
        <a href="/map">マップに戻る</a>
    </div>
</body>
</html>