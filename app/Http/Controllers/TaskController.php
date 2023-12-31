<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Task;
use App\Models\TaskAssignment;
use App\Models\User;
use App\Models\TaskHistory;



class TaskController extends Controller
{


    public function showTaskAdmin($taskId)
{
    $task = Task::find($taskId);

    if (!$task) {
        return redirect()->route('tasksAdmin')->with('error', 'Task not found');
    }

    $assignedUsers = TaskAssignment::where('task_id', $taskId)->with('user')->get();

    // Load task history for the specific task
    $taskHistory = TaskHistory::where('task_id', $taskId)->get();

    return view('admin.tasksAdmin.task', compact('task', 'assignedUsers', 'taskHistory'));
}



    public function createTask(Request $request)
    {

        $this->validate($request, [
            'project_id' => 'required|exists:projects,id',
            'admin_id' => 'required|exists:admins,id',
            'task_title' => 'required|string|max:255',
            'task_description' => 'nullable|string',
            'task_objectives' => 'nullable|string',
            'creation_date' => 'required|date',
            'deadline' => [
                'required',
                'date',
                Rule::requiredIf(function () use ($request) {

                    return $request->input('creation_date') < $request->input('deadline');
                }),
            ],
            'status' => 'required|in:Not Started,In Progress,Completed,Paused,Cancelled',
            'priority' => 'required|in:High,Medium,Low',
            'progress' => 'required|integer|between:0,100',
        ]);


        Task::create($request->all());


        return redirect()->back()->with('success', 'Task created successfully');
    }

    public function editTask(Request $request)
    {

        $validatedData = $request->validate([
            'taskId' => 'required|exists:tasks,id',
            'task_title' => 'required|string|max:255',
            'task_description' => 'nullable|string',
            'task_objectives' => 'nullable|string',
            'creation_date' => 'required|date',
            'deadline' => 'required|date',
            'status' => 'required|in:Not Started,In Progress,Completed,Paused,Cancelled',
            'priority' => 'required|in:High,Medium,Low',
            'progress' => 'required|integer|min:0|max:100',
        ]);


        $task = Task::find($validatedData['taskId']);


        $task->update($validatedData);

        return redirect()->route('showTaskAdmin', ['taskId' => $task->id])
            ->with('success', 'Task updated successfully');
    }

    public function assignTask(Request $request)
    {
        $taskID = $request->input('task_id');
        $projectID = $request->input('project_id');
        $adminID = $request->input('admin_id');
        $userIdentifier = $request->input('assignTo');

        if ($user = User::findByUsernameOrEmail($userIdentifier)) {
            if ($user->project_mates->where('project_id', $projectID)->isNotEmpty()) {
                // Check if the task is already assigned to this user in the project
                if (TaskAssignment::where('task_id', $taskID)
                    ->where('project_id', $projectID)
                    ->where('user_id', $user->id)
                    ->exists()) {
                    return redirect()->back()->with('error', 'Task is already assigned to ' . $user->name);
                }

                $taskAssignment = new TaskAssignment();
                $taskAssignment->task_id = $taskID;
                $taskAssignment->project_id = $projectID;
                $taskAssignment->admin_id = $adminID;
                $taskAssignment->user_id = $user->id;
                $taskAssignment->status = 'Active';
                $taskAssignment->save();

                // Record task history for assignment
                TaskHistory::create([
                    'task_id' => $taskID,
                    'user_id' => $user->id,
                    'admin_id' => $adminID,
                    'project_id' => $projectID,
                    'action' => 'Assigned',
                    'action_date' => now()->toDateString(),
                    'user_assignment_date' => now()->toDateString(),
                ]);

                return redirect()->back()->with('success', 'Task assigned to ' . $user->name);
            } else {
                return redirect()->back()->with('error', 'The user is not part of this project.');
            }
        } else {
            return redirect()->back()->with('error', 'User with the provided username or email not found');
        }
    }


public function removeUserFromTask($userId, $taskId, $projectId)
{
    $taskAssignment = TaskAssignment::where('user_id', $userId)
        ->where('task_id', $taskId)
        ->first();

    if ($taskAssignment) {
        // Record task history for removal
        TaskHistory::create([
            'task_id' => $taskId,
            'user_id' => $userId,
            'admin_id' => auth()->user()->admin->id,
            'project_id' => $projectId,
            'action' => 'Removed',
            'action_date' => now()->toDateString(),
            'user_assignment_date' => $taskAssignment->created_at->toDateString(),
        ]);

        $taskAssignment->delete();
        return redirect()->back()->with('success', 'User removed from the task.');
    } else {
        return redirect()->back()->with('error', 'User assignment not found or already removed.');
    }
}


public function viewTask($id)
{
    $task = Task::findOrFail($id);

    if (!$task) {
        return redirect()->route('show_dashboard')->with('error', 'Task not found.');
    }

    return view('employee.tasks.viewTask', compact('task'));
}

}
