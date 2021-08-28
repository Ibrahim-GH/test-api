<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BaseController as BaseController;

class AuthenticationController extends BaseController
{
    //this method adds new users
    public function createAccount(Request $request)
    {
        $validator = validator(request()->all(), [
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|unique:users,phone_number',
            'address' => 'required|string|max:100',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed'
        ]);

        if ($validator->fails()) {
            return $this->handleError($validator->errors());
        }

        $input = $request->all();

        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('LaravelSanctumAuth')->plainTextToken;

        return $this->handleResponse($success, 'User successfully registered!');
    }


    //use this method to signin users
    public function signin(Request $request)
    {
        if(Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::user();
            $success['token'] =  $user->createToken('LaravelSanctumAuth')->plainTextToken;
            $success['name'] =  $user->name;

            return $this->handleResponse($success, 'User logged-in!');
        }
        else{
            return $this->handleError   ('Unauthorised.', ['error'=>'Unauthorised']);
        }
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
