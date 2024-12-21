<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventController extends Controller
{
    public function getEvents(){
        $events = Event::all();
        if(!$events){
            return response()->json([
                'message' => 'No events found'
            ],404);
        }
        return response()->json([
            'message' => 'Successfully fetched all events',
            'events' => $events
        ],200);
    } 
}
