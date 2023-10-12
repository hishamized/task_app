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
                            <a href="#" class="nav-link active sidebar-link" data-section="section1">Assigned Task</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link sidebar-link" data-section="section2">My Projects</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link sidebar-link" data-section="section3">Important Tasks</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link sidebar-link" data-section="section4">Update Tasks</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link sidebar-link" data-section="section5">Apply Leave</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link sidebar-link" data-section="section6">View Leave Status</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link sidebar-link" data-section="section7">Employees Rewards and Scores</a>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- Content Section -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <h2>Welcome to the Employee Dashboard</h2>

                <div id="section1" class="section-content">
                    <h1>Section 1 Content</h1>
                </div>
                <div id="section2" class="section-content">
                    <h1>Section 2 Content</h1>
                </div>
                <div id="section3" class="section-content">
                    <h1>Section 3 Content</h1>
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
                <div class="mb-3">
                    <label for="status" class="form-label">Status:</label>
                    <select name="status" id="status" class="form-select">
                        <option value="Pending">Pending</option>
                        <option value="Approved">Approved</option>
                        <option value="Rejected">Rejected</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Submit Leave Application</button>
            </form>
        </div>
    </div>
</div>
                </div>
                <div id="section6" class="section-content">
                    <h1>Section 6 Content</h1>
                </div>
                <div id="section7" class="section-content">
                    <h1>Section 7 Content</h1>
                </div>
            </main>
        </div>
    </div>
    <script src="{{ asset('js/employee.js') }}"></script>
@endsection
