<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Toilet;
use Cloudinary;

class ToiletController extends Controller
{
    public function index()
    {
        $toilets = Toilet::all();
        foreach ($toilets as $toilet) 
        {
            $toilet->average_rating = $toilet->averageRating();
        }
        
        return view('toilets.index')->with('toilets',$toilets);
    }
    
    public function show(Toilet $toilet)
    {
        $averageRating = $toilet->reviews()->average('rating');
        
        // `toilet` という変数をビューに渡す
        return view('toilets.show', [
            'toilet' => $toilet,
            'averageRating' => $averageRating
        ]);
    }
    
    public function create()
    {
        return view('toilets.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'photo_url' => 'nullable|string|max:255',
            'opening_hours' => 'nullable|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);
        
        $image_url = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();

        Toilet::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'photo_url' => $image_url,
            'opening_hours' => $request->opening_hours,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        return redirect()->route('map.index')->with('success', 'トイレが投稿されました。');
    }
    
}
