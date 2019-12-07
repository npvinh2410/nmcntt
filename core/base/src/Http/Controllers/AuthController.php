<?php

namespace Hydrogen\Base\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function loginForm()
    {
        if(Auth::check())
        {
            return redirect()->route('dashboard');
        }

        return view('dashboard::login');
    }

    public function authenticate(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'status' => 1]))
        {
            return redirect()->route('dashboard');
        }
        Session::flash('msg', 'Incorrect username or password. Please try again.');
        return redirect()->route('login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}