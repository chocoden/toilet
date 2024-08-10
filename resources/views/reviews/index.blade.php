<x-app-layout>
    <h1>{{ $toilet->title }}の口コミ一覧</h1>
    <a href="/toilets/{{ $toilet->id }}/reviews/create">口コミを投稿する</a>
    <div class='reviews'>
        @foreach ($reviews as $review)
            <div class='review'>
                <h2 class='rating'>★{{ $review->rating }}</h2>
                <p class='body'>{{ $review->comment }}</p>
                <!-- いいねボタンを各レビューごとに表示 -->
                <button class="like-button" data-review-id="{{ $review->id }}">👍</button>
                <span id="like-count-{{ $review->id }}">{{ $review->likes_count }} Likes</span>
            </div>
        @endforeach
    </div>
    <div class='paginate'>
        {{ $reviews->links() }}
    </div>
    <div class='footer'>
        <a href="/toilets/{{ $toilet->id }}">戻る</a>
    </div>
    <script>
        document.querySelectorAll('.like-button').forEach(button => {
            button.addEventListener('click', function() {
                var reviewId = this.getAttribute('data-review-id');
                
                fetch('{{ route('likes.store') }}', {
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
</x-app-layout>