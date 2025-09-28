<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Teacher;
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
        $totalTeachers = Teacher::count();
        $verifiedTeachers = Teacher::whereHas('user', function($q) {
            $q->whereNotNull('email_verified_at');
        })->count();
        $recentUsers = User::latest()->take(5)->get();
        $recentTeachers = Teacher::with('user')->latest()->take(3)->get();
        
        return view('dashboards.admin', compact(
            'totalUsers', 
            'totalRoles', 
            'totalTeachers', 
            'verifiedTeachers', 
            'recentUsers', 
            'recentTeachers'
        ));
    }
}
