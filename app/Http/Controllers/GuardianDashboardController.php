<?php

namespace App\Http\Controllers;

use App\Models\Guardian;
use App\Models\Student;
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
        $guardian = Guardian::where('user_id', $user->id)->first();

        // Build children list safely even if guardian profile is missing
        $childrenQuery = Student::query();
        if ($guardian) {
            $childrenQuery->where('guardian_id', $guardian->id);
        } else {
            $childrenQuery->whereRaw('1 = 0');
        }

        $children = $childrenQuery->with(['classroom'])
            ->orderBy('last_name')
            ->orderBy('first_name')
            ->paginate(10);

        $childrenCount = $guardian ? $guardian->students()->count() : 0;
        
        return view('dashboards.guardian', compact('user', 'childrenCount', 'children', 'guardian'));
    }
}
