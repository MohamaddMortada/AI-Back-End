<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class ElectricTime extends Model
{
    use HasFactory;
    protected $table = 'electric_time';
    protected $fillable = ['sync_key', 'start_time', 'stop_time', 'user_a_id', 'user_b_id'];
}
