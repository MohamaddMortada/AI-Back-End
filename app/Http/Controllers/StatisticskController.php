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
    public function getStat($id){
        $stat = Statistics::find($id);
        if(!$stat){
            return response()->json([
                'message' => 'stat not found'
            ],404);
        }
        return response()->json([
            'message' => 'stat found successfully',
            'stat' => $stat
        ],200);
    }

}
