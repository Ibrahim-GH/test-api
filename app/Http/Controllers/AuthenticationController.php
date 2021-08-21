<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthenticationController extends Controller
{
    //this method adds new users
    public function createAccount(Request $request)
    {
        $attr = $request->validate([
            'name' => 'required|string|max:255',
            'phoneNumber' => 'required|string|unique:users,phone_number',
            'address' => 'required|string|max:100',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed'
        ]);

        $user = User::create([
            'name' => $attr['name'],
            'phone_number' => $attr['phoneNumber'],
            'address' => $attr['address'],
            'password' => bcrypt($attr['password']),
            'email' => $attr['email']
        ]);

        $token = $user->createToken('tokens')->plainTextToken;

        return $token;
    }


    //use this method to signin users
    public function signin(Request $request)
    {
        $attr = $request->validate([
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'phoneNumber' => 'string|unique:users,phone_number',
            'address' => 'string|max:100',
        ]);

        if (!Auth::attempt($attr)) {
            return $this->error('Credentials not match', 401);
        }

        $token = auth()->user()->createToken('API Token')->plainTextToken;

        return $token;
    }


    // this method signs out users by removing tokens
    public function signout()
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Tokens Revoked'
        ];
    }
}
