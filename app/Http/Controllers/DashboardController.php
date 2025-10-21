<?php

namespace App\Http\Controllers;

use App\Models\Supply;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $supplies = Supply::all();

        return view('dashboard', compact('supplies'));
    }
        public function userDashboard()
    {
        $supplies = Supply::all();

        return view('dashboard', compact('supplies'));
    }
}
