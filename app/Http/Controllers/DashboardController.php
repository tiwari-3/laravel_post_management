<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // This method will use to show the dashboard page for the user
    public function index(){
        return view('dashboard');    
    }
}
