<?php

namespace App\Http\Controllers;

use App\Services\EventService;

class EventDetectorController extends Controller {
    protected $eventService;

    public function __construct(EventService $eventService)
    {
        $this->eventService = $eventService;
    }

    public function showEventId($name, $type, $gender)
    {
        $eventId = $this->eventService->getEventId($name, $type, $gender);
        if ($eventId !== null) {
            return response()->json(['event_id' => $eventId]);
        } else {
            return response()->json(['error' => 'Event not found'], 404);
        }
    }
}
