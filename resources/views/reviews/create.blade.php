<!DOCTYPE HTML>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>Review</title>
        
    </head>
    <body>
        <h1>口コミ投稿</h1>
        <form action="/reviews" method="POST">
            @csrf
            
            
    
            <div class="comment">
                <h2>コメント</h2>
                <textarea name="review[comment]" placeholder="感想"></textarea>
            </div>
            <input type="submit" value="store"/>
        </form>
        <div class="footer">
            <a href="/">戻る</a>
        </div>
    </body>
</html>