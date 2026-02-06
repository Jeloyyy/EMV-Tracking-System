@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    @if(session('show_welcome'))
        <h1 id="welcome-msg">Welcome, {{ Auth::user()->full_name }}</h1>
    @endif

    <div class="dashboard-container">
        @if(auth()->user()->role === 'admin' || auth()->user()->role === 'manager')
        <div>
            <div class="dashboard-card bg-light" onclick="window.location='{{ route('users.resortStaffsTable') }}'">
                <div class="text-center">
                    <i class="bi bi-people-fill fs-2 text-primary mb-2"></i>
                    <h4 class="mb-0">{{ \App\Models\User::count() }}</h4>
                    <small class="text-muted">Users</small>
                </div>
            </div>
        </div>
        @endif
        <div>
            <div class="dashboard-card bg-light" onclick="window.location='{{ route('users.supplies') }}'">
                <div class="text-center">
                    <i class="bi bi-box-seam fs-2 text-success mb-2"></i>
                    <h4 class="mb-0">{{ $supplies->count() }}</h4>
                    <small class="text-muted">Supplies</small>
                </div>
            </div>
        </div>
        @if(auth()->user()->role === 'admin' || auth()->user()->role === 'manager')
        <div>
            <div class="dashboard-card bg-light">
                <div class="text-center">
                    <i class="bi bi-clock-history fs-2 text-warning mb-2"></i>
                    <h4 class="mb-0">{{ $pendingRequests->count() }}</h4>
                    <small class="text-muted">Pending</small>
                </div>
            </div>
        </div>
        <div>
            <div class="dashboard-card bg-light">
                <div class="text-center">
                    <i class="bi bi-check-circle-fill fs-2 text-info mb-2"></i>
                    <h4 class="mb-0">{{ \App\Models\IssuedSupply::count() }}</h4>
                    <small class="text-muted">Issued</small>
                </div>
            </div>
        </div>
        @endif
    </div>

    @if(auth()->user()->role === 'admin' || auth()->user()->role === 'manager')
    <div class="d-flex gap-4 mb-4">
        <div class="flex-fill">
            @if($supplies->count() > 0)
                <div class="dash-overview" style="cursor: pointer;" onclick="window.location='{{ route('users.supplies') }}'">
                    <h3 class="mb-3">Supplies Overview</h3>
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead class="table-dark">
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($supplies->take(5) as $supply)
                                    <tr>
                                        <td class="fw-semibold">{{ $supply->name }}</td>
                                        <td>{{ Str::limit($supply->description, 30) }}</td>
                                        <td class="text-end">₱{{ number_format($supply->price, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if($supplies->count() > 5)
                        <small class="text-muted">Showing 5 of {{ $supplies->count() }} supplies</small>
                    @endif
                </div>
            @else
                <div class="dash-overview">
                    <h3 class="mb-3">Supplies Overview</h3>
                    <p class="text-muted">No supplies found.</p>
                </div>
            @endif
        </div>
        <div class="flex-fill">
            @if($pendingRequests->count() > 0)
                <div class="dash-overview" style="background-color: #fff3cd; border: 1px solid #ffeaa7;">
                    <h3 class="mb-3">Pending Supply Requests</h3>
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead class="table-warning">
                                <tr>
                                    <th>Requested By</th>
                                    <th>Item</th>
                                    <th>Qty</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pendingRequests->take(5) as $request)
                                    <tr>
                                        <td>{{ Str::limit($request->user->full_name, 15) }}</td>
                                        <td>{{ Str::limit($request->item_name, 20) }}</td>
                                        <td class="text-center">{{ $request->quantity }}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <form action="{{ route('supply.request.approve', $request->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('POST')
                                                    <button type="submit" class="btn btn-success btn-sm">✓</button>
                                                </form>
                                                <form action="{{ route('supply.request.reject', $request->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('POST')
                                                    <button type="submit" class="btn btn-danger btn-sm">✗</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if($pendingRequests->count() > 5)
                        <small class="text-muted">Showing 5 of {{ $pendingRequests->count() }} requests</small>
                    @endif
                </div>
            @else
                <div class="dash-overview" style="background-color: #d1ecf1; border: 1px solid #bee5eb;">
                    <h3 class="mb-3">Pending Supply Requests</h3>
                    <p class="text-muted">No pending requests.</p>
                </div>
            @endif
        </div>
    </div>
    @else
    <div class="mb-4">
        @if($supplies->count() > 0)
            <div class="dash-overview" style="cursor: pointer;" onclick="window.location='{{ route('users.supplies') }}'">
                <h3 class="mb-3">Available Supplies</h3>
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead class="table-dark">
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($supplies->take(10) as $supply)
                                <tr>
                                    <td class="fw-semibold">{{ $supply->name }}</td>
                                    <td>{{ Str::limit($supply->description, 40) }}</td>
                                    <td class="text-end">₱{{ number_format($supply->price, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @if($supplies->count() > 10)
                    <small class="text-muted">Showing 10 of {{ $supplies->count() }} supplies</small>
                @endif
            </div>
        @else
            <div class="dash-overview">
                <h3 class="mb-3">Available Supplies</h3>
                <p class="text-muted">No supplies available.</p>
            </div>
        @endif
    </div>
    @endif

    <script>
        setTimeout(() => {
            const msg = document.getElementById('welcome-msg');
            if (msg) msg.classList.add('fade-out');
            setTimeout(() => msg?.remove(), 1000);
        }, 4000);
    </script>
@endsection


