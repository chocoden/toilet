<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Toilet;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function index(Toilet $toilet)
    {
        $reviews = $toilet->reviews()->paginate(10);
        return view('reviews.index')->with(['toilet' => $toilet, 'reviews' => $reviews]);
    }
    
    public function create(Toilet $toilet)
    {
        return view('reviews.create')->with(['toilet' => $toilet]);
    }
    
    public function store(Request $request,  Toilet $toilet, Review $review)
    {
        $input = $request->input('review');
        $input['toilet_id'] = $toilet->id;
        $input['user_id'] = Auth::id();
        $request->validate([
            'review.rating' => 'required|integer|min:1|max:5',
            'review.comment' => 'required|string',
        ]);
        $review->fill($input)->save();
        return redirect('/toilets/' . $toilet->id . '/reviews');
    }

}
