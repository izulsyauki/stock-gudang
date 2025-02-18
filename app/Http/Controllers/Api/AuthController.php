<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request): JsonResponse
    {
        $credentials = $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:8|max:255',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'The provided credentials are incorrect.'
            ], 401);
        }

        $token = $user->createToken($user->name . 'Auth-Token')->plainTextToken;

        return response()->json([
            'message' => 'Login successfully.',
            'token_type' => 'Bearer',
            'token' => $token,
        ], 200);
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:user,email|max:255',
            'password' => 'required|string|min:8|max:255',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if ($user) {
            $token = $user->createToken($user->name . 'Auth-Token')->plainTextToken;

            return response()->json([
                'message' => 'Registration successfully.',
                'token_type' => 'Bearer',
                'token' => $token,
            ], 201);
        } else {
            return response()->json([
                'message' => 'Registration failed.'
            ], 400);
        }
    }

    public function profile(Request $request): JsonResponse
    {
        if ($request->user()) {
            return response()->json([
                'message' => 'Profile fetched.',
                'data' => $request->user(),
            ], 200);
        } else {
            return response()->json([
                'message' => 'Not authenticated.'
            ], 401);
        }
    }

    public function logout(Request $request): JsonResponse
    {
        $user = User::where('id', $request->user()->id)->first();

        if ($user) {
            $user->tokens()->delete();
            return response()->json([
                'message' => 'Logout successfully.'
            ], 200);
        } else {
            return response()->json([
                'message' => 'User not found.'
            ], 404);
        }
    }
}
