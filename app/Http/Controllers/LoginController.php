<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;


class LoginController extends Controller
{
  public function login(Request $request){
    $request->validate([
        'email'=> ['required','email'], 
        'password'=> ['required']
    ]);

        if(Auth::Attempt($request->only('email', 'password'))){

            return response()->json(Auth::user(), 200);

        }throw ValidationException::withMessages([
            'email' => ['The Provided Credentials are Incorrect.']
        ]);

  }

  public function logout(){

    Auth::logout();
  }
}
