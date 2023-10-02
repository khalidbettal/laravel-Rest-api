<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login( Request $request ){
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if( !auth()->attempt( $validated ) ){
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401 );
        }
        $user = User::where( 'email', $validated['email'] )->first();
        return response()->json([
            'access_token' => $user->createToken( 'api_token' )->plainTextToken,
            'token_type' => 'Bearer',

        ]);
    }

    public function register(RegisterUserRequest $request){
        $validated = $request->validated();
        $user = User::create( $validated );
        return response()->json([
            'data' => $user,
            'access_token' => $user->createToken( 'api_token' )->plainTextToken,
            'token_type' => 'Bearer',
        ], 201 );
    }


}
