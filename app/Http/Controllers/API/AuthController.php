<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $user = User::query()->where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password))
        {
            return \response()->json(['data' => null, 'message' => "These credentials do not match our records"], 403);
        }

        $data = [
            'token_type' => 'Bearer',
            'access_token' => $user->createToken('api_token')->plainTextToken,
        ];

        return \response()->json($data);
    }

    public function register(Request $request)
    {
//        $validator = Validator::make($request->all(), [
//            'name' => ['required', 'string', 'max:255'],
//            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
//            'password' => ['confirmed', Rules\Password::defaults()],
//        ]);

        $user = User::query()->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $data = [
            'token_type' => 'Bearer',
            'access_token' => $user->createToken('api_token')->plainTextToken,
        ];

        return response()->json($data, 200);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        $response = ['message' => 'You have been successfully logged out!'];
        return response()->json($response, 200);
    }

}
