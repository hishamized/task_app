@extends('layout.app')

@section('content')

<div class="container mt-4">
    <h2>Login</h2>
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

    <form method="POST" action="{{ route('login') }}" id="login-form">
        @csrf
        <div class="mb-3">
            <label for="login_credential" class="form-label">Email or Username:</label>
            <input type="text" name="login_credential" id="login_credential" class="form-control" required>
        </div>


        <div class="mb-3">
            <label for="password" class="form-label">Password:</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Login</button>
    </form>
    <a href="{{ route('password.reset') }}" class="btn btn-danger">Reset Password</a>
</div>

@endsection
