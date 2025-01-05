<?php

namespace App\Http\Controllers;

use App\Services\EventService;

class EventDetectorController extends Controller {
    protected $eventService;

    public function __construct(EventService $eventService)
    {
        $this->eventService = $eventService;
    }

    public function showEventId(Request $request) {
        $name = $request->input('name');
        $type = $request->input('type');
        $gender = $request->input('gender');

        if (!$name || !$type || !$gender) {
            return response()->json(['error' => 'Missing required parameters'], 400);
        }

        $eventId = $this->eventService->getEventId($name, $type, $gender);

        if ($eventId !== null) {
            return response()->json(['event_id' => $eventId]);
        } else {
            return response()->json(['error' => 'Event not found'], 404);
        }
    }
}
