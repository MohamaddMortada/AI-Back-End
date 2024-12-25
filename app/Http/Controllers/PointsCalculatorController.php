<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PointsCalculatorController extends Controller
{
    public function getPoints(Request $request) {

        $request->validate([
            'eventId' => 'required|string',
            'performance' => 'required|string',
        ]);

        $eventId = $request->input('eventId');
        $performance = $request->input('performance');

        $response = Http::post('https://athleticsranking.vercel.app/ranking/points', [
            'eventId' => $eventId,
            'performance' => $performance,
        ]);

        if(!$response) {
            return response()->json([
                'message' => 'error fetching data'
            ],404);
        }
        $performancePoints = $response->json()['performancePoints'] ?? null;
        return response()->json([
            'Performance Points' => $performancePoints
        ],201);
    }
}
