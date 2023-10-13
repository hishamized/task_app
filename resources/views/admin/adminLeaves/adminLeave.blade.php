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
    <h2>Leave Application Details</h2>

    <table class="table">
        <tbody>
            <tr>
                <th>Leave ID</th>
                <td>{{ $leave->id }}</td>
            </tr>
            <tr>
                <th>User</th>
                <td>{{ $leave->user->name }}</td>
            </tr>
            <tr>
                <th>Start Date</th>
                <td>{{ $leave->start_date }}</td>
            </tr>
            <tr>
                <th>End Date</th>
                <td>{{ $leave->end_date }}</td>
            </tr>
            <tr>
                <th>Subject</th>
                <td>{{ $leave->subject }}</td>
            </tr>
            <tr>
                <th>Reason</th>
                <td>{{ $leave->reason }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>{{ $leave->status }}</td>
            </tr>
            <tr>
                <th>Change Status</th>
                <td>
                    <form action="{{ route('adminLeaveChangeStatus', ['id' => $leave->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group my-3">
                            <select name="status" class="form-control">
                                <option value="Approved">Approved</option>
                                <option value="Pending">Pending</option>
                                <option value="Rejected">Rejected</option>
                            </select>
                        </div>
                        <div class="my-3">
                        <button type="submit" class="btn btn-primary">Change Status</button>
                        </div>
                    </form>
                </td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
