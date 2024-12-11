<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $validated = $request->validate([
            'identifier' => 'required|string', 
            'password' => 'required|string|min:8',
        ], [
            'password.required' => 'Please enter a password.',
            'password.min' => 'Your password must have at least 8 characters.',
        ]);

        $identifier = $validated['identifier'];
        $password = $validated['password'];

        $user = User::where('email', $identifier)
                    ->orWhere('phone_number', $identifier)
                    ->first();

        if (!$user || !Hash::check($password, $user->password)) {
            return response()->json(['error' => 'Invalid credentials.'], 401);
        }

        $token = $user->createToken('otp-lar1')->plainTextToken;

        return response()->json([
            'message' => 'Login successful.',
            'token' => $token,
        ], 200);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens->each(function ($token) {
            $token->delete();
        });

        return response()->json(['message' => 'Logged out successfully.'], 200);
    }
}
