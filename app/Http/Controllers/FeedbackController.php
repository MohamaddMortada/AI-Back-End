<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;

class FeedbackController extends Controller
{
    public function getFeedbacks(){
        $feedbacks = Feedback::all();
        if(!$feedbacks){
            return response()->json([
                'message' => 'No feedbacks found'
            ],404);
        }
        return response()->json([
            'message' => 'Successfully fetched all feedbacks',
            'feedbacks' => $feedbacks
        ],200);
    }

    public function getFeedback($id){
        $feedback = Feedback::find($id);
        if(!$feedback){
            return response()->json([
                'message' => 'feedback not found'
            ],404);
        }
        return response()->json([
            'message' => 'feedback found successfully',
            'feedback' => $feedback
        ],200);
    }

    public function setFeedback(Request $request){
        $request->validate([
            'issue' => 'required|string|max:255',
            'recomendation' => 'required|string|max:255',
            'error' => 'required|integer',
            'user_id' => 'required|exists:users,id'
        ]);

        $feedback = Feedback::create([
            'issue' => $request->input('issue'),
            'recomendation' => $request->input('recomendation'),
            'error' => $request->input('error'),
            'user_id' => $request->input('user_id'),
        ]);
        if(!$feedback)   
            return response()->json(['message' => 'Error while creating feedback'], 500);
        return response()->json([
            'message' => 'feedback created successfully',
            'feedback' => $feedback
        ],201);
    }

    public function updateFeedback(Request $request, $id)
    {
        $request->validate([
            'issue' => 'sometimes|required|string|max:255',
            'recomendation' => 'sometimes|required|string|max:255',
            'error' => 'required|integer',
            'user_id' => 'required|exists:users,id'
        ]);

        $feedback = Feedback::find($id);

        if (!$feedback) {
            return response()->json([
                'message' => 'feedback not found'
            ], 404);
        }

        $feedback->issue = $request->input('issue');
        $feedback->recomendation = $request->input('recomendation');
        $feedback->error = $request->input('error');
        $feedback->user_id = $request->input('user_id');

        $feedback->save();

        return response()->json([
            'message' => 'feedback updated successfully',
            'feedback' => $feedback
        ], 200);  
    }

    public function deleteFeedback($id)
    {
        $feedback = Feedback::find($id);

        if (!$feedback) {
            return response()->json([
                'message' => 'feedback not found'
            ], 404); 
        }

        $feedback->delete();
        
        return response()->json([
            'message' => 'feedback deleted successfully'
        ], 200);  
    }
}
