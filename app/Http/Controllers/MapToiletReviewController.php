<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\MapToiletReview;

class MapToiletReviewController extends Controller
{
    
    
    public function index(Request $request)
        {
            $lat = $request->query('lat');
            $lng = $request->query('lng');
            $name = $request->query('name');
            $vicinity = $request->query('vicinity');
    
            // 口コミ情報を取得し、いいね数も取得
            $reviews = MapToiletReview::where('latitude', $lat)
                ->where('longitude', $lng)
                ->withCount('likes')
                ->paginate(10); // ページネーションのために適宜設定
    
            return view('map_toilet_reviews.index', compact('name', 'vicinity', 'lat', 'lng', 'reviews'));
        }
    
    public function create(Request $request)
        {
            $lat = $request->query('lat');
            $lng = $request->query('lng');
            $name = $request->query('name');
            $vicinity = $request->query('vicinity');
        
            return view('map_toilet_reviews.create', compact('lat', 'lng', 'name', 'vicinity'));
        }

    public function store(Request $request)
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
        
            return redirect()->route('map-toilets.reviews.index', [
                'lat' => $request->lat,
                'lng' => $request->lng,
                'name' => $request->name,
                'vicinity' => $request->vicinity
            ])->with('success', 'レビューが投稿されました。');
        }
}
