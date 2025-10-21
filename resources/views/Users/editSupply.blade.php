@extends('layouts.app')
@section('title', 'Add Quantity')

@section('content')
<h2>Add Quantity to {{ $supply->name }}</h2>

<form method="POST" action="{{ route('supplies.updateQuantity', $supply->id) }}">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="quantity">Quantity to Add</label>
        <input type="number" name="quantity" class="form-control" min="1" required>
    </div>
    <button type="submit" class="btn-primary">Update</button>
</form>
@endsection