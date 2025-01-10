<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function getResults() {
        $results = Result::all();
        return response()->json([
            'message' => 'Successfully fetched all results',
            'results' => $results,
        ], 200);
    }
    public function getResult($id) {
        $result = Result::find($id);

        if (!$result) {
            return response()->json([
                'message' => 'Result not found',
            ], 404);
        }

        return response()->json([
            'message' => 'Result fetched successfully',
            'result' => $result,
        ], 200);
    }
}
