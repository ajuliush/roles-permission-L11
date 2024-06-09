<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class AuthController extends Controller
{
    public function login()
    {
        if (!empty(Auth::check())) {
            return redirect('panel/dashboard');
        }
        return view('auth.login');
    }
    public function authLogin(Request $request)
    {
        $remember = !empty($request->remember) ? true : false;
        if (Auth::Attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
            return redirect('panel/dashboard');
        } else {
            return redirect()->back()->with('error', 'Please enter correct password email address and password.');
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect(url(''));
    }
}
