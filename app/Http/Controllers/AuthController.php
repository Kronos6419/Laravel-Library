<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    //
    public function register(Request $request){
        //die, dump - debug method, Kills the process to Test and sends OK
        // dd('ok');
        
        // $request for more checks
        // dd($request); 

        //Validate
        $request->validate([
            'username' => ['required', 'max:225'],
            'email' => ['required', 'max:225', 'email'],
            'password' => ['required', 'min:3', 'confirmed'],
        ]);

        dd('ok');
        //Register
        //Login
        //Redirect

    }
}
