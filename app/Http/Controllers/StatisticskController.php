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

    public function setStat(Request $request){
        $request->validate([
            'result' => 'required|string|max:255',
            'competition_id' => 'required|exists:competitions,id',
            'user_id' => 'required|exists:users,id'
        ]);

        $stat = Statistics::create([
            'result' => $request->input('result'),
            'competition_id' => $request->input('competition_id'),
            'user_id' => $request->input('user_id'),
        ]);
        if(!$stat)   
            return response()->json(['message' => 'Error while creating stat'], 500);
        return response()->json([
            'message' => 'stat created successfully',
            'stat' => $stat
        ],201);
    }

    public function updateStat(Request $request, $id)
    {
        $request->validate([
            'result' => 'required|string|max:255',
            'competition_id' => 'required|exists:competitions,id',
            'user_id' => 'required|exists:users,id'
        ]);

        $stat = Statistics::find($id);

        if (!$stat) {
            return response()->json([
                'message' => 'stat not found'
            ], 404);
        }

        $stat->result = $request->input('result');
        $stat->competition_id = $request->input('competition_id');
        $stat->user_id = $request->input('user_id');

        $stat->save();

        return response()->json([
            'message' => 'stat updated successfully',
            'stat' => $stat
        ], 200);  
    }
}
