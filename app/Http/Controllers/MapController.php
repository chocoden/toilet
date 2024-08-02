<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Toilet;

class MapController extends Controller
{
    public function index()
    {
        $toilets = Toilet::all();
        return view('maps.index', compact('toilets'));
    }
    
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

        return view('maps.show', compact('name', 'vicinity', 'lat', 'lng', 'reviews', 'averageRating'));
    }
}
