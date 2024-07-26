<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemporaryToilet extends Model
{
    use HasFactory;
    
    protected $fillable = ['place_id', 'name', 'address', 'photo_url'];
}
