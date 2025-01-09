<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prediction extends Model
{
    use HasFactory;
    protected $table = 'predictions';
    protected $fillable = ['score','confidence','list_of_data','user_id'];
    protected $casts = [
        'list_of_strings' => 'array', 
    ];
}
