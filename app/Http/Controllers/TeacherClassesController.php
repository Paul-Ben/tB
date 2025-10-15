<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Teacher;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class TeacherClassesController extends Controller
{
    /**
     * Display a listing of classes assigned to the authenticated teacher.
     */
    public function index(Request $request): View|RedirectResponse
    {
        $user = Auth::user();
        $teacher = Teacher::where('user_id', $user->id)->first();

        // Gracefully handle missing teacher profile to avoid 404s
        if (!$teacher) {
            return redirect()->route('teacher.dashboard')
                ->with('error', 'No teacher profile is linked to your account.');
        }

        $query = Classroom::with(['classCategory', 'students'])
            ->where('teacher_id', $teacher->id);

        // Optional search by class name or category
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhereHas('classCategory', function ($cq) use ($search) {
                      $cq->where('name', 'like', "%{$search}%");
                  });
            });
        }

        $classrooms = $query->orderBy('name')->paginate(15);
        $classrooms->appends($request->query());

        return view('teacher.classes.index', compact('teacher', 'classrooms'));
    }

    /**
     * Display a specific classroom with its students for the authenticated teacher.
     */
    public function show(Request $request, Classroom $classroom): View|RedirectResponse
    {
        $user = Auth::user();
        $teacher = Teacher::where('user_id', $user->id)->first();

        if (!$teacher) {
            return redirect()->route('teacher.dashboard')
                ->with('error', 'No teacher profile is linked to your account.');
        }

        // Ensure the classroom belongs to the authenticated teacher
        if ((int) $classroom->teacher_id !== (int) $teacher->id) {
            abort(403, 'You are not authorized to view this classroom.');
        }

        // Optional search/filter by student name or number
        $studentsQuery = $classroom->students()->with(['guardian'])
            ->orderBy('last_name')
            ->orderBy('first_name');

        if ($request->filled('search')) {
            $search = $request->get('search');
            $studentsQuery->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('middle_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('std_number', 'like', "%{$search}%");
            });
        }

        $students = $studentsQuery->paginate(20);
        $students->appends($request->query());

        return view('teacher.classes.show', [
            'teacher' => $teacher,
            'classroom' => $classroom->load(['classCategory', 'teacher']),
            'students' => $students,
        ]);
    }
}