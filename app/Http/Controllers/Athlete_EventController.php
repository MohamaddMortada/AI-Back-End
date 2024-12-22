<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Athlete_EventController extends Controller
{
    public function getAthlete_Events(){
        $athlete_events = Athlete_Event::all();
        if(!$athlete_events){
            return response()->json([
                'message' => 'No athlete_events found'
            ],404);
        }
        return response()->json([
            'message' => 'Successfully fetched all athlete_events',
            'athlete_events' => $athlete_events
        ],200);
    }
}
