<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoginAdmin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginAdminController extends Controller
{
    public function login(Request $request)
    {
        // Validate the request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Check if the user exists
        $user = LoginAdmin::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            // Authentication passed, generate token or session
            return response()->json([
                'message' => 'Login successful',
                // 'token' => $user->createToken('authToken')->accessToken, // Use this if you're using Laravel Passport or Sanctum for token-based auth
            ]);
        } else {
            return response()->json([
                'message' => 'Invalid credentials',
            ], 401);
        }
    }

    public function update(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|confirmed',
        ]);

        // Find the user
        $user = LoginAdmin::find($id);

        if ($user) {
            // Update user details
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            return response()->json([
                'message' => 'User updated successfully',
            ]);
        } else {
            return response()->json([
                'message' => 'User not found',
            ], 404);
        }
    }
}

