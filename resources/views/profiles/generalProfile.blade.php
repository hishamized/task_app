@extends('layout.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card">
                <div class="card-header">
                    User Profile
                </div>
                <div class="card-body">
                    <div class="text-center">
                        @if ($user->profile)
                        <img src="{{ $user->profile->profile_picture ? asset('storage/' . $user->profile->profile_picture) : asset('storage/sample_pictures/placeholder-image.webp') }}" alt="Profile Picture" class="img-thumbnail">

                        @else
                        <img src="{{ asset('storage/sample_pictures/placeholder-image.webp') }}" alt="Profile Picture" class="img-thumbnail">
                        @endif
                    </div>
                    <h5 class="card-title">{{ $user->name }}</h5>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Username</h6>
                            <p>{{ $user->username }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6>Email</h6>
                            <p>{{ $user->email }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Phone Number</h6>
                            <p>{{ $user->phone_country_code }} {{ $user->phone_number }}</p>
                        </div>
                        @if ($user->profile)
                        <div class="col-md-6">
                            <h6>Date of Birth</h6>
                            <p>{{ $user->profile->date_of_birth }}</p>
                        </div>
                        @endif
                    </div>
                    @if ($user->profile)
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Qualification</h6>
                            <p>{{ $user->profile->qualification }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6>Designation</h6>
                            <p>{{ $user->profile->designation }}</p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            Skills
                        </div>
                        <div class="card-body">
                            @php
                            $skills = json_decode($user->profile->skills);
                            @endphp
                            <ul class="list-group">
                                @if (is_array($skills))
                                @foreach ($skills as $skill)
                                <li class="list-group-item">{{ $skill }}</li>
                                @endforeach
                                @else
                                <li class="list-group-item">No skills specified.</li>
                                @endif
                            </ul>
                        </div>
                    </div>

                    <h6>Status</h6>
                    <p>{{ $user->profile->status }}</p>
                    <h6>Salary</h6>
                    <p>{{ $user->profile->salary }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
