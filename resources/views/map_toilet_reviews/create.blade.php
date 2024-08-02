<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>{{ $name }}の口コミ投稿</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
</head>
<body>
    <h1>{{ $name }}の口コミ投稿</h1>
    <form action="{{ route('map-toilets.reviews.store') }}" method="POST">
        @csrf
        <input type="hidden" name="lat" value="{{ $lat }}">
        <input type="hidden" name="lng" value="{{ $lng }}">
        <input type="hidden" name="name" value="{{ $name }}">
        <input type="hidden" name="vicinity" value="{{ $vicinity }}">
        <div class="form-group">
            <label for="rating">評価</label>
            <div>
                <span class="star" id="1">★</span>
                <span class="star" id="2">★</span>
                <span class="star" id="3">★</span>
                <span class="star" id="4">★</span>
                <span class="star" id="5">★</span>
                <input type="hidden" name="rating" id="rating" value="">
            </div>
        </div>
        <div class="form-group">
            <label for="comment">コメント</label>
            <textarea name="comment" id="comment" class="form-control" rows="4"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">投稿する</button>
        
    </form>
    <div class="footer">
            <a href="/map-toilets/{lat},{lng}/reviews">戻る</a>
        </div>
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const stars = document.querySelectorAll('.star');
            let clicked = false;
            let rating = document.getElementById('rating');

            stars.forEach((star, i) => {
                star.addEventListener('mouseover', () => {
                    if (!clicked) {
                        for (let j = 0; j <= i; j++) {
                            stars[j].style.color = "#f0da61";
                        }
                    }
                }, false);

                star.addEventListener('mouseout', () => {
                    if (!clicked) {
                        for (let j = 0; j < stars.length; j++) {
                            stars[j].style.color = "#a09a9a";
                        }
                    }
                }, false);

                star.addEventListener('click', () => {
                    clicked = true;
                    rating.value = i + 1;
                    for (let j = 0; j <= i; j++) {
                        stars[j].style.color = "#f0da61";
                    }
                    for (let j = i + 1; j < stars.length; j++) {
                        stars[j].style.color = "#a09a9a";
                    }
                }, false);
            });
            
        });
    </script>
</body>
</html>