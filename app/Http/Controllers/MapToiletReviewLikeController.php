<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\MapToiletReviewLike;
use App\Models\MapToiletReview;

class MapToiletReviewLikeController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'review_id' => 'required|exists:map_toilet_reviews,id',
        ]);

        $reviewId = $request->input('review_id');
        $userId = Auth::id();

        // すでに「いいね」が存在するか確認
        $existingLike = MapToiletReviewLike::where('map_toilet_review_id', $reviewId)
                                           ->where('user_id', $userId)
                                           ->first();

        if ($existingLike) {
            return response()->json(['message' => 'すでにいいねしています！'], 400);
        }

        // 新しい「いいね」を作成
        MapToiletReviewLike::create([
            'map_toilet_review_id' => $reviewId,
            'user_id' => $userId,
        ]);

        // 「いいね」数を更新
        $likeCount = MapToiletReviewLike::where('map_toilet_review_id', $reviewId)->count();

        return response()->json([
            'message' => 'いいねしました！',
            'likes_count' => $likeCount
        ]);
    }
}