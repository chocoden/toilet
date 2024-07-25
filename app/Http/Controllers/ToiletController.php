<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Toilet;

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
    
}
