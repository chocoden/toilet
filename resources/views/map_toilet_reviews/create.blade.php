@extends('layouts.app')

@section('content')
<div class="container">
    <h1>口コミを投稿</h1>
    <form action="{{ route('map_toilet_reviews.store') }}" method="POST">
        @csrf
        <input type="hidden" name="latitude" value="{{ $latitude }}">
        <input type="hidden" name="longitude" value="{{ $longitude }}">
        <div class="form-group">
            <label for="rating">評価</label>
            <select name="rating" id="rating" class="form-control">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
        </div>
        <div class="form-group">
            <label for="comment">コメント</label>
            <textarea name="comment" id="comment" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="photo_url">写真URL</label>
            <input type="text" name="photo_url" id="photo_url" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">投稿する</button>
    </form>
</div>
@endsection