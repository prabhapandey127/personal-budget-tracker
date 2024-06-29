<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function login()
    {
    return view('login');
    }

    public function register()
    {
    return view('register');
    }

    public function registerPost(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        return back()->with('success', 'Register successfully');
    }

    public function loginPost(Request $request)
    {
        $credetials = [
        'email' => $request->email,
        'password' => $request->password,
        ];
        if (Auth::attempt($credetials)) {
        return redirect('/home')->with('success', 'Login successfully');
        }
        return back()->with('error', 'Invalid Email or Password');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
    

}
