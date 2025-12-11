<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {

        $user = new User();
        $inputs = $request->only('email', 'name', 'password');
        $user->name = $inputs['name'];
        $user->email = $inputs['email'];
        $user->password = Hash::make($inputs['password']);
        $user->save();

        // creamos el token
        $token = JWTAuth::fromUser($user);


        return response()->json([
            'message' => 'User registered successfully',
            'user' => $user,
            'token' => $token,
        ], 201);
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'Credenciales Invalidas'], 401);
        }

        return response()->json([
            'message' => 'Logueado con Exito',
            'token' => $token
        ]);
    }


    public function me()
    {
        $user = JWTAuth::parseToken()->authenticate();

        return response()->json([
            'user' => $user
        ]);
    }


    public function logout()
    {
        JWTAuth::invalidate(JWTAuth::getToken());

        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
}
