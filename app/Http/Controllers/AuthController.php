<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function register_user(Request $request) {
        if ($request->isJson()) {
            
            $validator = Validator::make($request->all(), [
                'username' => 'required|string|max:255|unique:users',
                'email' => 'required|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
            ]);
    
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 400);
            }
    
            $user = new User();
            $user->username = $request->input('username');
            $user->email = $request->input('email');
            $user->password = bcrypt($request->input('password'));
            $user->save();

            $token = $user->createToken('myapptoken')->plainTextToken;
    
            return response()->json([
                'message' => 'User registered successfully',
                'user' => $user,
                'token' => $token
            ], 201);
        } else {
            return response()->json(['error' => 'Invalid JSON'], 400);
        }
    }

    public function login_user(Request $request) {
        if ($request->isJson()) {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required|string',
            ]);
    
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 400);
            }
    
            // Find the user by email
            $user = User::where('email', $request->input('email'))->first();
    
            if (!$user) {
                return response()->json(['error' => 'User not found'], 404);
            }
    
            // Check if the provided password matches the stored password
            if (Hash::check($request->input('password'), $user->password)) {
                // Password is valid, create a new token for the user (if not already created)
                $token = $user->createToken('your-api-token-name')->plainTextToken;
    
                return response()->json([
                    'message' => 'User logged in successfully',
                    'user' => $user,
                    'token' => $token
                ], 200);
            } else {
                // Password is invalid
                return response()->json(['error' => 'Invalid credentials'], 401);
            }
        } else {
            return response()->json(['error' => 'Invalid JSON'], 400);
        }
    }
}
