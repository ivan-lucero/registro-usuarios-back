<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

// Cambiar nombre de controlador a AuthController 
class RegisterController extends Controller
{
    public function register (RegisterUserRequest $request)
    {
        $user = new User();
        if(!($request->validated())){
            return response()->json([
                'res' => false,
                'message' => $request->messages()
            ], 400);
        }

        if(!($request->input("password") === $request->input("confirm_password"))){
            return response()->json([
                'res' => false,
                'errors' => ["confirm_password" => "Las contraseñas no coinciden"]
            ], 400);
        }

        $user->name = $request->input("name");
        $user->email = $request->input("email");
        $user->password = bcrypt($request->input("password"));
        $user->save();
        return response()->json([
            'res' => true,
            'message' => 'Usuario registrado correctamente',
            'data' => $user
        ], 201);
    }

    public function login (LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();
 
        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'message' => ['Las credenciales son incorrectas.'],
            ]);
        }
     
        $token = $user->createToken($request->email)->plainTextToken;

        return response()->json([
            "res" => true,
            "token" => $token
        ]);
    }

    public function logout ()
    {
        Auth::user()->tokens->each(function($token) {
            $token->delete();
        });
        
        return response()->json([
            "res" => true,
            "message" => "Token eliminado correctamente",
        ]);
    }
}
