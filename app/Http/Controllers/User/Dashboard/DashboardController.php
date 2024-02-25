<?php

namespace App\Http\Controllers\User\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function userDashboard()
    {
        return view('User.Dashboard.dashboard');
    }
}
