@extends('layouts.app')
@section('title', 'Supplies')

@section('content')
<h1>Supplies</h1>

<form method="GET" action="{{ route('users.supplies') }}">
    <input type="text" name="search" class="form-control search" placeholder="Search supplies..." value="{{ request('search') }}">
    <button type="submit" class="add-btn">Search</button>
</form>

@if($supplies->count())
    <div>
        <table class="table">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Item Name</th>
                    <th>Description</th>
                    <th>Total Quantity</th>
                    <th>Price</th>
                    <th>Total Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @php $grandTotal = 0; @endphp
                @foreach($supplies as $index => $supply)
                    @php
                        $rowTotal = ($supply->price * $supply->quantity);
                        $grandTotal += $rowTotal;
                    @endphp
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $supply->name }}</td>
                        <td>{{ $supply->description }}</td>
                        <td>{{ $supply->quantity }}</td>
                        <td>₱{{ number_format($supply->price,2) }}</td>
                        <td>₱{{ number_format($rowTotal,2) }}</td>
                        <td class="action-buttons">
                            <button class="btn-outline-warning"
                                    onclick="window.location='{{ route('supplies.edit', $supply->id) }}'">
                                Add
                            </button>
                            <form action="{{ route('supplies.destroy', $supply->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-outline-danger"
                                        onclick="return confirm('Delete this supply?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach

                <tr class="table-secondary">
                    <td colspan="5"><strong>Grand Total</strong></td>
                    <td><strong>₱{{ number_format($grandTotal,2) }}</strong></td>
                </tr>
            </tbody>
        </table>
    </div>
@else
    <p>No supplies found.</p>
@endif
@endsection
