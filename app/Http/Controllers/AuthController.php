<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Hash;

class AuthController extends Controller
{
    public function registration()
    {
        return view('registration');
    }
    public function UserRegistration(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // $role =  Role::where('name', 'User')->first('id');
        // Create a new user
        $user = User::create([
            'name' => trim($validatedData['name']),
            'email' => trim($validatedData['email']),
            'password' => Hash::make($validatedData['password']),
            // 'role_id' =>  $role->id,
            'role_id' =>  2,
        ]);

        return redirect(url('login'))->with('success', 'Registration successfully.');
        // return redirect(url('login'));
    }
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

            return redirect(url('panel/dashboard'))->with('success', 'Login successfully.');

            // If need separate dashboard for admin, user and others 
            // if (Auth::user()->role->name == 'Admin') {
            //     return redirect(url('panel/dashboard'))->with('success', 'Login successfully as Admin.');
            // } elseif (Auth::user()->role->name == 'User') {
            //     return redirect(url('panel/user-dashboard'))->with('success', 'Login successfully as User.');
            // }
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
