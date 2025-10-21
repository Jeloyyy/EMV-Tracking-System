@extends('def.app')
@section('title', 'E.M. Villanueva Resort')

@section('content')
<div class="landing-container">
    <img src="{{ asset('images/resort_logo.png') }}" alt="Resort Logo"style="width:150px; height:auto;">
    <h1>E.M. Villanueva Resort</h1>
    <h2>Welcome to our Resort Management System</h2>
    <p>Manage your resort operations efficiently and effectively.</p>
    <button class="btn btn-primary" onclick="window.location='{{ route('login') }}'">Enter</button>
</div>
@endsection