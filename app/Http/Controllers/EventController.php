<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;


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

    public function getEvent($id){
        $event = Event::find($id);
        if(!$event){
            return response()->json([
                'message' => 'Event not found'
            ],404);
        }
        return response()->json([
            'message' => 'Event found successfully',
            'event' => $event
        ],200);
    }

    public function setEvent(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'wr_holder' => 'required|string|max:255',
        ]);

        $event = Event::create([
            'name' => $request->input('name'),
            'wr_holder' => $request->input('wr_holder'),
        ]);
        if(!$event)   
            return response()->json(['message' => 'Error while creating event'], 500);
        return response()->json([
            'message' => 'event created successfully',
            'event' => $event
        ],201);
    }

    public function updateEvent(Request $request, $id)
    {
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'wr_holder' => 'sometimes|required|string|max:255'
        ]);

        $event = Event::find($id);

        if (!$event) {
            return response()->json([
                'message' => 'event not found'
            ], 404);
        }

        $event->name = $request->input('name');
        $event->wr_holder = $request->input('wr_holder');

        $event->save();

        return response()->json([
            'message' => 'event updated successfully',
            'event' => $event
        ], 200);  
    }

    public function deleteEvent($id)
    {
        $event = Event::find($id);

        if (!$event) {
            return response()->json([
                'message' => 'event not found'
            ], 404); 
        }

        $event->delete();
        
        return response()->json([
            'message' => 'event deleted successfully'
        ], 200);  
    }
    
}
