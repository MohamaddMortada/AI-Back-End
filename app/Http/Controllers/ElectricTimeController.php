<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\ElectricTime;


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
}
