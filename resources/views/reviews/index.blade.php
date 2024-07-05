<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>Review</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <h1>口コミ一覧</h1>
        <a href='/reviews/create'>口コミを投稿する</a>
        <div class='reviews'>
            @foreach ($reviews as $review)
            <div class='review'>
                <h2 class='title'>{{ $review->rating}}</h2>
                <p class='body'>{{ $review->comment}}</p>
            </div>
            @endforeach
        </div>
        <div class='paginate'>
            {{ $reviews->links() }}
        </div>
    </body>
</html>