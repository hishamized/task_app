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

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
            <div class="position-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="#section1">Create New Project</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#section2">My Projects</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#section3">Section 3</a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Content Section -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <h2>Welcome to the Admin Dashboard</h2>

            <div id="section1" class="section-content">
                <div class="container mt-5">
                    <h2>Create Project</h2>
                    <form action="{{ route('projects.store') }}" method="POST">
                        @csrf

                        <!-- Project Title -->
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>

                        <!-- Project Description -->
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="4"></textarea>
                        </div>

                        <!-- Project Start Date -->
                        <div class="mb-3">
                            <label for="start_date" class="form-label">Start Date</label>
                            <input type="date" class="form-control" id="start_date" name="start_date" required>
                        </div>

                        <!-- Project Expected End Date -->
                        <div class="mb-3">
                            <label for="expected_end_date" class="form-label">Expected End Date</label>
                            <input type="date" class="form-control" id="expected_end_date" name="expected_end_date" required>
                        </div>

                        <!-- Project Status (with Default Value "Active") -->
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status">
                                <option value="Active" selected>Active</option>
                                <option value="Inactive">Inactive</option>
                                <option value="Completed">Completed</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Create Project</button>
                    </form>
                </div>
            </div>
            <div id="section2" class="section-content">
                <div class="container mt-5">
                    @if(isset($adminProjects) && $adminProjects->count() > 0)
                    <h2>Projects Created by {{ auth()->user()->name }} (Admin)</h2>
                    <ul class="list-group">
                        @foreach($adminProjects as $project)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $project->title }}
                            <a href="{{ route('project.view', ['id' => $project->id]) }}" class="btn btn-primary btn-sm">View Project</a>
                        </li>
                        @endforeach
                    </ul>
                    @else
                    <p>No projects created by this admin.</p>
                    @endif
                </div>

            </div>
            <div id="section3" class="section-content">
                <h1>Section 3 Content</h1>
            </div>
        </main>
    </div>
</div>
<script src="{{ asset('js/admin.js') }}"></script>
@endsection
