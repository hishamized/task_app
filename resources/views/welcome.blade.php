@extends('layout.app')

@section('title', 'Welcome Page')

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
<div class="container mt-4">
    <h1>Welcome to the Task App</h1>
    <p>This is the Home page content.</p>
</div>
@auth
@if(auth()->user()->isAdmin())
<div class="container mt-4">
<a href="{{ route('showAdminDashboard') }}" class="btn btn-primary">Admin Dashboard</a>
</div>
@endif
@endauth

@endsection
