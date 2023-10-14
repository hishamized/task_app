<?php



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Leave;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;


class AdminController extends Controller
{
    public function showAdminDashboard()
    {
        $user = auth()->user();

        if ($user->is_admin == 1) {

            $adminProjects = Project::where('admin_id', auth()->user()->admin->id)->get();

            $leaveApplications = Leave::all();

            if ($adminProjects->isEmpty()) {
                $adminProjects = collect();
                return view('admin.adminDashboard', ['adminProjects' => $adminProjects, 'leaveApplications' => $leaveApplications, 'status' => 'You have no projects yet!']);
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

            $request->validate([
                'status' => 'required|in:Approved,Pending,Rejected',
            ]);


            $leave->status = $request->input('status');
            $leave->save();

            return redirect()->route('leaveApplication', ['id' => $leave->id])->with('success', 'Leave status changed successfully.');
        } else {
            return redirect()->route('showAdminDashboard')->with('error', 'Leave application not found.');
        }
    }

    public function grantAdminPrivileges($id)
    {
        $user = User::find($id);

        if (!$user || $user->is_admin) {
            return redirect()->back()->with('error', 'Cannot grant admin privileges.');
        }

        if (!Hash::check(request('password'), auth()->user()->password)) {
            return redirect()->back()->with('error', 'Invalid password.');
        }


        $user->update(['is_admin' => 1]);


        Admin::create([
            'user_id' => $user->id,
            'roles' => 'admin',
        ]);

        return redirect()->back()->with('success', 'Admin privileges granted successfully.');
    }
}
