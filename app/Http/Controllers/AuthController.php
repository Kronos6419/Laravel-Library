<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Register
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

    //Login
    public function login(Request $request){
        //Validate
        $fields = $request->validate([
            'email' => ['required', 'max:225', 'email'],
            'password' => ['required'],
        ]);

        //Try to log in User
        if(Auth::attempt($fields, $request->remember)){
            return redirect()->intended('dashboard');
        } else{
            return back()->withErrors([
                'failed'=>'wrong password or email'
            ]);
        }
    }

    //Logout Function
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
