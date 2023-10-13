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
<div class="container">
    <h1>Task Details</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $task->task_title }}</h5>
            <p class="card-text"><strong>Project:</strong> {{ $task->project->title }}</p>
            <p class="card-text"><strong>Admin:</strong> {{ $task->admin->user->name }}</p>
            <p class="card-text"><strong>Task Description:</strong> {{ $task->task_description }}</p>
            <p class="card-text"><strong>Task Objectives:</strong> {{ $task->task_objectives }}</p>
            <p class="card-text"><strong>Creation Date:</strong> {{ $task->creation_date }}</p>
            <p class="card-text"><strong>Deadline:</strong> {{ $task->deadline }}</p>
            <p class="card-text"><strong>Status:</strong> {{ $task->status }}</p>
            <p class="card-text"><strong>Priority:</strong> {{ $task->priority }}</p>
            <p class="card-text"><strong>Progress:</strong> {{ $task->progress }}%</p>

            <a href="{{ route('project.view', ['id' => $task->project->id]) }}" class="btn btn-secondary">View Project</a>
            <a href="{{ route('show_dashboard') }}" class="btn btn-primary">Back to Dashboard</a>
        </div>
    </div>
</div>
@endsection
