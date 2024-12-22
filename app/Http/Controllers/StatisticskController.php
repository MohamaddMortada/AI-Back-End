<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Statistics;

class StatisticskController extends Controller
{
    public function getStatistics(){
        $statistics = Statistics::all();
        if(!$statistics){
            return response()->json([
                'message' => 'No statistics found'
            ],404);
        }
        return response()->json([
            'message' => 'Successfully fetched all statistics',
            'statistics' => $statistics
        ],200);
    }
}
