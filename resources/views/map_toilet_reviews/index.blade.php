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
                    <button class="like-button" data-review-id="{{ $review->id }}">👍</button>
                    <span id="like-count-{{ $review->id }}">{{ $review->likes_count }}</span>
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
    <script>
        document.querySelectorAll('.like-button').forEach(button => {
            button.addEventListener('click', function() {
                var reviewId = this.getAttribute('data-review-id');
                
                fetch('{{ route('map-likes.store') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ review_id: reviewId })
                }).then(response => response.json())
                  .then(data => {
                      if (data.message === 'Liked successfully') {
                          alert('Liked!');
                          // いいね数を更新
                          var likeCountElement = document.getElementById('like-count-' + reviewId);
                          likeCountElement.textContent = data.likes_count + ' Likes';
                      } else {
                          alert(data.message);
                      }
                  });
            });
        });
    </script>
</body>
</html>