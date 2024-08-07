<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'toilet_id',
        'user_id',
        'rating',
        'comment',
    ];
    
      
      public function getPaginateByLimit(int $limit_count = 5)
      {
          return $this->orderBy('updated_at', 'DESC')->paginate($limit_count);
      }
      
      public function toilet()
      {
          return $this->belongsTo(Toilet::class);
      } 
    
      public function user()
      { 
          return $this->belongsTo(User::class);
      }
      
      public function likes()
      {
          return $this->hasMany(Like::class);
      }
}
