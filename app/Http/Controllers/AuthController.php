<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\User;

class AuthController extends Controller
{
      /**
     * Login user and create token
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = request(['email', 'password']);
        if(!Auth::attempt($credentials))
            return response()->json(['message' => 'Unauthorized'], 401);

        $user = $request->user();
        $token = $user->createToken('Personal Access Token')->plainTextToken;
                
        return response()->json(['access_token' => $token,'token_type' => 'Bearer'],200);
    }

    /**
     * Logout user (Revoke the token)
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function logout(Request $request)    
    {              
        $request->user()->tokens()->delete();        
       
        Auth::logout();

        return response()->json(['message' => 'Successfully logged out'],200);
    }
}
