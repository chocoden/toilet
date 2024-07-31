<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FunctionMapToiletReview extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'function_id',
        'map_toilet_review_id'
        ];
        
    public function mapToiletReview()
    {
        return $this->belogsTo(MapToiletReview::class);
    }
}
