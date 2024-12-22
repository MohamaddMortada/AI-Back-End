<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Athlete_Event extends Model
{
    use HasFactory;
    protected $table = 'athlete_event';
    protected $fillable = ['result','event_id','competition_id','user_id'];
}