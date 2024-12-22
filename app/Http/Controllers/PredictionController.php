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
}
