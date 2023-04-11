<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register.index', [
            "title" => "Registration"
        ]);
    }


    public function register(Request $request)
    {
        //dd($request);
        $validatedData = $request->validate([
            "name" => "required|max:30",
            "username" => "required|max:255|unique:users",
            "email" => "required|email:dns|unique:users",
            "password" => "required|min:5"
        ]);

        $validatedData["password"] = Hash::make($validatedData["password"]);

        User::create($validatedData);

        return redirect('/login')->with("success", "Registration successfully tod! Login Now");
    }
}
