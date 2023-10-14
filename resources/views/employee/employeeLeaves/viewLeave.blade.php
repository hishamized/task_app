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
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header">Leave Application Details</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $leave->subject }}</h5>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Start Date</h6>
                            <p>{{ $leave->start_date }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6>End Date</h6>
                            <p>{{ $leave->end_date }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h6>Reason</h6>
                            <p>{{ $leave->reason }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Status</h6>
                            <p>{{ $leave->status }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6>Submitted Date</h6>
                            <p>{{ $leave->created_at }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @if($leave->status === 'Pending')
            <button class="btn btn-primary btn-sm leave-edit-button my-2">Edit Application</button>
            @else
            <span class="text-muted">This application cannot be edited because it has been reviewed.</span>
            @endif
            <form  method="POST" action="{{ route('leave.update', ['id' => $leave->id]) }}" class="leave-edit-form" style="display: none;">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="subject" class="form-label">Subject</label>
                    <input type="text" class="form-control" id="subject" name="subject" value="{{ $leave->subject }}">
                </div>

                <div class="mb-3">
                    <label for="start_date" class="form-label">Start Date</label>
                    <input type="date" class="form-control" id="start_date" name="start_date" value="{{ $leave->start_date }}">
                </div>

                <div class="mb-3">
                    <label for="end_date" class="form-label">End Date</label>
                    <input type="date" class="form-control" id="end_date" name="end_date" value="{{ $leave->end_date }}">
                </div>

                <div class="mb-3">
                    <label for="reason" class="form-label">Reason</label>
                    <textarea class="form-control" id="reason" name="reason">{{ $leave->reason }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <input type="text" class="form-control" id="status" name="status" value="{{ $leave->status }}" readonly>
                </div>

                <button type="submit" class="btn btn-primary btn-sm">Save Changes</button>
            </form>


        </div>
    </div>
</div>
<script src="{{ asset('js/employee.js') }}"></script>
@endsection
