@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
<div class="edit-wrapper">
    <div class="edit-card">
        <h2>EDIT USER PROFILE</h2>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
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
        <form action="{{ route('users.update', $users->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="edit-row">
                <div>
                    <label class="form-label">First Name</label>
                    <input type="text" name="first_name" class="form-control" value="{{ old('first_name', $users->first_name) }}" required>
                </div>
                <div>
                    <label class="form-label">Middle Name</label>
                    <input type="text" name="middle_name" class="form-control" value="{{ old('middle_name', $users->middle_name) }}">
                </div>
                <div>
                    <label class="form-label">Last Name</label>
                    <input type="text" name="last_name" class="form-control" value="{{ old('last_name', $users->last_name) }}" required>
                </div>
                <div>
                    <label class="form-label">Extension Name</label>
                    <input type="text" name="ext_name" class="form-control" value="{{ old('ext_name', $users->ext_name) }}">
                </div>

                <div>
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $users->email) }}" required>
                </div>
                <div>
                    <label class="form-label">Role</label>
                    <select name="role" class="form-select" required>
                        <option value="admin" {{ $users->role === 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="user" {{ $users->role === 'user' ? 'selected' : '' }}>User</option>
                    </select>
                </div>
                <div>
                    <label class="form-label">Department</label>
                    <select name="department_id" class="form-select">
                        <option value="">-- Select Department --</option>
                        @foreach($departments as $dept)
                            <option value="{{ $dept->id }}" {{ $users->department_id == $dept->id ? 'selected' : '' }}>
                                {{ $dept->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="form-label">Status</label>
                    <select name="stat" class="form-select" required>
                        <option value="1" {{ $users->stat ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ !$users->stat ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
            </div>

            <div class="button-row">
                <button class="btn btn-primary" type="submit" >Update</button>
                <a href="{{ route('users.resortStaffs') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
