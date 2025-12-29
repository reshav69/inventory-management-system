<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }
    

    public function login(LoginRequest $request){
        $credentials = $request->validated();

        if (!Auth::attempt($credentials)) {
            return back()->withErrors(['email' => 'Invalid email or password']);
        }

        $request->session()->regenerate();

        // redirect by role
        $user = Auth::user();
        
        return redirect()->route('dashboard');
    }
    
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
