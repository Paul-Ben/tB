<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\ClassCategory;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ManagerClassroomController extends Controller
{
    /**
     * Display a listing of classrooms.
     */
    public function index(Request $request): View
    {
        $query = Classroom::with(['classCategory', 'teacher', 'students']);
        
        // Search functionality
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->search($search);
        }
        
        // Category filter
        if ($request->filled('category')) {
            $categoryId = $request->get('category');
            $query->where('category_id', $categoryId);
        }
        
        // Teacher assignment filter
        if ($request->filled('teacher_status')) {
            $status = $request->get('teacher_status');
            if ($status === 'assigned') {
                $query->whereNotNull('teacher_id');
            } elseif ($status === 'unassigned') {
                $query->whereNull('teacher_id');
            }
        }
        
        $classrooms = $query->paginate(15)->appends($request->query());
        $classCategories = ClassCategory::all();
        $availableTeachers = Teacher::with('user')->get();
        
        return view('manager.classrooms.index', compact('classrooms', 'classCategories', 'availableTeachers'));
    }

    /**
     * Show the form for creating a new classroom.
     */
    public function create(): View
    {
        $classCategories = ClassCategory::all();
        $availableTeachers = Teacher::with('user')->get();
        
        return view('manager.classrooms.create', compact('classCategories', 'availableTeachers'));
    }

    /**
     * Store a newly created classroom in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:classrooms,name',
            'category_id' => 'required|exists:class_categories,id',
            'teacher_id' => 'nullable|exists:teachers,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $classroom = Classroom::create([
                'name' => $request->name,
                'category_id' => $request->category_id,
                'teacher_id' => $request->teacher_id,
            ]);

            return redirect()->route('manager.classrooms.index')
                ->with('success', 'Classroom created successfully.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to create classroom. Please try again.')
                ->withInput();
        }
    }

    /**
     * Display the specified classroom.
     */
    public function show(Classroom $classroom): View
    {
        $classroom->load(['classCategory', 'teacher.user', 'students.guardian']);
        
        return view('manager.classrooms.show', compact('classroom'));
    }

    /**
     * Show the form for editing the specified classroom.
     */
    public function edit(Classroom $classroom): View
    {
        $classCategories = ClassCategory::all();
        $availableTeachers = Teacher::with('user')->get();
        
        return view('manager.classrooms.edit', compact('classroom', 'classCategories', 'availableTeachers'));
    }

    /**
     * Update the specified classroom in storage.
     */
    public function update(Request $request, Classroom $classroom): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('classrooms', 'name')->ignore($classroom->id),
            ],
            'category_id' => 'required|exists:class_categories,id',
            'teacher_id' => 'nullable|exists:teachers,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $classroom->update([
                'name' => $request->name,
                'category_id' => $request->category_id,
                'teacher_id' => $request->teacher_id,
            ]);

            return redirect()->route('manager.classrooms.index')
                ->with('success', 'Classroom updated successfully.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to update classroom. Please try again.')
                ->withInput();
        }
    }

    /**
     * Remove the specified classroom from storage.
     */
    public function destroy(Classroom $classroom): RedirectResponse
    {
        try {
            // Check if classroom has students
            if ($classroom->students()->count() > 0) {
                return redirect()->back()
                    ->with('error', 'Cannot delete classroom that has students enrolled. Please move students to other classrooms first.');
            }

            $classroomName = $classroom->name;
            $classroom->delete();

            return redirect()->route('manager.classrooms.index')
                ->with('success', "Classroom '{$classroomName}' has been deleted successfully.");

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to delete classroom. Please try again.');
        }
    }

    /**
     * Assign or unassign teacher to classroom.
     */
    public function assignTeacher(Request $request, Classroom $classroom): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'teacher_id' => 'nullable|exists:teachers,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator);
        }

        try {
            $classroom->update([
                'teacher_id' => $request->teacher_id,
            ]);

            $message = $request->teacher_id 
                ? 'Teacher assigned to classroom successfully.'
                : 'Teacher unassigned from classroom successfully.';

            return redirect()->back()
                ->with('success', $message);

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to update teacher assignment. Please try again.');
        }
    }
}