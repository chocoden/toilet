<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TemporaryToilet;
use Google_Client;
use Google_Service_Places;
use App\Models\Review;

class PublicToiletController extends Controller
{
    public function show($id)
    {
        $toilet = TemporaryToilet::find($id);

        if (!$toilet) {
            abort(404, 'トイレが見つかりません');
        }

        $averageRating = Review::where('toilet_id', $id)->avg('rating');

        return view('toilets.show', [
            'toilet' => $toilet,
            'averageRating' => $averageRating
        ]);
    }
}
