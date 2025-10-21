@extends('layouts.app')
@section('title', 'Add Supplies')

@section('content')
<h1>Add Supplies</h1>

<form method="POST" action="{{ route('supplies.store') }}">
    @csrf
    <div>
        <label class="form-label">Name</label>
        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
        @error('name') <div class="text-danger">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control">{{ old('description') }}</textarea>
        @error('description') <div class="text-danger">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
        <label class="form-label">Quantity</label>
        <input type="number" name="quantity" class="form-control" value="{{ old('quantity', 0) }}" required>
        @error('quantity') <div class="text-danger">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
        <label class="form-label">Price</label>
        <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price', 0) }}" required>
        @error('price') <div class="text-danger">{{ $message }}</div> @enderror
    </div>
    <button type="submit" class="add-btn">Add</button>
</form>
@endsection
