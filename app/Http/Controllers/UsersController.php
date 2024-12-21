<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    public function getUsers(){
        $users = Users::all();
        if(!$users){
            return response()->json([
                'message' => 'No users found'
            ],404);
        }
        return response()->json([
            'message' => 'Successfully fetched all users',
            'users' => $users
        ],200);
    }

    public function getUser($id){
        $user = Users::find($id);
        if(!$user){
            return response()->json([
                'message' => 'User not found'
            ],404);
        }
        return response()->json([
            'message' => 'User found successfully',
            'user' => $user
        ],200);
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
            return response()->json(['error while creating user'],404);
        return response()->json([
            'message' => 'User created successfully',
            'user' => $user
        ],200);
    }
}
