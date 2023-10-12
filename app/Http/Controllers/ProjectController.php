<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\ProjectMate;
use App\Models\User;

class ProjectController extends Controller
{
    public function viewProject($id)
    {

        $project = Project::with('project_mates')->find($id);

        if (!$project) {
            return redirect()->route('showAdminDashboard')->with('error', 'Project not found.');
        }

        return view('projects.project', ['project' => $project]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'expected_end_date' => 'required|date',
        ]);

        if (strtotime($request->start_date) > strtotime($request->expected_end_date)) {
            return redirect()->back()->with('error', 'Start date must be before the expected end date.');
        }

        $project = Project::create([
            'user_id' => auth()->user()->id,
            'admin_id' => auth()->user()->admin->id,
            'title' => $request->title,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'expected_end_date' => $request->expected_end_date,
            'status' => $request->status ?? 'Active',
        ]);

        return redirect()->route('showAdminDashboard')->with('success', 'Project created successfully.');
    }


    public function editProject(Request $request)
    {

        $project = Project::find($request->id);


        if (!$project) {
            return redirect()->route('project.index')->with('error', 'Project not found.');
        }


        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'expected_end_date' => 'required|date|after:start_date',
            'status' => 'required|in:Active,Inactive,Completed',
        ]);


        $project->update($validatedData);

        return back()->with('success', 'Project updated successfully.');

    }

    public function addPeople(Request $request)
{

    $request->validate([
        'project_id' => 'required|exists:projects,id',
        'userIdentifier' => 'required',
    ]);


    $userIdentifier = $request->input('userIdentifier');
    $field = filter_var($userIdentifier, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';


    $user = User::where($field, $userIdentifier)->first();

    if (!$user) {

        return back()->with('error', 'No such user exists.');
    }


    $projectID = $request->input('project_id');
    $existingMate = ProjectMate::where('user_id', $user->id)->where('project_id', $projectID)->first();

    if ($existingMate) {

        return back()->with('warning', 'User is already associated with this project.');
    }


    ProjectMate::create([
        'user_id' => $user->id,
        'project_id' => $projectID,
    ]);


    return back()->with('success', 'User added to the project successfully.');
}

public function removeProjectMate(ProjectMate $projectMate)
{

    if (!$projectMate) {
        return back()->with('error', 'Project Mate not found.');
    }


    $projectMate->delete();

    return back()->with('success', 'Project Mate removed successfully.');
}

}

