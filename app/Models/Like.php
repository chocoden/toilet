<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Like extends Model
{
    use HasFactory,SoftDeletes;
    
    protected $fillable = [
        'review_id',
        'user_id',
        ];
        
    public function review()
    {
        return $this->belongsTo(Review::class);
    }
    
    public function user()
    {
        $this->belongsTo(User::class);
    }
    
    public function getLikesCountAttribute()
    {
        return $this->likes()->count();
    }
}
