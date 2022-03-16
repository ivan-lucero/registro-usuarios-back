<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Models\User;

class RegisterController extends Controller
{
    function register(RegisterUserRequest $request){
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
}
