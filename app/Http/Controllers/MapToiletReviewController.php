<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\MapToiletReview;

class MapToiletReviewController extends Controller
{
    public function show(Request $request)
    {
        $lat = $request->query('lat');
        $lng = $request->query('lng');
        $name = $request->query('name');
        $vicinity = $request->query('vicinity');

        // 口コミ情報を取得
        $reviews = \App\Models\MapToiletReview::where('latitude', $lat)
            ->where('longitude', $lng)
            ->get();

        // 平均評価を計算
        $averageRating = $reviews->avg('rating');

        return view('map_toilet_reviews.show', compact('name', 'vicinity', 'lat', 'lng', 'reviews', 'averageRating'));
    }

    public function storeReview(Request $request)
        {
            $request->validate([
                'rating' => 'required|integer|between:1,5',
                'comment' => 'nullable|string|max:255',
                'lat' => 'required|numeric',
                'lng' => 'required|numeric',
                'name' => 'required|string',
                'vicinity' => 'required|string'
            ]);
        
            MapToiletReview::create([
                'user_id' => auth()->id(),
                'latitude' => $request->lat,
                'longitude' => $request->lng,
                'name' => $request->name,
                'vicinity' => $request->vicinity,
                'rating' => $request->rating,
                'comment' => $request->comment,
            ]);
        
            return redirect()->route('map-toilets.show', [
                'lat' => $request->lat,
                'lng' => $request->lng,
                'name' => $request->name,
                'vicinity' => $request->vicinity
            ])->with('success', 'レビューが投稿されました。');
        }
}
