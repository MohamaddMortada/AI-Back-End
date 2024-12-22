<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

}
