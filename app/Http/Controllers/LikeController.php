<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\Review;

class LikeController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'review_id' => 'required|exists:reviews,id',
        ]);

        $userId = auth()->id();
        $reviewId = $request->input('review_id');

        // すでにユーザーがこのレビューにいいねしているか確認
        $existingLike = Like::where('review_id', $reviewId)
                            ->where('user_id', $userId)
                            ->first();

        if ($existingLike) {
            return response()->json(['message' => 'You have already liked this review.'], 400);
        }

        // いいねを作成
        Like::create([
            'review_id' => $reviewId,
            'user_id' => $userId,
        ]);

        // いいねの数を取得
        $likesCount = Like::where('review_id', $reviewId)->count();

        return response()->json([
            'message' => 'Liked successfully',
            'likes_count' => $likesCount,
        ]);
    }
    
    
    public function destroy(Request $request)
    {
        $reviewId = $request->input('review_id');
        $userId = auth()->id();
        
        $like = Like::where('review_id', $reviewId)
        ->where('user_id', $userId)
        ->first();
        
        if(!like){
            return response()->json(['message' => 'まだいいねしていません'],400);
        }
        
        $like->delete();
        
        return response()->json(['message' => 'いいねが取り消されました']);
    }
}
