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

    public function setCompetition(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|string|max:255',
        ]);

        $competition = competition::create([
            'name' => $request->input('name'),
            'date' => $request->input('date'),
        ]);
        if(!$competition)   
            return response()->json(['message' => 'Error while creating competition'], 500);
        return response()->json([
            'message' => 'competition created successfully',
            'competition' => $competition
        ],201);
    }

    public function updateCompetition(Request $request, $id)
    {
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'date' => 'sometimes|required|date'
        ]);

        $competition = Competition::find($id);

        if (!$competition) {
            return response()->json([
                'message' => 'competition not found'
            ], 404);
        }

        $competition->name = $request->input('name');
        $competition->date = $request->input('date');

        $competition->save();

        return response()->json([
            'message' => 'competition updated successfully',
            'competition' => $competition
        ], 200);  
    }
}
