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
    @if (isset($userProfile) && $userProfile)

    <div class="card">
        <div class="card-header">
            Your Profile
            <button id="editProfileBtn" class="btn btn-success">Edit Profile</button>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('updateProfile') }}" id="editProfileForm" class="my-4" enctype="multipart/form-data" style="display: none;">
                @csrf
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">


                <div class="mb-3">
                    <label for="profile_picture" class="form-label">Profile Picture:</label>
                    <input type="file" name="profile_picture" id="profile_picture" class="form-control" accept="image/jpeg, image/png, image/jpg, image/gif">
                </div>


                <div class="mb-3">
                    <label for="street_address" class="form-label">Street Address:</label>
                    <input type="text" name="street_address" id="street_address" class="form-control"  value="{{ optional(json_decode($userProfile->full_address))->street_address ?? '' }}">
                </div>


                <div class="mb-3">
                    <label for="city" class="form-label">City:</label>
                    <input type="text" name="city" id="city" class="form-control" value="{{ optional(json_decode($userProfile->full_address))->city ?? '' }}">
                </div>


                <div class="mb-3">
                    <label for="state" class="form-label">State:</label>
                    <input type="text" name="state" id="state" class="form-control" value="{{ optional(json_decode($userProfile->full_address))->state ?? '' }}">
                </div>


                <div class="mb-3">
                    <label for="country" class="form-label">Country:</label>
                    <input type="text" name="country" id="country" class="form-control" value="{{ optional(json_decode($userProfile->full_address))->country ?? '' }}">
                </div>


                <div class="mb-3">
                    <label for="pin_code" class="form-label">Pin Code:</label>
                    <input type="text" name="pin_code" id="pin_code" class="form-control" value="{{ optional(json_decode($userProfile->full_address))->pin_code ?? '' }}">
                </div>


                <div class="mb-3">
                    <label for="date_of_birth" class="form-label">Date of Birth:</label>
                    <input type="date" name="date_of_birth" id="date_of_birth" class="form-control" value="{{ $userProfile->date_of_birth ?? '' }}">
                </div>


                <div class="mb-3">
                    <label for="qualification" class="form-label">Qualification:</label>
                    <input type="text" name="qualification" id="qualification" class="form-control" value="{{ $userProfile->qualification ?? '' }}">
                </div>


                <div class="mb-3">
                    <label for="designation" class="form-label">Designation:</label>
                    <input type="text" name="designation" id="designation" class="form-control" value="{{ $userProfile->designation ?? '' }}">
                </div>


                <div class="mb-3">
                    <label for="skills" class="form-label">Skills: (separated by comma and whitespace)</label>
                    <input type="text" name="skills" id="skills" class="form-control" value="{{ implode(', ', json_decode($userProfile->skills ?? '[]')) }}">
                </div>


                <div class="mb-3">
                    <label for="status" class="form-label">Status:</label>
                    <select name="status" id="status" class="form-select">
                        <option value="Active" {{ isset($userProfile) && $userProfile->status == 'Active' ? 'selected' : '' }}>Active</option>
                        <option value="Inactive" {{ isset($userProfile) && $userProfile->status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                        <option value="OnLeave" {{ isset($userProfile) && $userProfile->status == 'OnLeave' ? 'selected' : '' }}>On Leave</option>
                        <option value="Suspended" {{ isset($userProfile) && $userProfile->status == 'Suspended' ? 'selected' : '' }}>Suspended</option>
                        <option value="Terminated" {{ isset($userProfile) && $userProfile->status == 'Terminated' ? 'selected' : '' }}>Terminated</option>
                    </select>
                </div>


                <div class="mb-3">
                    <label for="salary" class="form-label">Salary:</label>
                    <input type="number" name="salary" id="salary" class="form-control" value="{{ $userProfile->salary ?? '' }}">
                </div>

                <button type="submit" class="btn btn-primary">Update Profile</button>
            </form>

            <div class="row">
                <div class="col-md-6">
                    <img src="{{ asset('storage/' . $userProfile->profile_picture) }}" class="img-fluid rounded" alt="Profile Picture">
                </div>
                <div class="col-md-6">
                    <p><strong>Name:</strong> {{ auth()->user()->name }}</p>
                    <p><strong>Date of Birth:</strong> {{ $userProfile->date_of_birth }}</p>
                    <p><strong>Qualification:</strong> {{ $userProfile->qualification }}</p>
                    <p><strong>Designation:</strong> {{ $userProfile->designation }}</p>
                    <p><strong>Full Address:</strong></p>
                    <ul>
                        @foreach(json_decode($userProfile->full_address) as $key => $value)
                        <li><strong>{{ ucfirst($key) }}:</strong> {{ $value }}</li>
                        @endforeach
                    </ul>

                    <p><strong>Skills:</strong></p>
                    <ul>
                        @foreach(json_decode($userProfile->skills) as $skill)
                        <li>{{ $skill }}</li>
                        @endforeach
                    </ul>

                    <p><strong>Status:</strong> {{ $userProfile->status }}</p>
                    <p><strong>Salary:</strong> {{ $userProfile->salary }} LPA </p>

                </div>
            </div>
        </div>
    </div>
    @else

    <div class="alert alert-info">
        You have not maintained a profile.
    </div>
    <button id="showProfileFormButton" class="btn btn-primary">Create Profile</button>

    <div id="profileCreationForm" style="display: none;">
        <div class="container mt-4">
            <h2>Create Profile</h2>
            <form method="POST" action="{{ route('createProfile') }}" id="createProfileForm" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                <div class="mb-3">
                    <label for="profile_picture" class="form-label">Profile Picture:</label>
                    <input type="file" name="profile_picture" id="profile_picture" class="form-control" accept="image/jpeg, image/png, image/jpg, image/gif">
                </div>

                <div class="mb-3">
                    <label for="street_address" class="form-label">Street Address:</label>
                    <input type="text" name="street_address" id="street_address" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="city" class="form-label">City:</label>
                    <input type="text" name="city" id="city" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="state" class="form-label">State:</label>
                    <input type="text" name="state" id="state" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="country" class="form-label">Country:</label>
                    <input type="text" name="country" id="country" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="pin_code" class="form-label">Pin Code:</label>
                    <input type="text" name="pin_code" id="pin_code" class="form-control">
                </div>


                <div class="mb-3">
                    <label for="date_of_birth" class="form-label">Date of Birth:</label>
                    <input type="date" name="date_of_birth" id="date_of_birth" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="qualification" class="form-label">Qualification:</label>
                    <input type="text" name="qualification" id="qualification" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="designation" class="form-label">Designation:</label>
                    <input type="text" name="designation" id="designation" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="skills" class="form-label">Skills: (separated by comma and whitespace)</label>
                    <input type="text" name="skills" id="skills" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status:</label>
                    <select name="status" id="status" class="form-select">
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                        <option value="OnLeave">On Leave</option>
                        <option value="Suspended">Suspended</option>
                        <option value="Terminated">Terminated</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="salary" class="form-label">Salary:</label>
                    <input type="number" name="salary" id="salary" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary">Create Profile</button>
            </form>
        </div>

    </div>
    @endif
</div>
@endsection
