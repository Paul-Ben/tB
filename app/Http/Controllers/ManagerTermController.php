<?php

namespace App\Http\Controllers;

use App\Models\Term;
use App\Models\SchoolSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ManagerTermController extends Controller
{
    /**
     * Display a listing of terms.
     */
    public function index(Request $request): View
    {
        $query = Term::with(['schoolSession']);
        
        // Search functionality
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->search($search);
        }
        
        // Session filter
        if ($request->filled('session_id')) {
            $sessionId = $request->get('session_id');
            $query->where('session_id', $sessionId);
        }
        
        // Status filter
        if ($request->filled('status')) {
            $status = $request->get('status');
            $query->status($status);
        }
        
        $terms = $query->orderBy('created_at', 'desc')->paginate(15)->appends($request->query());
        $schoolSessions = SchoolSession::all();
        
        return view('manager.terms.index', compact('terms', 'schoolSessions'));
    }

    /**
     * Show the form for creating a new term.
     */
    public function create(): View
    {
        $schoolSessions = SchoolSession::all();
        
        return view('manager.terms.create', compact('schoolSessions'));
    }

    /**
     * Store a newly created term in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'session_id' => 'required|exists:school_sessions,id',
            'name' => 'required|string|max:255',
            'startDate' => 'nullable|date',
            'endDate' => 'nullable|date|after_or_equal:startDate',
            'status' => 'required|in:active,inactive',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $term = Term::create([
                'session_id' => $request->session_id,
                'name' => $request->name,
                'startDate' => $request->startDate,
                'endDate' => $request->endDate,
                'status' => $request->status,
            ]);

            return redirect()->route('manager.terms.index')
                ->with('success', 'Term created successfully.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to create term. Please try again.')
                ->withInput();
        }
    }

    /**
     * Display the specified term.
     */
    public function show(Term $term): View
    {
        $term->load(['schoolSession']);
        
        return view('manager.terms.show', compact('term'));
    }

    /**
     * Show the form for editing the specified term.
     */
    public function edit(Term $term): View
    {
        $schoolSessions = SchoolSession::all();
        
        return view('manager.terms.edit', compact('term', 'schoolSessions'));
    }

    /**
     * Update the specified term in storage.
     */
    public function update(Request $request, Term $term): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'session_id' => 'required|exists:school_sessions,id',
            'name' => 'required|string|max:255',
            'startDate' => 'nullable|date',
            'endDate' => 'nullable|date|after_or_equal:startDate',
            'status' => 'required|in:active,inactive',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $term->update([
                'session_id' => $request->session_id,
                'name' => $request->name,
                'startDate' => $request->startDate,
                'endDate' => $request->endDate,
                'status' => $request->status,
            ]);

            return redirect()->route('manager.terms.index')
                ->with('success', 'Term updated successfully.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to update term. Please try again.')
                ->withInput();
        }
    }

    /**
     * Remove the specified term from storage.
     */
    public function destroy(Term $term): RedirectResponse
    {
        try {
            $termName = $term->name;
            $term->delete();

            return redirect()->route('manager.terms.index')
                ->with('success', "Term '{$termName}' deleted successfully.");

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to delete term. Please try again.');
        }
    }
}