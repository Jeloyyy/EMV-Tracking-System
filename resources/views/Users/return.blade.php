@extends('layouts.app')
@section('title', 'Return Supplies')

@section('content')
<h1 class="mb-4">Return Supplies</h1>

<form method="GET" action="{{ route('users.returnSupplies') }}" class="mb-3 d-flex">
    <input type="text" name="search" class="form-control me-2" placeholder="Search ..." value="{{ request('search') }}">
    <button type="submit" class="sBtn">Search</button>
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
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($issuedSupplies as $item)
                <tr>
                    <td>{{ $item->supply->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->user->full_name }}</td>
                    <td>{{ $item->date_issued }}</td>
                    <td>
                        <form action="{{ route('users.returnSupply', $item->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('POST')
                            <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Confirm return?')">Return</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5">No supplies to return.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection