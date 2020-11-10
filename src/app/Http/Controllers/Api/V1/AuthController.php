<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * User login authentication.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request) {

        $customMessages = [
            'required' => 'The :attribute field is required.'
        ];

        $request->validate([
            "email" => "bail|required",
            "password" => "required",
        ], $customMessages);

        $user = User::where("email", $request->email)->first();
        if (!$user || ! Hash::check($request->password, $user->password)) {
            return response()->json([
                "error" => "Invalid credentials",
            ], 401);
        }

        $token = $user->createToken("app-token")->plainTextToken;

        return response()->json([
            "token" => $token,
            "status" => "success",
        ]);

    }

    /**
     * User registration.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request) {

        $request->validate([
            "name" => "bail|required",
            "email" => "bail|required|unique:users",
            "password" => "required|min:8",
        ]);

        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
        ]);

        return $user;

    }

    /**
     * User logout.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request) {

        $request->user()->currentAccessToken()->delete();
        //$request->user()->tokens()->delete();

        return response()->json([
            "status" => "success",
            "message" => "Goodbye! hope you will be back soon."
        ]);

    }
}
