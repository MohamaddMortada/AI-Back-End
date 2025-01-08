<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\ElectricTime;
use Carbon\Carbon;



class ElectricTimeController extends Controller
{
    public function generateKey(Request $request)
    {
        $syncKey = Str::uuid()->toString();

        $session = ElectricTime::create([
            'sync_key' => $syncKey,
            'user_a_id' => $request->user_id,
        ]);

        return response()->json(['sync_key' => $syncKey], 201);
    }

    public function validateKey(Request $request)
    {
        $session = ElectricTime::where('sync_key', $request->sync_key)->first();

        if ($session && !$session->user_b_id) {
            $session->update(['user_b_id' => $request->user_id]);
            return response()->json(['message' => 'Sync key validated'], 200);
        }

        return response()->json(['error' => 'Invalid or used key'], 400);
    }

    public function start(Request $request)
    {
        $session = ElectricTime::where('sync_key', $request->sync_key)->first();
    
        if ($session) {
            $startTime = now();
            
            $session->update(['start_time' => $startTime]);
    
            $minutes = $startTime->minute;
            $seconds = $startTime->second;
            $microseconds = $startTime->microsecond; 
    
            return response()->json([
                'minutes' => $minutes,
                'seconds' => $seconds,
                'microseconds' => $microseconds,
            ], 200);
        }
    
        return response()->json(['error' => 'Invalid sync key'], 400);
    }

    public function stop(Request $request)
{
    $session = ElectricTime::where('sync_key', $request->sync_key)->first();

    if ($session) {
        $stopTime = now();  
        
        $session->update(['stop_time' => $stopTime]);
        
        $startTime = \Carbon\Carbon::parse($session->start_time); 

        $stopMinutes = $stopTime->minute;
        $stopSeconds = $stopTime->second;
        $stopMicroseconds = $stopTime->microsecond;

        $stopInSeconds = ($stopMinutes * 60) + $stopSeconds + ($stopMicroseconds / 1000000);

        $startMinutes = $startTime->minute;
        $startSeconds = $startTime->second;
        $startMicroseconds = $startTime->microsecond;

        $startInSeconds = ($startMinutes * 60) + $startSeconds + ($startMicroseconds / 1000000);

        $diffInSeconds = $stopInSeconds - $startInSeconds;

        return response()->json([
            'startmin' => $startMinutes,
            'startsec' => $startSeconds,
            'startmicro' => $startMicroseconds,
            'stopmin' => $stopMinutes,
            'stopsec' => $stopSeconds,
            'stopmicro' => $stopMicroseconds,
            'diff' => $diffInSeconds
        ], 200);
    }

    return response()->json(['error' => 'Invalid sync key'], 400);
}


}