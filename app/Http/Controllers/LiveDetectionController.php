<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LiveDetectionController extends Controller
{
    public function runScript(Request $request)
    {
        $output = shell_exec('/usr/bin/python3 app/PythonScripts/body_detect.py');
        return response()->json(['output' => $output]);
    }
}
