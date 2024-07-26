<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ToiletController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\PublicToiletController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/map', [MapController::class, 'index'])->name('map.index');

Route::get('/fetch-public-toilets', [PublicToiletController::class, 'fetchAndStorePublicToilets']);
Route::get('/public-toilets/{place_id}', [PublicToiletController::class, 'show']);


Route::controller(ToiletController::class)->middleware(['auth'])->group(function(){
    Route::get('/toilets', 'index');
    Route::get('/toilets/{toilet}', 'show');
   
});

Route::controller(ReviewController::class)->middleware(['auth'])->group(function(){
    Route::get('toilets/{toilet}/reviews', 'index');
    Route::get('toilets/{toilet}/reviews/create', [ReviewController::class, 'create']);
    Route::post('toilets/{toilet}/reviews', [ReviewController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        
});

require __DIR__.'/auth.php';

