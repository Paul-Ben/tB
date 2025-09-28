<?php

namespace App\Http\Controllers;

use App\Models\SchoolSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManagerSchoolSessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schoolSessions = SchoolSession::orderBy('created_at', 'desc')->paginate(10);
        
        return view('manager.school-sessions.index', compact('schoolSessions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('manager.school-sessions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'sessionName' => 'required|string|max:255|unique:school_sessions,sessionName',
            'status' => 'required|in:active,inactive'
        ]);

        try {
            DB::beginTransaction();

            // If setting this session as active, deactivate all other sessions
            if ($request->status === 'active') {
                SchoolSession::where('status', 'active')->update(['status' => 'inactive']);
            }

            SchoolSession::create([
                'sessionName' => $request->sessionName,
                'status' => $request->status
            ]);

            DB::commit();

            return redirect()->route('manager.school-sessions.index')
                ->with('success', 'School session created successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to create school session. Please try again.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(SchoolSession $schoolSession)
    {
        return view('manager.school-sessions.show', compact('schoolSession'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SchoolSession $schoolSession)
    {
        return view('manager.school-sessions.edit', compact('schoolSession'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SchoolSession $schoolSession)
    {
        $request->validate([
            'sessionName' => 'required|string|max:255|unique:school_sessions,sessionName,' . $schoolSession->id,
            'status' => 'required|in:active,inactive'
        ]);

        try {
            DB::beginTransaction();

            // If setting this session as active, deactivate all other sessions
            if ($request->status === 'active' && $schoolSession->status !== 'active') {
                SchoolSession::where('status', 'active')->update(['status' => 'inactive']);
            }

            $schoolSession->update([
                'sessionName' => $request->sessionName,
                'status' => $request->status
            ]);

            DB::commit();

            return redirect()->route('manager.school-sessions.index')
                ->with('success', 'School session updated successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to update school session. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SchoolSession $schoolSession)
    {
        try {
            // Prevent deletion of active session
            if ($schoolSession->isActive()) {
                return redirect()->back()
                    ->with('error', 'Cannot delete an active school session. Please deactivate it first.');
            }

            $schoolSession->delete();

            return redirect()->route('manager.school-sessions.index')
                ->with('success', 'School session deleted successfully!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to delete school session. Please try again.');
        }
    }

    /**
     * Toggle the status of a school session
     */
    public function toggleStatus(SchoolSession $schoolSession)
    {
        try {
            DB::beginTransaction();

            if ($schoolSession->status === 'inactive') {
                // Deactivate all other sessions before activating this one
                SchoolSession::where('status', 'active')->update(['status' => 'inactive']);
                $schoolSession->update(['status' => 'active']);
                $message = 'School session activated successfully!';
            } else {
                $schoolSession->update(['status' => 'inactive']);
                $message = 'School session deactivated successfully!';
            }

            DB::commit();

            return redirect()->back()->with('success', $message);

        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()->back()
                ->with('error', 'Failed to update session status. Please try again.');
        }
    }

    /**
     * Get active school session
     */
    public function getActiveSession()
    {
        return SchoolSession::active()->first();
    }
}