<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
