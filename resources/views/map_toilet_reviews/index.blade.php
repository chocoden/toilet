<x-app-layout>
    <div class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded-lg">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">{{ $name }}の口コミ一覧</h1>
        
        <div class="mb-6">
            <a href="/map-toilets/reviews/create?lat={{ $lat }}&lng={{ $lng }}&name={{ $name }}&vicinity={{ $vicinity }}" class="inline-block px-6 py-2 bg-green-600 font-semibold rounded-lg hover:bg-green-700 transition-colors">口コミを投稿する</a>
        </div>
        
        <div class='reviews space-y-4'>
            @if($reviews->isEmpty())
                <p class="text-gray-600">まだ口コミがありません。最初の口コミを投稿しましょう！</p>
            @else
                @foreach ($reviews as $review)
                    <div class='review p-4 bg-gray-100 rounded-lg shadow-sm'>
                        <div class='flex items-center justify-between mb-2'>
                            <h2 class='rating text-xl font-semibold text-yellow-500'>★{{ $review->rating }}</h2>
                            <button class="like-button flex items-center text-gray-600 hover:text-blue-600 transition-colors" data-review-id="{{ $review->id }}">
                                <span class="mr-2">👍</span>
                                <span id="like-count-{{ $review->id }}">{{ $review->likes_count }}</span>
                            </button>
                        </div>
                        <p class='body text-gray-700'>{{ $review->comment }}</p>
                    </div>
                @endforeach
            @endif
        </div>
        
        <div class='paginate  mt-6'>
            {{ $reviews->links() }}
        </div>
        
        <div class='footer mt-6'>
            <a href="/map-toilets/show?lat={{ $lat }}&lng={{ $lng }}&name={{ $name }}&vicinity={{ $vicinity }}" class="text-gray-500 hover:text-gray-700 transition-colors">戻る</a>
        </div>
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
</x-app-layout>