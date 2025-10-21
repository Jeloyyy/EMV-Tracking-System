@extends('layouts.app')
@section('title', 'Employee Information')

@section('content')
<h1>EMPLOYEE INFORMATION</h1>

<form method="GET" action="{{ route('users.resortStaffsTable') }}">
    <input type="text" name="search" class="form-control search" placeholder="Search ..." value="{{ request('search') }}">
    <button type="submit" class="add-btn">Search</button>
</form>

<div>
    <div class="card-body">
    <table class="table">
        <thead>
            <tr>
                <th scope="col" class="idto"> </th>
                <th scope="col">Fullname</th>
                <th scope="col">Email</th>
                <th scope="col">Department</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $resortStaffs => $user)
            <tr>
                <td class="idto">{{ $resortStaffs + 1 }}</td>
                <td>{{ ucwords($user->full_name)}}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->department ? $user->department->name : 'N/A' }}</td>
                <td>
                    @if($user->stat == '1')
                        <span class="badge-active">Active</span>
                    @else
                        <span class="badge-inactive">Inactive</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7">No users found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    </div>
</div>
@endsection
