<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prediction;

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

    public function setPrediction(Request $request){
        $validatedData = $request->validate([
            'score' => 'required|string|max:255',
            'confidence' => 'required|integer',
            'user_id' => 'required|exists:users,id'
        ]);

        $prediction = prediction::create([
            'score' => $validatedData['score'],
            'confidence' => $validatedData['confidence'],
            'user_id' => $validatedData['user_id'],
        ]);
        if(!$prediction)   
            return response()->json(['message' => 'Error while creating prediction'], 500);
        return response()->json([
            'message' => 'prediction created successfully',
            'prediction' => $prediction
        ],201);
    }

    public function updatePrediction(Request $request, $id)
    {
        $request->validate([
            'score' => 'sometimes|required|string|max:255',
            'confidence' => 'sometimes|required|integer',
            'user_id' => 'required|exists:users,id'
        ]);

        $prediction = Prediction::find($id);

        if (!$prediction) {
            return response()->json([
                'message' => 'prediction not found'
            ], 404);
        }

        $prediction->score = $request->input('score');
        $prediction->confidence = $request->input('confidence');
        $prediction->user_id = $request->input('user_id');

        $prediction->save();

        return response()->json([
            'message' => 'prediction updated successfully',
            'prediction' => $prediction
        ], 200);  
    }
    public function deletePrediction($id)
    {
        $prediction = Prediction::find($id);

        if (!$prediction) {
            return response()->json([
                'message' => 'prediction not found'
            ], 404); 
        }

        $prediction->delete();
        
        return response()->json([
            'message' => 'prediction deleted successfully'
        ], 200);  
    }
}
