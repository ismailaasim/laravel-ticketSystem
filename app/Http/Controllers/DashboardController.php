<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(){
        return view('Backend.dashboard');
    }
    public function showDashboard()
{
    $pageName = 'Dashboard'; // Example dynamic data
    return view('Backend.dashboard', compact('pageName'));
}
}
