<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function resortStaffs()
    {
        return view('dashboard');
    }
}
