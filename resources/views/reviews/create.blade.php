<!DOCTYPE HTML>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>Review</title>
        
    </head>
    <body>
        <h1>{{ $toilet->title }}の口コミ投稿</h1>
        <form action="/toilets/{{ $toilet->id }}/reviews" method="POST">
            @csrf
            
            <div>
                <span class="star" id="1">★</span>
                <span class="star" id="2">★</span>
                <span class="star" id="3">★</span>
                <span class="star" id="4">★</span>
                <span class="star" id="5">★</span>
                <input type="hidden" name="review[rating]" id="rating" value="">
    　　　　</div>
            
    
            <div class="comment">
                <h2>コメント</h2>
                <textarea name="review[comment]" placeholder="感想"></textarea>
            </div>
            
            <input type="submit" value="投稿する"/>
        </form>
        <div class="footer">
            <a href="/">戻る</a>
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