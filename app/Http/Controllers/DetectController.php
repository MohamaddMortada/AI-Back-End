<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class DetectController extends Controller {
    
    public function detectImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');

            $path = $file->store('temp_images', 'public');

            $storedImage = Storage::disk('public')->get($path);

            return response($storedImage, 200)->header('Content-Type', $file->getMimeType());
        }

        return response()->json(['message' => 'Image upload failed!'], 400);
    }
}
