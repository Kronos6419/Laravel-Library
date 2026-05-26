<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function register(Request $request){
        //die, dump - debug method, Kills the process to Test and sends OK
        // dd('ok');
        
        // $request for more checks
        // dd($request); 

        //Validate
        $fields = $request->validate([
            'username' => ['required', 'max:225'],
            'email' => ['required', 'max:225', 'email', 'unique:users'],
            'password' => ['required', 'min:3', 'confirmed'],
        ]);

        // dd($fields);

        //Register
        $user = User::create($fields);

        //Login
        Auth::login($user);

        //Redirect
        return redirect()->route('home');
    }
}
