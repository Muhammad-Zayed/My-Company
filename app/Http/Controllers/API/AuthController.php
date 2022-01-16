<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    function login(Request $request)
    {
        $user= User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'status'  => false,
                'message' => ['These credentials do not match our records.']
            ], 404);
        }

        $token = $user->createToken($user->name . 'Token')->plainTextToken;

        $response = [
            'message'=>'Logged in Successfully',
            'status'=>true,
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }
}
