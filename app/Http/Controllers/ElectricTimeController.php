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
}
