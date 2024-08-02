<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ToiletController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\MapToiletReviewController;
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
Route::get('/map-toilets/show', [MapController::class, 'show'])->name('map.show');

Route::controller(ToiletController::class)->middleware(['auth'])->group(function(){
    Route::get('/toilets', 'index');
    Route::get('/toilets/{toilet}', 'show');
   
});

Route::controller(ReviewController::class)->middleware(['auth'])->group(function(){
    Route::get('toilets/{toilet}/reviews', 'index');
    Route::get('toilets/{toilet}/reviews/create', [ReviewController::class, 'create']);
    Route::post('toilets/{toilet}/reviews', [ReviewController::class, 'store']);
});


Route::get('/map-toilets/{lat},{lng}/reviews', [MapToiletReviewController::class, 'index'])->name('map-toilets.reviews.index');

Route::controller(MapToiletReviewController::class)->middleware(['auth'])->group(function(){
    Route::get('/map-toilets/reviews/create', 'create')->name('map-toilets.reviews.create');
    Route::post('/map-toilets/reviews/store', 'store')->name('map-toilets.reviews.store');
});

Route::middleware('auth')->group(function () {
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        
});

require __DIR__.'/auth.php';

