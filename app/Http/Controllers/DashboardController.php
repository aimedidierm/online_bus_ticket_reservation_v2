<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function admin()
    {
        return view('admin.dashboard');
    }

    public function passenger()
    {
        return view('passenger.dashboard');
    }
}
