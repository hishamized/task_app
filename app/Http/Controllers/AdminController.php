<?php



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class AdminController extends Controller
{
    public function showAdminDashboard()
{
    $user = auth()->user();

    if ($user->is_admin == 1) {

        $adminProjects = Project::where('admin_id', auth()->user()->admin->id)->get();


        if ($adminProjects->isEmpty()) {

            return redirect()->route('showAdminDashboard')->with('status', 'You have no projects yet!');
        } else {

            return view('admin.adminDashboard', ['adminProjects' => $adminProjects]);
        }
    } else {


        return redirect()->route('employee.dashboard');
    }
}
}
