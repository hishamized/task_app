@extends('layout.app')

@section('content')
@if (session('status'))
<div class="alert alert-success">
    {{ session('status') }}
</div>
@endif

@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@if (Session::has('error'))
    <div class="alert alert-danger">
        {{ Session::get('error') }}
    </div>
@endif

@if(session('warning'))
<div class="alert alert-warning">
    {{ session('warning') }}
</div>
@endif
<div class="container mt-5 my-3">

    <button class="btn btn-primary" id="editTaskButton">Edit Task</button>


    <form action="{{ route('editTask') }}" method="post" id="editTaskForm" style="display: none;">
        @csrf

        <input type="hidden" name="taskId" value="{{ $task->id }}">

        <div class="mb-3">
            <label for="task_title" class="form-label">Task Title:</label>
            <input type="text" name="task_title" id="task_title" class="form-control" value="{{ $task->task_title }}">
        </div>

        <div class="mb-3">
            <label for="task_description" class="form-label">Task Description:</label>
            <textarea name="task_description" id="task_description" class="form-control">{{ $task->task_description }}</textarea>
        </div>

        <div class="mb-3">
            <label for="task_objectives" class="form-label">Task Objectives:</label>
            <textarea name="task_objectives" id="task_objectives" class="form-control">{{ $task->task_objectives }}</textarea>
        </div>

        <div class="mb-3">
            <label for="creation_date" class="form-label">Creation Date:</label>
            <input type="date" name="creation_date" id="creation_date" class="form-control" value="{{ $task->creation_date }}" readonly>
        </div>

        <div class="mb-3">
            <label for="deadline" class a="form-label">Deadline:</label>
            <input type="date" name="deadline" id="deadline" class="form-control" value="{{ $task->deadline }}">
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status:</label>
            <select name="status" id="status" class="form-select">
                <option value="Not Started" {{ $task->status === 'Not Started' ? 'selected' : '' }}>Not Started</option>
                <option value="In Progress" {{ $task->status === 'In Progress' ? 'selected' : '' }}>In Progress</option>
                <option value="Completed" {{ $task->status === 'Completed' ? 'selected' : '' }}>Completed</option>
                <option value="Paused" {{ $task->status === 'Paused' ? 'selected' : '' }}>Paused</option>
                <option value="Cancelled" {{ $task->status === 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="priority" class="form-label">Priority:</label>
            <select name="priority" id="priority" class="form-select">
                <option value="High" {{ $task->priority === 'High' ? 'selected' : '' }}>High</option>
                <option value="Medium" {{ $task->priority === 'Medium' ? 'selected' : '' }}>Medium</option>
                <option value="Low" {{ $task->priority === 'Low' ? 'selected' : '' }}>Low</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="progress" class="form-label">Progress (%):</label>
            <input type="number" name="progress" id="progress" class="form-control" value="{{ $task->progress }}">
        </div>

        <button type="submit" class="btn btn-primary">Update Task</button>
    </form>

</div>


<div class="container mt-5 my-3">

    <button id="assignTaskButton" class="btn btn-primary">Assign This Task</button>


    <form id="assignmentForm" action="{{ route('assignTask') }}" method="POST" style="display: none;">
        @csrf
        <input type="hidden" name="task_id" value="{{ $task->id }}">
        <input type="hidden" name="project_id" value="{{ $task->project_id }}">
        <input type="hidden" name="admin_id" value="{{ $task->admin_id }}">
        <div class="mb-3">
            <label for="assignTo">Assign To (Username or Email):</label>
            <input type="text" name="assignTo" id="assignTo" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Assign</button>
    </form>

</div>
<div class="container mt-4">
    <h1>Task Details</h1>

    <div class="card">
        <div class="card-body">
            <h4 class="card-title">{{ $task->task_title }}</h4>

            <p class="card-text"><strong>Description:</strong> {{ $task->task_description ?? 'N/A' }}</p>
            <p class="card-text"><strong>Objectives:</strong> {{ $task->task_objectives ?? 'N/A' }}</p>
            <p class="card-text"><strong>Creation Date:</strong> {{ $task->creation_date }}</p>
            <p class="card-text"><strong>Deadline:</strong> {{ $task->deadline }}</p>
            <p class="card-text"><strong>Status:</strong> {{ $task->status }}</p>
            <p class="card-text"><strong>Priority:</strong> {{ $task->priority }}</p>
            <p class="card-text"><strong>Progress:</strong> {{ $task->progress }}%</p>

            <hr>

            <h5 class="card-subtitle mb-2 text-muted">Project</h5>
            <p class="card-text"><strong>Project Title:</strong> {{ $task->project->title }}</p>
            <a href="{{ route('project.view', ['id' => $task->project->id])}}" class="btn btn-primary btn-sm">View Project</a>
        </div>
    </div>
</div>

<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            Assigned Users
        </div>
        <div class="card-body">
            @if ($assignedUsers->isEmpty())
                <p>No users have been assigned to this task.</p>
            @else
                <ul class="list-group">
                    @foreach ($assignedUsers as $assignment)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $assignment->user->name }} ({{ $assignment->user->email }})

                            <form action="{{ route('removeUserFromTask', ['userId' => $assignment->user->id, 'taskId' => $task->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger">Remove</button>
                            </form>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</div>



<script src="{{ asset('js/tasks.js') }}"></script>
@endsection
