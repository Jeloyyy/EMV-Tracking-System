@extends('layouts.app')
@section('title', 'Request Supply')

@section('content')
<h1>Request Supply</h1>
<form method="POST" action="{{ route('supply.request') }}">
    @csrf
    <div>
        <label for="item_name">Item Name:</label>
        <input type="text" id="item_name" name="item_name" required>
    </div>
    <div>
        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" required min="1">
    </div>
    <div>
        <label for="reason">Reason for Request:</label>
        <textarea id="reason" name="reason" required></textarea>
    </div>
    <button type="submit">Submit Request</button>
</form>
@endsection