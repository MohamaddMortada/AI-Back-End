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
}
