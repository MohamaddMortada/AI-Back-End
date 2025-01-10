<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function getResults()
    {
        $results = Result::all();
        return response()->json([
            'message' => 'Successfully fetched all results',
            'results' => $results,
        ], 200);
    }
}
