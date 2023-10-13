<?php

namespace App\Http\Controllers;

use App\Models\Trip;

class DashboardController extends Controller
{
    public function admin()
    {
        return view('admin.dashboard');
    }

    public function passenger()
    {
        $trips = Trip::where('available_places', '>', '0')->get();
        return view('passenger.dashboard', ['trips' => $trips]);
    }
}
