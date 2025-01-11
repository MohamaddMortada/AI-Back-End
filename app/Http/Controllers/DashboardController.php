<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dashboard;


class DashboardController extends Controller
{
    public function getDashboardData() {

        $data = Dashboard::first();
        if(!$data){
            return response()->json([
                'message' => 'No dashboard found'
            ],404);
        }
        return response()->json([
            'message' => 'Successfully fetched all data',
            'predictions' => $data->predictions,
            'chatbot' => $data->chatbot, 
            'calculating' => $data->calculating, 
            'photo_finish' => $data->photo_finish, 
            'detecting' => $data->detecting, 
            'added_results' => $data->added_results,
        ],200);

    }
}
