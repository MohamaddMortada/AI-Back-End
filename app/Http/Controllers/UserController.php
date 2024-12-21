<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getUsers(){
        $users = Users::all();
        if(!$users){
            return response()->json([
                'could not find any user'
            ]);
        }
        return response()->json([
            'successfuly found all',
            $users
        ]);
    }
}
