<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Toilet extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'address',
        'title',
        'photo_url',
        'function_id',
        'opening_hours',
        'user_id',
        'latitude',
        'longitude',
        ];
    
    public function reviews()
    {
        return $this->hasMany(\App\Models\Review::class);
    }
    
    public function averageRating()
    {
        return $this->reviews()->avg('rating');
    }
}
