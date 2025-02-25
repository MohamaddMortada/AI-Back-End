<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Athlete_Event;

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

    public function getAthlete_Event($id){
        $athlete_event = Athlete_Event::find($id);
        if(!$athlete_event){
            return response()->json([
                'message' => 'athlete_event not found'
            ],404);
        }
        return response()->json([
            'message' => 'athlete_event found successfully',
            'athlete_event' => $athlete_event
        ],200);
    }

    public function setAthlete_Event(Request $request){
        $request->validate([
            'result' => 'required|string|max:255',
            'event_id' => 'required|exists:events,id',
            'competition_id' => 'required|exists:competitions,id',
            'user_id' => 'required|exists:users,id'
        ]);

        $athlete_event = Athlete_Event::create([
            'result' => $request->input('result'),
            'event_id' => $request->input('event_id'),
            'competition_id' => $request->input('competition_id'),
            'user_id' => $request->input('user_id'),
        ]);
        if(!$athlete_event)   
            return response()->json(['message' => 'Error while creating athlete_event'], 500);
        return response()->json([
            'message' => 'athlete_event created successfully',
            'athlete_event' => $athlete_event
        ],201);
    }

    public function updateAthlete_Event(Request $request, $id)
    {
        $request->validate([
            'result' => 'required|string|max:255',
            'event_id' => 'required|exists:events,id',
            'competition_id' => 'required|exists:competitions,id',
            'user_id' => 'required|exists:users,id'
        ]);

        $athlete_event = Athlete_Event::find($id);

        if (!$athlete_event) {
            return response()->json([
                'message' => 'athlete_event not found'
            ], 404);
        }

        $athlete_event->result = $request->input('result');
        $athlete_event->event_id = $request->input('event_id');
        $athlete_event->competition_id = $request->input('competition_id');
        $athlete_event->user_id = $request->input('user_id');

        $athlete_event->save();

        return response()->json([
            'message' => 'athlete_event updated successfully',
            'athlete_event' => $athlete_event
        ], 200);  
    }

    public function deleteAthlete_Event($id)
    {
        $athlete_event = Athlete_Event::find($id);

        if (!$athlete_event) {
            return response()->json([
                'message' => 'athlete_event not found'
            ], 404); 
        }

        $athlete_event->delete();
        
        return response()->json([
            'message' => 'athlete_event deleted successfully'
        ], 200);  
    }
}
