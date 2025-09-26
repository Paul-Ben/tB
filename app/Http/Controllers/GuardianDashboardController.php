<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class GuardianDashboardController extends Controller
{
    /**
     * Display the guardian dashboard.
     */
    public function index(): View
    {
        $user = Auth::user();
        $childrenCount = 0; // This would be dynamic based on actual student relationships
        
        return view('dashboards.guardian', compact('user', 'childrenCount'));
    }
}
