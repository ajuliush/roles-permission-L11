<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        return view('panel.dashboard');
    }
    // If need separate dashboard for admin, user and others 
    // public function userDashboard()
    // {
    //     return view('panel.user');
    // }
}
