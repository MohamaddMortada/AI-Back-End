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
        $syncKey = Str::random(5);

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
            $session->update(['start_time' => $request->fire_timestamp]);
            return response()->json([
                'message'=>'success'
            ], 200);
        }
    
        return response()->json(['error' => 'Invalid sync key'], 400);
    }

    public function stop(Request $request) {

    $validated = $request->validate([
        'sync_key' => 'required|string',
        'fire_timestamp' => 'required|date_format:Y-m-d H:i:s.u', 
    ]);

    $electricTime = ElectricTime::where('sync_key', $validated['sync_key'])->first();

    if (!$electricTime) {
        return response()->json(['error' => 'Sync key not found'], 404);
    }

    $electricTime->startTime = Carbon::parse($validated['fire_timestamp']);
    $electricTime->save(); 

    return response()->json(['message' => 'Fire timestamp updated successfully'], 200);
    }

    public function getFireTimestamp(Request $request)
{
    $validated = $request->validate([
        'sync_key' => 'required|string',
    ]);

    $electricTime = ElectricTime::where('sync_key', $validated['sync_key'])->first();

    if (!$electricTime) {
        return response()->json(['error' => 'Sync key not found'], 404);
    }

    $fireTimestamp = $electricTime->start_time;

    if ($fireTimestamp instanceof \Carbon\Carbon) {
        $fireTimestamp = $fireTimestamp->toIso8601String();
    }

    return response()->json(['fire_timestamp' => $fireTimestamp], 200);
}


}