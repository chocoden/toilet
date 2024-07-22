<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>Toilets</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <h1>トイレ一覧</h1>
        <a href="/">ホームに戻る</a>
        <div class='toilets'>
          @foreach ($toilets as $toilet)
            <div class='toilet'>
                <h2 class='title'><a href="/toilets/{{ $toilet->id }}">{{ $toilet->title }}</a></h2>
                <p class='avarage_rating'>平均評価:{{ number_format($toilet->average_rating, 1) }}★</p>
            </div>
          @endforeach
        </div>
       
        <div class='footer'>
        　<a href="/">戻る</a>
    　　</div>
    </body>
</html>