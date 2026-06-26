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
        return redirect()->route('dashboard');
    }

    //Login
    public function login(Request $request){
        //Validate - accept either a username or an email in the same field
        $fields = $request->validate([
            'login' => ['required', 'max:225'],
            'password' => ['required'],
        ]);

        //Decide which column to match on
        $type = filter_var($fields['login'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $credentials = [
            $type => $fields['login'],
            'password' => $fields['password'],
        ];

        //Try to log in User
        if(Auth::attempt($credentials, $request->remember)){
            return redirect()->intended('dashboard');
        } else {
            return back()->withErrors([
                'failed' => 'wrong credentials'
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
