<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Toilet extends Model
{
    use HasFactory;
    
    public function reviews(){
        return $this->hasMany(\App\Models\Review::class);
    }
}
