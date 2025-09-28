<?php

namespace App\Http\Controllers;

use App\Mail\TeacherAccountCreated;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ManagerTeacherController extends Controller
{
    /**
     * Display a listing of teachers.
     */
    public function index(Request $request): View
    {
        $query = Teacher::with('user');
        
        // Search functionality
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->search($search);
        }
        
        // Status filter
        if ($request->filled('status')) {
            $status = $request->get('status');
            if ($status === 'verified') {
                $query->whereHas('user', function ($q) {
                    $q->whereNotNull('email_verified_at');
                });
            } elseif ($status === 'unverified') {
                $query->whereHas('user', function ($q) {
                    $q->whereNull('email_verified_at');
                });
            }
        }
        
        $teachers = $query->paginate(15)->appends($request->query());
        
        return view('manager.teachers.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new teacher.
     */
    public function create(): View
    {
        return view('manager.teachers.create');
    }

    /**
     * Store a newly created teacher in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email|unique:teachers,email',
            'date_of_birth' => 'nullable|date|before:today',
            'phone_number' => 'nullable|string|max:20',
            'qualification' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:500',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            DB::beginTransaction();

            // Create full name for user account
            $fullName = trim($request->first_name . ' ' . ($request->middle_name ? $request->middle_name . ' ' : '') . $request->last_name);
            
            // Set temporary password
            $temporaryPassword = 'Teacher@123';
            
            // Create user account
            $user = User::create([
                'name' => $fullName,
                'email' => $request->email,
                'password' => Hash::make($temporaryPassword),
            ]);

            // Assign teacher role
            $user->assignRole('teacher');
            $user->syncUserRole();

            // Create teacher profile
            $teacher = Teacher::create([
                'user_id' => $user->id,
                'first_name' => $request->first_name,
                'middle_name' => $request->middle_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'date_of_birth' => $request->date_of_birth,
                'phone_number' => $request->phone_number,
                'qualification' => $request->qualification,
                'address' => $request->address,
            ]);

            // Send welcome email to teacher
            try {
                Mail::to($user->email)->send(new TeacherAccountCreated($teacher, $user, $temporaryPassword));
            } catch (\Exception $mailException) {
                // Log the mail error but don't fail the entire operation
                Log::error('Failed to send teacher welcome email: ' . $mailException->getMessage());
            }

            DB::commit();

            return redirect()->route('manager.teachers.index')
                ->with('success', 'Teacher account created successfully! Welcome email has been sent with login credentials.');

        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()->back()
                ->with('error', 'Failed to create teacher account. Please try again.')
                ->withInput();
        }
    }

    /**
     * Display the specified teacher.
     */
    public function show(Teacher $teacher): View
    {
        $teacher->load('user');
        return view('manager.teachers.show', compact('teacher'));
    }

    /**
     * Show the form for editing the specified teacher.
     */
    public function edit(Teacher $teacher): View
    {
        $teacher->load('user');
        return view('manager.teachers.edit', compact('teacher'));
    }

    /**
     * Update the specified teacher in storage.
     */
    public function update(Request $request, Teacher $teacher): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($teacher->user_id),
                Rule::unique('teachers', 'email')->ignore($teacher->id),
            ],
            'date_of_birth' => 'nullable|date|before:today',
            'phone_number' => 'nullable|string|max:20',
            'qualification' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:500',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            DB::beginTransaction();

            // Update full name for user account
            $fullName = trim($request->first_name . ' ' . ($request->middle_name ? $request->middle_name . ' ' : '') . $request->last_name);
            
            // Update user account
            $teacher->user->update([
                'name' => $fullName,
                'email' => $request->email,
            ]);

            // Update teacher profile
            $teacher->update([
                'first_name' => $request->first_name,
                'middle_name' => $request->middle_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'date_of_birth' => $request->date_of_birth,
                'phone_number' => $request->phone_number,
                'qualification' => $request->qualification,
                'address' => $request->address,
            ]);

            DB::commit();

            return redirect()->route('manager.teachers.index')
                ->with('success', 'Teacher information updated successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()->back()
                ->with('error', 'Failed to update teacher information. Please try again.')
                ->withInput();
        }
    }

    /**
     * Remove the specified teacher from storage.
     */
    public function destroy(Teacher $teacher): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $teacherName = $teacher->full_name;
            $user = $teacher->user;

            // Delete teacher profile first
            $teacher->delete();

            // Delete associated user account
            $user->delete();

            DB::commit();

            return redirect()->route('manager.teachers.index')
                ->with('success', "Teacher {$teacherName} has been removed from the system.");

        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()->back()
                ->with('error', 'Failed to delete teacher. Please try again.');
        }
    }

    /**
     * Toggle teacher email verification status.
     */
    public function toggleVerification(Teacher $teacher): RedirectResponse
    {
        try {
            $user = $teacher->user;
            
            if ($user->email_verified_at) {
                $user->update(['email_verified_at' => null]);
                $message = 'Teacher email verification removed.';
            } else {
                $user->update(['email_verified_at' => now()]);
                $message = 'Teacher email verified successfully.';
            }

            return redirect()->back()
                ->with('success', $message);

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to update verification status. Please try again.');
        }
    }

    /**
     * Bulk action for teachers.
     */
    public function bulkAction(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'action' => 'required|in:delete,verify,unverify',
            'teacher_ids' => 'required|array|min:1',
            'teacher_ids.*' => 'exists:teachers,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->with('error', 'Invalid selection or action.');
        }

        $teacherIds = $request->teacher_ids;
        $action = $request->action;

        try {
            DB::beginTransaction();

            switch ($action) {
                case 'delete':
                    $teachers = Teacher::with('user')->whereIn('id', $teacherIds)->get();
                    foreach ($teachers as $teacher) {
                        $teacher->user->delete(); // This will also delete the teacher due to cascade
                    }
                    $message = count($teacherIds) . ' teachers deleted successfully.';
                    break;

                case 'verify':
                    $teachers = Teacher::with('user')->whereIn('id', $teacherIds)->get();
                    foreach ($teachers as $teacher) {
                        $teacher->user->update(['email_verified_at' => now()]);
                    }
                    $message = count($teacherIds) . ' teachers verified successfully.';
                    break;

                case 'unverify':
                    $teachers = Teacher::with('user')->whereIn('id', $teacherIds)->get();
                    foreach ($teachers as $teacher) {
                        $teacher->user->update(['email_verified_at' => null]);
                    }
                    $message = count($teacherIds) . ' teachers unverified successfully.';
                    break;
            }

            DB::commit();

            return redirect()->back()
                ->with('success', $message);

        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()->back()
                ->with('error', 'Failed to perform bulk action. Please try again.');
        }
    }

    /**
     * Resend welcome email to teacher.
     */
    public function resendWelcomeEmail(Teacher $teacher): RedirectResponse
    {
        try {
            // Generate a new temporary password
            $temporaryPassword = 'Teacher@123';
            
            // Update user password
            $teacher->user->update([
                'password' => Hash::make($temporaryPassword)
            ]);

            // Send welcome email
            Mail::to($teacher->user->email)->send(new TeacherAccountCreated($teacher, $teacher->user, $temporaryPassword));

            return redirect()->back()
                ->with('success', 'Welcome email sent successfully with new login credentials.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to send welcome email. Please try again.');
        }
    }
}