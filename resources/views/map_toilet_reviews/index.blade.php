<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>Review</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
</head>
<body>
    <h1>{{ $name }}の口コミ一覧</h1>
    <a href="/map-toilets/reviews/create?lat={{ $lat }}&lng={{ $lng }}&name={{ $name }}&vicinity={{ $vicinity }}">口コミを投稿する</a>
    <div class='reviews'>
        @if($reviews->isEmpty())
            <p>まだ口コミがありません。最初の口コミを投稿しましょう！</p>
        @else
            @foreach ($reviews as $review)
                <div class='review'>
                    <h2 class='rating'>★{{ $review->rating }}</h2>
                    <p class='body'>{{ $review->comment }}</p>
                </div>
            @endforeach
        @endif
    </div>
    <div class='paginate'>
        {{ $reviews->links() }}
    </div>
    <div class='footer'>
        <a href="/map-toilets/show?lat={{ $lat }}&lng={{ $lng }}&name={{ $name }}&vicinity={{ $vicinity }}">戻る</a>
    </div>
</body>
</html>