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
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Project Details
                </div>
                <div class="card-body">
                    <h2>{{ $project->title }}</h2>
                    <p><Strong>Project Administrator:</Strong> {{ $project->admin->user->name }} </p>
                    <p><strong>Description:</strong> {{ $project->description ?? 'N/A' }}</p>
                    <p><strong>Start Date:</strong> {{ $project->start_date }}</p>
                    <p><strong>Expected End Date:</strong> {{ $project->expected_end_date }}</p>
                    <p><strong>Status:</strong> {{ $project->status }}</p>

                    <a href="{{ route('home') }}" class="btn btn-primary">Home</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
