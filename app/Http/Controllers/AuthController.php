<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validated = $request->validate([
            "email" => "required|email|unique:users",
            "password" => ["required", Password::min(8)],
            "gender" => "required|in:male,female,other",
        ]);

        $user = User::create([
            "email" => $validated["email"],
            "password" => Hash::make($validated["password"]),
            "gender" => $validated["gender"],
        ]);

        $token = $user->createToken("auth-token")->plainTextToken;

        return response()->json(
            [
                "user" => $user,
                "token" => $token,
            ],
            201
        );
    }

    public function profile(Request $request)
    {
        return response()->json([
            "email" => $request->user()["email"],
            "gender" => $request->user()->gender,
        ]);
    }
}
