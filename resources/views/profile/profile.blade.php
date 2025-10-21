@extends('layouts.app')

@section('content')
<div class="container profile-container">
    <div class="card profile-card">
        <div class="card-header">
            <h3>Profile</h3>
        </div>
        <div class="profile-body">
            <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}"
                alt="Profile Photo"
                class="profile-photo">
            <h4>
                {{ Auth::user()->first_name }}
                {{ Auth::user()->middle_name ? Auth::user()->middle_name : '' }}
                {{ Auth::user()->last_name }}
                {{ Auth::user()->ext_name ? ', ' . Auth::user()->ext_name : '' }}
            </h4>

            <p>{{ Auth::user()->email }}</p>

            <span class="badge-{{ Auth::user()->role === 'admin' ? 'active' : 'inactive' }}">
                {{ ucfirst(Auth::user()->role) }}
            </span>

            <span class="badge-{{ Auth::user()->stat ? 'active' : 'inactive' }}">
                {{ Auth::user()->stat ? 'Active' : 'Inactive' }}
            </span>

            <p>
                Department: 
                <strong>{{ Auth::user()->department ? Auth::user()->department->name : 'Unassigned' }}</strong>
            </p>

            <p>Last Login: 
                <strong>
					{{ Auth::user()->last_login 
						? \Carbon\Carbon::parse(Auth::user()->last_login)->format('M d, Y h:i A') 
						: 'Never logged in' }}
				</strong>

            </p>

            <a href="{{ route('profile.edit') }}" class="btn-secondary">
                Edit Profile
            </a>
        </div>
    </div>
</div>
@endsection
