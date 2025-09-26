<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class TeacherDashboardController extends Controller
{
    /**
     * Display the teacher dashboard.
     */
    public function index(): View
    {
        $user = Auth::user();
        $studentCount = 0; // This would be dynamic based on actual student relationships
        $classCount = 0;   // This would be dynamic based on actual class relationships
        
        return view('dashboards.teacher', compact('user', 'studentCount', 'classCount'));
    }
}
