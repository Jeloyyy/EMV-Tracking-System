@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <h1>Welcome, {{ Auth::user()->full_name }}</h1>
@endsection


