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

    public function getUser($id){
        $user = Users::find($id);
        if(!$user){
            return response()->json([
                'could not find user'
            ]);
        }
        return response()->json([
            'successfuly found',
            $user
        ]);
    }
    public function setUser(Request $request){
        $user = Users::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'age' => $request->input('age'),
            'gender' => $request->input('gender'),
        ]);
        if(!$user)   
            return response()->json(['error while creating user']);
        return response()->json([
            'successfuly created',
            $user
        ]);
    }
}
