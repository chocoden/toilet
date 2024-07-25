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
}
