<?php

namespace App\Http\Controllers;

use App\Models\Guardian;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class GuardianChildrenController extends Controller
{
    /**
     * Display a listing of the guardian's children.
     */
    public function index(Request $request): View
    {
        $user = Auth::user();
        $guardian = Guardian::where('user_id', $user->id)->first();

        $query = Student::query()->with(['classroom']);
        if ($guardian) {
            $query->where('guardian_id', $guardian->id);
        } else {
            // No guardian profile; ensure empty result
            $query->whereRaw('1 = 0');
        }

        // Optional search
        if ($request->filled('search')) {
            $query->search($request->input('search'));
        }

        $students = $query->orderBy('last_name')->orderBy('first_name')->paginate(10);
        $students->appends($request->query());

        return view('guardian.children.index', compact('students', 'guardian', 'user'));
    }

    /**
     * Display the specified student's profile, ensuring ownership.
     */
    public function show(Student $student): View|RedirectResponse
    {
        $user = Auth::user();
        $guardian = Guardian::where('user_id', $user->id)->first();

        if (!$guardian || $student->guardian_id !== $guardian->id) {
            return redirect()->route('guardian.children.index')
                ->with('error', 'You are not authorized to view this student profile.');
        }

        $student->load(['classroom.classCategory', 'guardian', 'schoolSession']);

        return view('guardian.children.show', compact('student', 'guardian', 'user'));
    }
}