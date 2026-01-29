@extends('layouts.app')
@section('title', 'Request Supply')

@section('content')
<div class="edit-wrapper">
    <div class="edit-card">
        <h2 class="text-center mb-4">Request Supply</h2>
        <form method="POST" action="{{ route('supply.request.submit') }}">
            @csrf
            <div class="edit-row">
                <div class="col-md-6">
                    <label for="item_name" class="form-label">Item Name</label>
                    <input type="text" id="item_name" name="item_name" class="form-control" value="{{ old('item_name') }}" required>
                </div>
                <div class="col-md-6">
                    <label for="quantity" class="form-label">Quantity</label>
                    <input type="number" id="quantity" name="quantity" class="form-control" value="{{ old('quantity') }}" required min="1">
                </div>
            </div>
            <div class="edit-row">
                <div class="col-md-12">
                    <label for="reason" class="form-label">Reason for Request</label>
                    <textarea id="reason" name="reason" class="form-control" rows="4" required>{{ old('reason') }}</textarea>
                </div>
            </div>
            <div class="button-row">
                <button type="submit" class="btn btn-primary">Submit Request</button>
            </div>
        </form>
    </div>
</div>
@endsection