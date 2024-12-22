<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PredictionController extends Controller
{
    public function getPredictions(){
        $predictions = Prediction::all();
        if(!$predictions){
            return response()->json([
                'message' => 'No predictions found'
            ],404);
        }
        return response()->json([
            'message' => 'Successfully fetched all predictions',
            'predictions' => $predictions
        ],200);
    }

    public function getPrediction($id){
        $prediction = Prediction::find($id);
        if(!$prediction){
            return response()->json([
                'message' => 'prediction not found'
            ],404);
        }
        return response()->json([
            'message' => 'prediction found successfully',
            'prediction' => $prediction
        ],200);
    }

    public function setprediction(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'confidence' => 'required|integer',
            'user_id' => 'required|exists:users,id'
        ]);

        $prediction = prediction::create([
            'name' => $request->input('name'),
            'confidence' => $request->input('confidence'),
            'user_id' => $request->input('user_id'),
        ]);
        if(!$prediction)   
            return response()->json(['message' => 'Error while creating prediction'], 500);
        return response()->json([
            'message' => 'prediction created successfully',
            'prediction' => $prediction
        ],201);
    }
}
