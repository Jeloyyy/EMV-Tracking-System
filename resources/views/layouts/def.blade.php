<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title','E.M. Villanueva Resort')</title>
    <link rel="manifest" href="/manifest.json">
    @vite('resources/css/app.css')
</head>
<body>
    <nav class="navbar">
        <div class="navbar-brand">EMV Resort Management</div>
        <div class="navbar-menu">
            <button class="menu-toggle" id="menuToggle">Menu ▾</button>
                <div class="menu-dropdown" id="menuDropdown">
                    <a href="{{ route('login') }}">Login</a>
                    <a href="{{ route('register') }}">Register</a>
                </div>
        </div>
    </nav>
    <div class="outside-container">
        <main>
            @yield('content')
        </main>
    </div>
    @include('partials.footer')
</body>
</html>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggle = document.getElementById('menuToggle');
        const dropdown = document.getElementById('menuDropdown');

        toggle.addEventListener('click', function () {
            dropdown.style.display = dropdown.style.display === 'flex' ? 'none' : 'flex';
        });

        document.addEventListener('click', function (e) {
            if (!toggle.contains(e.target) && !dropdown.contains(e.target)) {
                dropdown.style.display = 'none';
            }
        });

        // Register service worker on page load
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register('/service-worker.js');
        }
    });
</script>