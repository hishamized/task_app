<?php



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Leave;


class AdminController extends Controller
{
    public function showAdminDashboard()
{
    $user = auth()->user();

    if ($user->is_admin == 1) {

        $adminProjects = Project::where('admin_id', auth()->user()->admin->id)->get();

        $leaveApplications = Leave::all();

        if ($adminProjects->isEmpty()) {

            return view('admin.adminDashboard')->with('status', 'You have no projects yet!');

        } else {

            return view('admin.adminDashboard', ['adminProjects' => $adminProjects, 'leaveApplications' => $leaveApplications]);
        }
    } else {


        return redirect()->route('employee.dashboard');
    }
}

public function showLeaveApplication($id)
{
    $leave = Leave::findOrFail($id);

    if ($leave) {
        return view('admin.adminLeaves.adminLeave', compact('leave'));
    } else {
        return redirect()->route('showAdminDashboard')->with('error', 'Leave application not found.');
    }
}

public function changeLeaveStatus(Request $request, $id)
{
    $leave = Leave::findOrFail($id);

    if ($leave) {
        // Validate the status value from the form
        $request->validate([
            'status' => 'required|in:Approved,Pending,Rejected',
        ]);

        // Update the leave status with the selected value
        $leave->status = $request->input('status');
        $leave->save();

        return redirect()->route('leaveApplication', ['id' => $leave->id])->with('success', 'Leave status changed successfully.');
    } else {
        return redirect()->route('showAdminDashboard')->with('error', 'Leave application not found.');
    }
}


}
