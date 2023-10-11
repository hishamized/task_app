@extends('layout.app')
@section('content')
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
                            <a class="nav-link active sidebar-link" data-section="section1">Assigned Task</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link sidebar-link" data-section="section2">My Projects</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link sidebar-link" data-section="section3">Important Tasks</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link sidebar-link" data-section="section4">Update Tasks</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link sidebar-link" data-section="section5">Apply Leave</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link sidebar-link" data-section="section6">View Leave Status</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link sidebar-link" data-section="section7">Employees Rewards and Scores</a>
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
                    <h1>Section 5 Content</h1>
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



