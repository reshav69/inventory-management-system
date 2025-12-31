<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }
    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        $credentials['status'] = 1;

        if (! Auth::attempt($credentials)) {
            return back()->withErrors([
                'email' => 'Invalid email or password.',
            ]);
        }

        $request->session()->regenerate();

        return redirect()->route('dashboard');
    }


    public function register(){
        return view("auth.register");
    } 

    public function store(RegisterRequest $request)
    {
        try {
            $validated = $request->validated();
            User::create($validated);

            return redirect()->route('login')->with('success','User registered, wait for the admin to activate your account');
            
        } catch (\Throwable $th) {
            dd($th);
            return back()->withErrors(['db_error'=>'Registration Failed']);
        }
    }
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
