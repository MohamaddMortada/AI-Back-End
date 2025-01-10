<?php

namespace App\Http\Controllers;
use App\Models\Result;
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
    public function setResult(Request $request) {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'result' => 'required|string|max:255',
        ]);

        $result = Result::create($validatedData);

        return response()->json([
            'message' => 'Result created successfully',
            'result' => $result,
        ], 201);
    }

    public function updateResult(Request $request, $id) {
        $validatedData = $request->validate([
            'user_id' => 'sometimes|required|exists:users,id',
            'result' => 'sometimes|required|string|max:255',
        ]);

        $result = Result::find($id);

        if (!$result) {
            return response()->json([
                'message' => 'Result not found',
            ], 404);
        }

        $result->update($validatedData);

        return response()->json([
            'message' => 'Result updated successfully',
            'result' => $result,
        ], 200);
    }

    public function deleteResult($id) {
        $result = Result::find($id);

        if (!$result) {
            return response()->json([
                'message' => 'Result not found',
            ], 404);
        }

        $result->delete();

        return response()->json([
            'message' => 'Result deleted successfully',
        ], 200);
    }

    public function getResultsByUserId(Request $request)
{
    $validatedData = $request->validate([
        'user_id' => 'required|exists:users,id', 
    ]);

    $userId = $validatedData['user_id'];

    $results = Result::where('user_id', $userId)->get();

    if ($results->isEmpty()) {
        return response()->json([
            'message' => 'No results found for the given user.',
        ], 404);
    }

    return response()->json([
        'message' => 'Results fetched successfully.',
        'results' => $results,
    ], 200);
}

}
