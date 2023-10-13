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
<div class="container mt-4">
    <h2>Login</h2>
    <form method="POST" action="{{ route('login') }}" id="login-form">
        @csrf
        <div class="mb-3">
            <label for="login_credential" class="form-label">Email or Username:</label>
            <input type="text" name="login_credential" id="login_credential" class="form-control" required>
        </div>


        <div class="mb-3">
            <label for="password" class="form-label">Password:</label>
            <div class="input-group">
                <input type="password" name="password" id="password" class="form-control" required>
                <button type="button" id="showPassword" class="btn btn-secondary">Show</button>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Login</button>
    </form>
    <div class="my-3">
        <a href="{{ route('password.reset') }}" class="btn btn-danger">Reset Password</a>
    </div>
</div>


<script>
    const passwordField = document.getElementById('password');
    const showPasswordButton = document.getElementById('showPassword');

    showPasswordButton.addEventListener('click', () => {
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            showPasswordButton.textContent = 'Hide';
        } else {
            passwordField.type = 'password';
            showPasswordButton.textContent = 'Show';
        }
    });
</script>


@endsection
