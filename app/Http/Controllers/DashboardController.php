<?php

namespace App\Http\Controllers;

use App\Models\Supply;
use App\Models\SupplyRequest;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $supplies = Supply::all();
        $pendingRequests = SupplyRequest::where('status', 'pending')->with('user')->get();

        return view('dashboard', compact('supplies', 'pendingRequests'));
    }
    public function userDashboard()
    {
        $supplies = Supply::all();
        // Users don't see pending requests or user counts
        $pendingRequests = collect(); // Empty collection

        return view('dashboard', compact('supplies', 'pendingRequests'));
    }
}
