<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MapToiletReview extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = [
        'user_id',
        'latitude',
        'longitude',
        'rating',
        'comment',
        'name',
        'vicinity',
        'photo_url'
        ];
        
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
