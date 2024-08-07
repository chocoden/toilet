<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MapToiletReviewLike extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'map_toilet_review_id',
        'user_id'
    ];

    public function review()
    {
        return $this->belongsTo(MapToiletReview::class, 'map_toilet_review_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
