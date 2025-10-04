<?php

namespace App\Http\Controllers;

use App\Models\Guardian;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ManagerGuardianController extends Controller
{
    /**
     * Display a listing of guardians.
     */
    public function index(Request $request)
    {
        $query = Guardian::with(['user', 'students']);

        // Search functionality
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        // Filter by nationality
        if ($request->filled('nationality')) {
            $query->byNationality($request->nationality);
        }

        // Filter by state of origin
        if ($request->filled('state')) {
            $query->byState($request->state);
        }

        $guardians = $query->latest()->paginate(15);

        // Get unique nationalities and states for filter dropdowns
        $nationalities = Guardian::distinct()->pluck('nationality')->filter()->sort();
        $states = Guardian::distinct()->pluck('stateoforigin')->filter()->sort();

        return view('manager.guardians.index', compact('guardians', 'nationalities', 'states'));
    }

    /**
     * Show the form for creating a new guardian.
     */
    public function create()
    {
        return view('manager.guardians.create');
    }

    /**
     * Store a newly created guardian in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'guardian_name' => 'required|string|max:255',
            'guardian_phone' => 'required|string|max:20|unique:guardians,guardian_phone',
            'guardian_email' => 'required|email|max:255|unique:guardians,guardian_email',
            'address' => 'nullable|string|max:500',
            'nationality' => 'nullable|string|max:100',
            'stateoforigin' => 'nullable|string|max:100',
            'lga' => 'nullable|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create user account for guardian
        $user = User::create([
            'name' => $validated['guardian_name'],
            'email' => $validated['guardian_email'],
            'password' => Hash::make($validated['password']),
            'user_role' => 'guardian',
        ]);

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('guardians', 'public');
        }

        // Create guardian record
        $guardian = Guardian::create([
            'user_id' => $user->id,
            'guardian_name' => $validated['guardian_name'],
            'guardian_phone' => $validated['guardian_phone'],
            'guardian_email' => $validated['guardian_email'],
            'address' => $validated['address'],
            'nationality' => $validated['nationality'],
            'stateoforigin' => $validated['stateoforigin'],
            'lga' => $validated['lga'],
            'image' => $imagePath,
        ]);

        return redirect()->route('manager.guardians.index')
            ->with('success', 'Guardian created successfully.');
    }

    /**
     * Display the specified guardian.
     */
    public function show(Guardian $guardian)
    {
        $guardian->load(['user', 'students.classroom']);
        
        return view('manager.guardians.show', compact('guardian'));
    }

    /**
     * Show the form for editing the specified guardian.
     */
    public function edit(Guardian $guardian)
    {
        $guardian->load('user');
        
        return view('manager.guardians.edit', compact('guardian'));
    }

    /**
     * Update the specified guardian in storage.
     */
    public function update(Request $request, Guardian $guardian)
    {
        $validated = $request->validate([
            'guardian_name' => 'required|string|max:255',
            'guardian_phone' => [
                'required',
                'string',
                'max:20',
                Rule::unique('guardians', 'guardian_phone')->ignore($guardian->id)
            ],
            'guardian_email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('guardians', 'guardian_email')->ignore($guardian->id)
            ],
            'address' => 'nullable|string|max:500',
            'nationality' => 'nullable|string|max:100',
            'stateoforigin' => 'nullable|string|max:100',
            'lga' => 'nullable|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($guardian->image) {
                Storage::disk('public')->delete($guardian->image);
            }
            $validated['image'] = $request->file('image')->store('guardians', 'public');
        }

        // Update guardian record
        $guardian->update($validated);

        // Update associated user record
        $guardian->user->update([
            'name' => $validated['guardian_name'],
            'email' => $validated['guardian_email'],
        ]);

        return redirect()->route('manager.guardians.show', $guardian)
            ->with('success', 'Guardian updated successfully.');
    }

    /**
     * Remove the specified guardian from storage.
     */
    public function destroy(Guardian $guardian)
    {
        // Delete image if exists
        if ($guardian->image) {
            Storage::disk('public')->delete($guardian->image);
        }

        // Delete guardian (user will be deleted automatically due to cascade)
        $guardian->delete();

        return redirect()->route('manager.guardians.index')
            ->with('success', 'Guardian deleted successfully.');
    }
}