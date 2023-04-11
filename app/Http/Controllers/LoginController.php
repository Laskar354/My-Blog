<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index', [
            "title" => "Login"
        ]);
    }


    public function authenticate(Request $request)
    {
        $dataLogin = $request->validate([
            'email' => 'email:dns|required',
            'password' => 'required'
        ]);
        //dd($dataLogin);
        if(Auth::attempt($dataLogin)){
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->with('loginErrors', 'Login Failed!');
    }


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
