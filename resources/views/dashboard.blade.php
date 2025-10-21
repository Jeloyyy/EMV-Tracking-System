@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    @if(session('show_welcome'))
        <h1 id="welcome-msg">Welcome, {{ Auth::user()->full_name }}</h1>
    @endif
        @if($supplies->count() > 0)
            <div class="dash-overview" style="cursor: pointer;" onclick="window.location='{{ route('users.supplies') }}'">
                <h2>Supplies Overview</h2>
                <table class="table">
                    <thead class="table-dark">
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($supplies as $index => $supply)
                            <tr>
                                <td>{{ $supply->name }}</td>
                                <td>{{ $supply->description }}</td>
                                <td>₱{{ number_format($supply->price,2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p>No supplies found.</p>
        @endif
    <script>
        setTimeout(() => {
        const msg = document.getElementById('welcome-msg');
        if (msg) msg.classList.add('fade-out');
        setTimeout(() => msg?.remove(), 1000);
        }, 4000);
    </script>
@endsection


