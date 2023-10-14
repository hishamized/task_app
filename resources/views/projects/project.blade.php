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

@if(session('warning'))
<div class="alert alert-warning">
    {{ session('warning') }}
</div>
@endif


<div class="container mt-5">
    @if(auth()->user()->is_admin == 1)

    <button id="toggleEditForm" class="btn btn-primary" onclick="toggleFormVisibility()">Edit Project</button>


    <form action="{{  route('editProject', ['id' => $project->id]) }}" id="editProjectForm" style="display: none;" method="post">
        @csrf
        <input type="hidden" name="id" value="{{ $project->id }}">

        <div class="mb-3">
            <label for="title" class="form-label">Title:</label>
            <input type="text" id="title" name="title" class="form-control" required value="{{ $project->title ?? '' }}">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description:</label>
            <textarea id="description" name="description" class="form-control">{{ $project->description ?? '' }}</textarea>
        </div>

        <div class="mb-3">
            <label for="start_date" class="form-label">Start Date:</label>
            <input type="date" id="start_date" name="start_date" class="form-control" required value="{{ $project->start_date ?? '' }}" readonly>
        </div>

        <div class="mb-3">
            <label for="expected_end_date" class="form-label">Expected End Date:</label>
            <input type="date" id="expected_end_date" name="expected_end_date" class="form-control" required value="{{ $project->expected_end_date ?? '' }}">
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-select" id="status" name="status">
                <option value="Active" {{ $project->status == 'Active' ? 'selected' : '' }}>Active</option>
                <option value="Inactive" {{ $project->status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                <option value="Completed" {{ $project->status == 'Completed' ? 'selected' : '' }}>Completed</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
    @endif
</div>


<div class="container mt-4">
    <button id="showTaskFormButton" class="btn btn-primary">Create Task</button>



    <div id="taskForm" style="display: none">
        <form action="{{ route('createTask') }}" method="POST">
            @csrf

            <input type="hidden" name="project_id" value="{{ $project->id }}">

            <input type="hidden" name="admin_id" value="{{ auth()->user()->admin->id }}">

            <div class="mb-3">
                <label for="task_title" class="form-label">Task Title</label>
                <input type="text" name="task_title" id="task_title" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="task_description" class="form-label">Task Description</label>
                <textarea name="task_description" id="task_description" class="form-control" rows="3"></textarea>
            </div>

            <div class="mb-3">
                <label for="task_objectives" class="form-label">Task Objectives</label>
                <textarea name="task_objectives" id="task_objectives" class="form-control" rows="3"></textarea>
            </div>

            <div class="mb-3">
                <label for="creation_date" class="form-label">Creation Date</label>
                <input type="date" name="creation_date" id="creation_date" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="deadline" class="form-label">Deadline</label>
                <input type="date" name="deadline" id="deadline" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-select">
                    <option value="Not Started">Not Started</option>
                    <option value="In Progress">In Progress</option>
                    <option value="Completed">Completed</option>
                    <option value="Paused">Paused</option>
                    <option value="Cancelled">Cancelled</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="priority" class="form-label">Priority</label>
                <select name="priority" id="priority" class="form-select">
                    <option value="High">High</option>
                    <option value="Medium">Medium</option>
                    <option value="Low">Low</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="progress" class="form-label">Progress (%)</label>
                <input type="number" name="progress" id="progress" class="form-control" min="0" max="100" step="1">
            </div>

            <button type="submit" class="btn btn-success">Create</button>
        </form>

    </div>
</div>



<div class="container mt-5">

    <button id="addPeopleButton" class="btn btn-primary my-3">Add People</button>


    <div class="my-3" id="addPeopleForm" style="display: none;">
        <form action="{{ route('addPeople') }}" id="addPeopleForm" method="post">
            @csrf
            <input type="hidden" name="project_id" value="{{ $project->id }}">
            <div class="mb-3">
                <label for="userIdentifier">Enter Email or Username:</label>
                <input type="text" id="userIdentifier" name="userIdentifier" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Add User</button>
        </form>

    </div>



    @if(isset($project) && !empty($project))
    <div class="card">
        <div class="card-header">
            Project Details
        </div>
        <div class="card-body">
            <h5 class="card-title">{{ $project->title }}</h5>
            <p class="card-text"> <strong>Created By:</strong> {{ $project->admin ? $project->admin->user->name : 'Unknown' }} </p>
            <p class="card-text"><strong>Description:</strong> {{ $project->description }}</p>
            <p class="card-text"><strong>Start Date:</strong> {{ $project->start_date }}</p>
            <p class="card-text"><strong>Expected End Date:</strong> {{ $project->expected_end_date }}</p>
            <p class="card-text"><strong>Status:</strong> {{ $project->status }}</p>
        </div>

        <div class="container mt-4 my-3">
            <h4>People added to this project:</h4>
            <ul class="list-group">
                @foreach($project->project_mates as $mate)
                <li class="list-group-item">
                    {{ $mate->user->name }}
                    <a href="{{ route('viewUserProfile', ['id' => $mate->user->id]) }}" class="btn btn-primary btn-sm float-end ms-4">View User Profile</a>
                    <a href="#" class="btn btn-danger btn-sm float-end remove-mate-button" data-removal-url="{{ route('removeProjectMate', ['projectMate' => $mate->id]) }}">
                        Remove from Project
                    </a>
                </li>
                @endforeach
            </ul>
        </div>

        <div class="container mt-4 my-3">

            <ul class="list-group">
                <h4>Tasks for this project:</h4>
                @foreach ($project->tasks as $task)
                <li class="list-group-item">
                    <h5>Task ID: {{ $task->id }}</h5>
                    <p><strong>Task Title:</strong> {{ $task->task_title }}</p>
                    <p><strong>Deadline:</strong> {{ $task->deadline }}</p>
                    <p><strong>Status:</strong> {{ $task->status }}</p>
                    <a href="{{ route('showTaskAdmin', ['taskId' => $task->id]) }}" class="btn btn-primary">View Task</a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
    @else
    <p>No project data available.</p>
    @endif
</div>

<div class="container mt-4 my-3">
     <!-- Button to toggle project history -->
     <button id="toggleProjectHistory" class="btn btn-primary mt-3">View Project History</button>

<!-- Bootstrap table for project history -->
<table id="projectHistoryTable" class="table table-bordered table-striped mt-3" style="display: none;">
    <thead>
        <tr>
            <th>Project Title</th>
            <th>User Involved</th>
            <th>Action</th>
            <th>Action Date</th>
            <th>User Assignment Date</th>
            <th>On authority of</th>
            <!-- Add more table headers as needed -->
        </tr>
    </thead>
    <tbody>
        @foreach ($project->project_history as $history)
            <tr>
                <td> {{ $history->project->title }} </td>
                <td> {{ $history->user->name }} </td>
                <td>{{ $history->action }}</td>
                <td>{{ $history->action_date }}</td>
                <td>{{ $history->user_assignment_date }}</td>
                <td>{{ $history->admin->user->name }}</td>
                <!-- Add more table data columns as needed -->
            </tr>
        @endforeach
    </tbody>
</table>
</div>
<script src="{{ asset('js/admin.js') }}"></script>
<script src="{{ asset('js/adminProjects.js') }}"></script>
@endsection
