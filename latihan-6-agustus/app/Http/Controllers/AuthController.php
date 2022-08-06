<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function login(Request $request){
        // View Login
        return view('auth.login');
    }
    public function submitLogin(Request $request){
        $email = $request->email;
        $password = $request->password;

        // dd(Hash::make('demopass2'));

        if(Auth::attempt(['email' => $email, 'password' => $password])){
            return redirect('/events');
        }

        session()->flash(
            'error',
            'email or password not correct'
        );
        return redirect()->back();
    }
    public function logout(Request $request){

    }
}
