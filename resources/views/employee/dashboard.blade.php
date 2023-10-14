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
<div class="container">
    <h2>Welcome to Your Dashboard</h2>
</div>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
            <div class="position-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a href="#" class="nav-link active sidebar-link" data-section="section1">
                            <i class="bi bi-house-door"></i> My Projects
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link sidebar-link" data-section="section2">
                            <i class="bi bi-list-task"></i> My Tasks
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link sidebar-link" data-section="section3">
                            <i class="bi bi-exclamation-triangle"></i> Important Tasks
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link sidebar-link" data-section="section5">
                            <i class="bi bi-calendar-plus"></i> Apply For Leave
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link sidebar-link" data-section="section6">
                            <i class="bi bi-journal-text"></i> My Leave Applications
                        </a>
                    </li>
                </ul>
            </div>
        </nav>


        <!-- Content Section -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <h2>Welcome to the Employee Dashboard</h2>

            <div id="section1" class="section-content">
                <!-- Display Projects -->
                <div class="card">
                    <div class="card-header">Projects</div>
                    <div class="card-body">
                        @if(count($projects) > 0)
                        <ul class="list-group">
                            @foreach($projects as $project)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $project->title }}
                                <a href="{{ route('project.show', ['id' => $project->id]) }}" class="btn btn-primary">View Project</a>
                            </li>
                            @endforeach
                        </ul>
                        @else
                        <p>No projects found.</p>
                        @endif

                    </div>
                </div>
            </div>
            <div id="section2" class="section-content">
                <!-- Display Assigned Tasks -->
                <div class="container mt-4">
                    <h1>Your Assigned Tasks</h1>
                    <ul class="list-group">
                        @forelse($tasks as $task)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $task->task_title }}
                            <a href="{{ route('viewTask', ['id' => $task->id]) }}" class="btn btn-primary">View Task</a>
                        </li>
                        @empty
                        <li class="list-group-item">No tasks assigned</li>
                        @endforelse
                    </ul>
                </div>


            </div>
            <div id="section3" class="section-content">
                <h2>High Priority Tasks</h2>
                <ul class="list-group">
                    @foreach ($tasks as $task)
                    @if ($task->priority === 'High')
                    <li class="list-group-item">
                        {{ $task->task_title }}
                        <a href="{{ route('viewTask', ['id' => $task->id]) }}" class="btn btn-primary btn-sm float-end">View Task</a>
                    </li>
                    @endif
                    <p>No further high priority tasks for you right now.</p>
                    @endforeach
                </ul>
            </div>
            <div id="section4" class="section-content">
                <h1>Section 4 Content</h1>
            </div>
            <div id="section5" class="section-content">
                <div class="container mt-4">
                    <div class="card">
                        <div class="card-header">
                            Leave Application
                        </div>
                        <div class="card-body">
                            <form action="{{ route('submitLeaveApplication') }}" method="POST">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                <div class="mb-3">
                                    <label for="start_date" class="form-label">Start Date:</label>
                                    <input type="date" name="start_date" id="start_date" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="end_date" class="form-label">End Date:</label>
                                    <input type="date" name="end_date" id="end_date" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="subject" class="form-label">Subject:</label>
                                    <input type="text" name="subject" id="subject" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="reason" class="form-label">Reason for Leave:</label>
                                    <textarea name="reason" id="reason" class="form-control" rows="4"></textarea>
                                </div>
                                <input type="hidden" name="status" value="Pending">

                                <button type="submit" class="btn btn-primary">Submit Leave Application</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div id="section6" class="section-content">
                <div class="card mt-4">
                    <div class="card-header">Leave Applications</div>
                    <div class="card-body">
                        @if(count($leaves) > 0)
                        <ul class="list-group list-group-flush">
                            @foreach($leaves as $leaveApp)
                            <li class="list-group-item d-flex justify-content-between align-items-center @if($leaveApp->status === 'Rejected') bg-danger text-white @elseif($leaveApp->status === 'Approved') bg-success text-white @else bg-warning @endif">
                                <span>{{ $leaveApp->subject }}</span>
                                <div>
                                    <strong>Submitted/Updated at:</strong> <span>{{ $leaveApp->updated_at->toDateString() }}</span>
                                </div>
                                <a href="{{ route('viewLeaveApplication', ['id' => $leaveApp->id]) }}" class="btn btn-primary btn-sm">View Application</a>
                            </li>
                            @endforeach
                        </ul>
                        @else
                        <p>No leave applications found.</p>
                        @endif
                    </div>
                </div>



            </div>
        </main>
    </div>
</div>
<script src="{{ asset('js/employee.js') }}"></script>
@endsection
