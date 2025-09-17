<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request)
    {   
        //validate rules
          $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|in:traveler,host,admin',
        ];

        
        //validate the request data
        $request->validate(rules: $rules);


        //create a new user instance
        $user = \App\Models\User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);

        $token = $user->createToken('token')->plainTextToken;

        //return a successful response
        return response()->json([
            'message' => 'User registered successfully',
            'user' => $user, 
            'token' => $token
        ], 201);
    }


    public function login(Request $request)
    {
        //validate rules
        $rules = [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ];

        //validate the request data
        $request->validate(rules:$rules);


        //check if the user exists
        $user = \App\Models\User::where('email', $request->email)->first();
        
        //if user does not exist, return error
        if (!$user || !\Illuminate\Support\Facades\Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        }
        
        //get the authenticated user
        //$user = \Auth::user();

        //create a new token for the user
        $token = $user->createToken('token')->plainTextToken;

        //return a successful response
        return response()->json([
            'message' => 'User logged in successfully',
            'user' => $user,
            'token' => $token
        ], 200);
    }


    public function logout(Request $request)
    {
        // Revoke the token that was used to authenticate the current request
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'User logged out successfully'
        ], 200);
    }


    public function changePassword(Request $request)
    {
        // Validate the request data
        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user = $request->user();

        // Check if the current password matches
        if (!\Illuminate\Support\Facades\Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'message' => 'Current password is incorrect'
            ], 401);
        }

        // Update the user's password
        $user->password = bcrypt($request->new_password);
        $user->save();

        return response()->json([
            'message' => 'Password changed successfully'
        ], 200);
    }
}
