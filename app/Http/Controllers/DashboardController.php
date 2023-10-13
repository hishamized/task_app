<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Leave;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{

    public function show_dashboard()
    {
        $user = Auth::user();

        $projectAssignments = $user->project_mates ?? [];
        $taskAssignments = $user->task_assignments ?? [];
        $leaves = $user->leaves ?? [];

        $projects = [];
        foreach ($projectAssignments as $projectAssignment) {
            $projects[] = $projectAssignment->project;
        }
        $tasks = [];
        foreach ($taskAssignments as $taskAssignment) {
            $tasks[] = $taskAssignment->task;
        }

        return view('employee.dashboard', compact('projects', 'tasks', 'leaves'));
    }

    public function submitLeaveApplication(Request $request)
    {

        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'status' => 'required',
            'subject' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'required',
        ]);

        try {

            Leave::create($validatedData);

            return back()->with('success', 'Leave application submitted successfully.');
        } catch (\Exception $e) {

            return back()->with('error', 'Failed to submit leave application. Please try again.');
        }
    }

    public function viewLeaveApplication($id)
    {
        // Fetch the leave application by ID
        $leave = Leave::find($id);

        if (!$leave) {
            return redirect()->route('showAdminDashboard')->with('error', 'Leave application not found.');
        }

        return view('employee.employeeLeaves.viewLeave', compact('leave'));
    }

    public function updateLeave(Request $request, $id)
{
    $leave = Leave::findOrFail($id);

    if ($leave->status === 'Pending') {

        $this->validate($request, [
            'subject' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'reason' => 'required',
        ]);

        $leave->update([
            'subject' => $request->input('subject'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'reason' => $request->input('reason'),
        ]);

        return redirect()->route('viewLeaveApplication')->with('success', 'Leave application updated successfully.');
    } else {
        return back()->with('error', 'This leave application cannot be edited because it has already been reviewed.');
    }
}
}
