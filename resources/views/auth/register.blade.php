@extends('layouts.def')

@section('content')
<div class="register-wrapper">
    <div class="register-card">
        <h4 class="register-title">Create Your Account</h4>
    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="department_id" class="form-label">Department</label>
                <select id="department_id" name="department_id" class="form-control" required>
                    <option value="" disabled {{ old('department_id') ? '' : 'selected' }}>-- Select Department --</option>
                    @foreach(\App\Models\Department::all() as $dept)
                        <option value="{{ $dept->id }}" {{ old('department_id') == $dept->id ? 'selected' : '' }}>
                            {{ $dept->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="first_name" class="form-label">First Name</label>
                <input id="first_name" type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" required>
            </div>

            <div class="form-group">
                <label for="middle_name" class="form-label">Middle Name</label>
                <input id="middle_name" type="text" class="form-control" name="middle_name" value="{{ old('middle_name') }}">
            </div>

            <div class="form-group">
                <label for="last_name" class="form-label">Last Name</label>
                <input id="last_name" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" required>
            </div>

            <div class="form-group">
                <label for="ext_name" class="form-label">Extension Name</label>
                <input id="ext_name" type="text" class="form-control" name="ext_name" value="{{ old('ext_name') }}">
            </div>

            <div class="form-group">
                <label for="email" class="form-label">Email Address</label>
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input id="password" type="password" class="form-control" name="password" required>
            </div>

            <div class="form-group">
                <label for="password-confirm" class="form-label">Confirm Password</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
            </div>

            <div class="form-group">
                <label for="profile_photo" class="form-label">Profile Photo (Optional)</label>
                <input id="profile_photo" type="file" class="form-control" name="profile_photo" accept="image/*">
            </div>
            
            <button type="submit" class="btn btn-primary sub-btn">Register</button>
        </form>
    </div>
</div>
@endsection
