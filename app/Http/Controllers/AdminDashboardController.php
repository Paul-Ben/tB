<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User;
use Spatie\Permission\Models\Role;

class AdminDashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index(): View
    {
        $totalUsers = User::count();
        $totalRoles = Role::count();
        $recentUsers = User::latest()->take(5)->get();
        
        return view('dashboards.admin', compact('totalUsers', 'totalRoles', 'recentUsers'));
    }
}
