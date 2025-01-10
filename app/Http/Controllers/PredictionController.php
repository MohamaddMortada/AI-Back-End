<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prediction;
use Illuminate\Support\Facades\Http;
use OpenAI;

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
            'user_id' => 'required|exists:users,id',
            'list_of_data' => 'sometimes|array',
        ]);

        $prediction = Prediction::create([
            'score' => $validatedData['score'],
            'confidence' => $validatedData['confidence'],
            'user_id' => $validatedData['user_id'],
            'list_of_data' => $validatedData['list_of_data'] ?? [],
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
            'user_id' => 'required|exists:users,id',
            'list_of_data' => 'sometimes|array',
        ]);

        $prediction = Prediction::find($id);

        if (!$prediction) {
            return response()->json([
                'message' => 'prediction not found'
            ], 404);
        }

        $prediction->score = $validatedData['score'] ?? $prediction->score;
        $prediction->confidence = $validatedData['confidence'] ?? $prediction->confidence;
        $prediction->user_id = $validatedData['user_id'] ?? $prediction->user_id;
        $prediction->list_of_data = $validatedData['list_of_data'] ?? $prediction->list_of_data;

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

    public function AIPredict(Request $request) {
    $event = $request->input('event');
    $results = $request->input('results');

    $prompt = "Predict the best performance for the event: $event based on the following results: " . implode(", ", $results) .", the response should be just the value, dont use words or explain just the returned time";

    try {

        $client = OpenAI::client(env('OPENAI_API_KEY'));
        $response = $client->chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'system', 'content' => 'You are a helpful athletic coach who predicts sports performance based on training results.'],
                ['role' => 'user', 'content' => $prompt],
            ],
        ]);

        $prediction = $response->choices[0]->message->content;

        return response()->json(['prediction' => $prediction]);

    } catch (\Exception $e) {
        \Log::error('OpenAI API error: ' . $e->getMessage());
        return response()->json(['prediction' => 'Unable to generate prediction'], 500);
    }
}

}
