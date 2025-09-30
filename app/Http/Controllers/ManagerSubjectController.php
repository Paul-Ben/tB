<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Validator;

class ManagerSubjectController extends Controller
{
    /**
     * Display a listing of subjects.
     */
    public function index(Request $request): View
    {
        $query = Subject::with(['teacher.user', 'classroom']);

        // Search functionality
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        // Filter by teacher
        if ($request->filled('teacher_id')) {
            $query->byTeacher($request->teacher_id);
        }

        // Filter by classroom
        if ($request->filled('classroom_id')) {
            $query->byClassroom($request->classroom_id);
        }

        $subjects = $query->orderBy('created_at', 'desc')->paginate(15)->appends($request->query());
        $teachers = Teacher::with('user')->get();
        $classrooms = Classroom::all();

        return view('manager.subjects.index', compact('subjects', 'teachers', 'classrooms'));
    }

    /**
     * Show the form for creating a new subject.
     */
    public function create(): View
    {
        $teachers = Teacher::with('user')->get();
        $classrooms = Classroom::all();

        return view('manager.subjects.create', compact('teachers', 'classrooms'));
    }

    /**
     * Store a newly created subject in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:10|unique:subjects,code',
            'teacher_id' => 'required|exists:teachers,id',
            'classroom_id' => 'required|exists:classrooms,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            Subject::create([
                'name' => $request->name,
                'code' => strtoupper($request->code),
                'teacher_id' => $request->teacher_id,
                'classroom_id' => $request->classroom_id,
            ]);

            return redirect()->route('manager.subjects.index')
                ->with('success', 'Subject created successfully.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to create subject. Please try again.')
                ->withInput();
        }
    }

    /**
     * Display the specified subject.
     */
    public function show(Subject $subject): View
    {
        $subject->load(['teacher.user', 'classroom']);

        return view('manager.subjects.show', compact('subject'));
    }

    /**
     * Show the form for editing the specified subject.
     */
    public function edit(Subject $subject): View
    {
        $teachers = Teacher::with('user')->get();
        $classrooms = Classroom::all();

        return view('manager.subjects.edit', compact('subject', 'teachers', 'classrooms'));
    }

    /**
     * Update the specified subject in storage.
     */
    public function update(Request $request, Subject $subject): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:10|unique:subjects,code,' . $subject->id,
            'teacher_id' => 'required|exists:teachers,id',
            'classroom_id' => 'required|exists:classrooms,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $subject->update([
                'name' => $request->name,
                'code' => strtoupper($request->code),
                'teacher_id' => $request->teacher_id,
                'classroom_id' => $request->classroom_id,
            ]);

            return redirect()->route('manager.subjects.index')
                ->with('success', 'Subject updated successfully.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to update subject. Please try again.')
                ->withInput();
        }
    }

    /**
     * Remove the specified subject from storage.
     */
    public function destroy(Subject $subject): RedirectResponse
    {
        try {
            $subject->delete();

            return redirect()->route('manager.subjects.index')
                ->with('success', 'Subject deleted successfully.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to delete subject. Please try again.');
        }
    }
}