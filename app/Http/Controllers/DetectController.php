<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class DetectController extends Controller {
    
    public function detectImage(Request $request)
    {
        $request->validate([
            'image' => 'required|file|mimes:jpeg,png,jpg|max:2048',
        ]);

        try {
            $file = $request->file('image');

            $response = Http::attach(
                'image', file_get_contents($file), $file->getClientOriginalName()
            )->post('http://10.0.2.2:5000/detect_image');

            if ($response->successful()) {
                return response()->json([
                    'message' => 'Image processed successfully.',
                    'detection_result' => $response->json(),
                ]);
            } else {
                return response()->json([
                    'error' => 'Failed to detect the image.',
                    'status' => $response->status(),
                ], $response->status());
            }
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'An error occurred while processing the image.',
                'details' => $e->getMessage(),
            ], 500);
        }
    }

}
