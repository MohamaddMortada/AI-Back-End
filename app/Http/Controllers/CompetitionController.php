<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Competition;

class CompetitionController extends Controller
{
    public function getCompetitions(){
        $competitions = Competition::all();
        if(!$competitions){
            return response()->json([
                'message' => 'No Competitions found'
            ],404);
        }
        return response()->json([
            'message' => 'Successfully fetched all Competitions',
            'competitions' => $competitions
        ],200);
    } 

    public function getCompetition($id){
        $competition = competition::find($id);
        if(!$competition){
            return response()->json([
                'message' => 'competition not found'
            ],404);
        }
        return response()->json([
            'message' => 'competition found successfully',
            'competition' => $competition
        ],200);
    }
}
