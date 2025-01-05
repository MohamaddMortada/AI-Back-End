<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class EventService {
    public function loadEvents()
    {
        $path = storage_path('app/events.json');
        if (!file_exists($path)) {
            return null; 
        }
        $json = file_get_contents($path);
        return json_decode($json, true);
    }

    public function getEventId($name, $type, $gender)
    {
        $events = $this->loadEvents();
        if ($events === null) {
            return null; 
        }
        foreach ($events as $event) {
            if ($event['Name'] === $name && $event['Type'] === $type && $event['Gender'] === $gender) {
                return $event['Id'];
            }
        }
        return null; 
    }
}
