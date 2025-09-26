<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User;

class ManagerDashboardController extends Controller
{
    /**
     * Display the manager dashboard.
     */
    public function index(): View
    {
        $teacherCount = User::role('teacher')->count();
        $guardianCount = User::role('guardian')->count();
        $recentUsers = User::whereIn('userRole', ['teacher', 'guardian'])->latest()->take(5)->get();
        
        return view('dashboards.manager', compact('teacherCount', 'guardianCount', 'recentUsers'));
    }
}
