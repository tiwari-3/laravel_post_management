<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller    
{
    // This method will use to show the dashboard page for the admin
    public function index(){
        return view('admin.dashboard');    
    }

    
}
