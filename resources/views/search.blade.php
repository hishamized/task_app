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
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Search Users</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('searchUsers') }}">
                        @csrf

                        <div class="form-group">
                            <label for="search_input">Search:</label>
                            <input type="text" id="search" name="search_input" class="form-control" placeholder="Enter your search query">
                        </div>

                        <div class="form-group my-2">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mt-5">
        <h2>Search Results</h2>

        @if(count($matchedUsers) > 0)
            <ul class="list-group">
                @foreach($matchedUsers as $user)
                    <li class="list-group-item">
                        <h4>{{ $user->name }}</h4>
                        <p>Email: {{ $user->email }}</p>
                        <p>Username: {{ $user->username }}</p>
                        <!-- You can add more user attributes here -->
                        <a href="{{ route('viewUserProfile', ['id' => $user->id]) }}" class="btn btn-primary btn-sm float-end">View Profile</a>
                    </li>
                @endforeach
            </ul>
        @else
            <p>No users found matching your search.</p>
        @endif
    </div>
@endsection
