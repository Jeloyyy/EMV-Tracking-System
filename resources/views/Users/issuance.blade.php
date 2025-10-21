@extends('layouts.app')
@section('title', 'Issuance')

@section('content')
<h1>Issue Supply</h1>

<form method="POST" action="{{ route('issuance.store') }}">
    @csrf
    <div class="mb-3">
        <label class="form-label">Employee</label>
        <select name="user_id" class="form-select" required>
            @foreach(App\Models\User::all() as $u)
                <option value="{{ $u->id }}">{{ $u->full_name ?? $u->email }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Supply</label>
        <select name="supply_id" class="form-select" required>
            @foreach(App\Models\Supply::all() as $s)
                <option value="{{ $s->id }}">{{ $s->name }} - ₱{{ number_format($s->price,2) }} (stock: {{ $s->quantity }})</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Quantity</label>
        <input type="number" name="quantity" class="form-control" min="1" value="1" required>
    </div>

    <button class="add-btn">Issue</button>
</form>
@endsection
