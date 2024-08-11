<x-app-layout>
    <div class="max-w-2xl mx-auto p-6 bg-white shadow-md rounded-lg">
        <h1 class="text-2xl font-bold text-gray-800 mb-4">{{ $toilet->title }}の口コミ投稿</h1>
        
        <form action="/toilets/{{ $toilet->id }}/reviews" method="POST">
            @csrf
            
            <div class="mb-6">
                <div class="flex items-center space-x-2">
                    <span class="star text-3xl cursor-pointer" id="1">★</span>
                    <span class="star text-3xl cursor-pointer" id="2">★</span>
                    <span class="star text-3xl cursor-pointer" id="3">★</span>
                    <span class="star text-3xl cursor-pointer" id="4">★</span>
                    <span class="star text-3xl cursor-pointer" id="5">★</span>
                    <input type="hidden" name="review[rating]" id="rating" value="">
    　　　　        </div>
            </div>
    
            <div class="comment mb-6">
                <h2 class="text-xl font-semibold text-gray-700 mb-2">コメント</h2>
                <textarea name="review[comment]" placeholder="感想" rows="4" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
            </div>
            
            <div class="text-right">
                <input type="submit" value="投稿する" class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-colors cursor-pointer"/>
        </form>
        
        <div class="footer mt-6">
            <a href="/toilets/{{ $toilet->id }}/reviews" class="text-gray-500 hover:text-gray-700 transition-colors">戻る</a>
        </div>
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
</x-app-layout>
  