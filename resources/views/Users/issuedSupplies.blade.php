@extends('layouts.app')
@section('title', 'Issued Supplies')

@section('content')
<h1 class="mb-4">Issued Supplies</h1>

<form method="GET" action="{{ route('users.issuedSupplies') }}" class="mb-3 d-flex">
    <input type="text" name="search" class="form-control search" placeholder="Search ..." value="{{ request('search') }}">
    <button type="submit" class="add-btn">Search</button>
</form>

<div class="card mb-4 shadow-sm">
    <div class="card-body">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Supply Name</th>
                    <th>Quantity</th>
                    <th>Issued To</th>
                    <th>Date Issued</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($issuedSupplies as $item)
                <tr>
                    <td>{{ $item->supply->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->user->full_name }}</td>
                    <td>{{ $item->date_issued ? \Carbon\Carbon::parse($item->date_issued)->format('Y-m-d') : '—' }}</td>
                    <td>
                        @if($item->is_returned)
                            <span class="badge bg-success">Returned</span>
                        @else
                            <span class="badge bg-warning">Not Returned</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5">No issued supplies found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection