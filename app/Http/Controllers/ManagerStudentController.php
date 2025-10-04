<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Guardian;
use App\Models\Classroom;
use App\Models\SchoolSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ManagerStudentController extends Controller
{
    /**
     * Display a listing of students with search and filtering.
     */
    public function index(Request $request)
    {
        $query = Student::with(['guardian', 'classroom.classCategory', 'schoolSession']);

        // Apply search
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        // Apply filters
        if ($request->filled('classroom')) {
            $query->byClassroom($request->classroom);
        }

        if ($request->filled('gender')) {
            $query->byGender($request->gender);
        }

        if ($request->filled('nationality')) {
            $query->byNationality($request->nationality);
        }

        if ($request->filled('session')) {
            $query->bySession($request->session);
        }

        $students = $query->latest()->paginate(15);
        $students->appends($request->query());

        // Get filter options
        $classrooms = Classroom::with('classCategory')->get();
        $sessions = SchoolSession::all();
        $nationalities = Student::distinct()->pluck('nationality')->filter()->sort();
        $genders = ['Male', 'Female'];

        return view('manager.students.index', compact(
            'students', 
            'classrooms', 
            'sessions', 
            'nationalities', 
            'genders'
        ));
    }

    /**
     * Show the form for creating a new student.
     */
    public function create()
    {
        $guardians = Guardian::all();
        $classrooms = Classroom::with('classCategory')->get();
        $sessions = SchoolSession::all();
        $nationalities = ['Nigerian', 'Ghanaian', 'Cameroonian', 'Other'];
        $genders = ['Male', 'Female'];
        $genotypes = ['AA', 'AS', 'SS', 'AC', 'SC'];
        $bloodGroups = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];

        return view('manager.students.create', compact(
            'guardians', 
            'classrooms', 
            'sessions', 
            'nationalities', 
            'genders', 
            'genotypes', 
            'bloodGroups'
        ));
    }

    /**
     * Store a newly created student in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'std_number' => 'required|string|unique:students,std_number|max:255',
            'date_of_birth' => 'required|date|before:today',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'nationality' => 'required|string|max:255',
            'gender' => 'required|in:Male,Female',
            'stateoforigin' => 'nullable|string|max:255',
            'lga' => 'nullable|string|max:255',
            'genotype' => 'required|in:AA,AS,SS,AC,SC',
            'bgroup' => 'required|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
            'guardian_id' => 'required|exists:guardians,id',
            'class_id' => 'required|exists:classrooms,id',
            'current_session' => 'required|exists:school_sessions,id',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('students', 'public');
        }

        $student = Student::create($validated);

        return redirect()->route('manager.students.index')
            ->with('success', 'Student created successfully.');
    }

    /**
     * Display the specified student.
     */
    public function show(Student $student)
    {
        $student->load(['guardian', 'classroom.classCategory', 'schoolSession']);
        
        return view('manager.students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified student.
     */
    public function edit(Student $student)
    {
        $guardians = Guardian::all();
        $classrooms = Classroom::with('classCategory')->get();
        $sessions = SchoolSession::all();
        $nationalities = ['Nigerian', 'Ghanaian', 'Cameroonian', 'Other'];
        $genders = ['Male', 'Female'];
        $genotypes = ['AA', 'AS', 'SS', 'AC', 'SC'];
        $bloodGroups = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];

        return view('manager.students.edit', compact(
            'student',
            'guardians', 
            'classrooms', 
            'sessions', 
            'nationalities', 
            'genders', 
            'genotypes', 
            'bloodGroups'
        ));
    }

    /**
     * Update the specified student in storage.
     */
    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'std_number' => [
                'required',
                'string',
                'max:255',
                Rule::unique('students')->ignore($student->id)
            ],
            'date_of_birth' => 'required|date|before:today',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'nationality' => 'required|string|max:255',
            'gender' => 'required|in:Male,Female',
            'stateoforigin' => 'nullable|string|max:255',
            'lga' => 'nullable|string|max:255',
            'genotype' => 'required|in:AA,AS,SS,AC,SC',
            'bgroup' => 'required|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
            'guardian_id' => 'required|exists:guardians,id',
            'class_id' => 'required|exists:classrooms,id',
            'current_session' => 'required|exists:school_sessions,id',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($student->image) {
                Storage::disk('public')->delete($student->image);
            }
            $validated['image'] = $request->file('image')->store('students', 'public');
        }

        $student->update($validated);

        return redirect()->route('manager.students.index')
            ->with('success', 'Student updated successfully.');
    }

    /**
     * Remove the specified student from storage.
     */
    public function destroy(Student $student)
    {
        // Delete image if exists
        if ($student->image) {
            Storage::disk('public')->delete($student->image);
        }

        $student->delete();

        return redirect()->route('manager.students.index')
            ->with('success', 'Student deleted successfully.');
    }
}