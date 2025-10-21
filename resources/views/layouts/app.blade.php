<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title','E.M. Villanueva Resort')</title>
    <link rel="manifest" href="/manifest.json">
    @vite('resources/css/app.css')
</head>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebarContainer = document.getElementById('sidebarContainer');

        if (sidebarToggle && sidebarContainer) {
            sidebarToggle.addEventListener('click', function () {
                sidebarContainer.classList.toggle('collapsed');
            });
        }
    });
</script>
<body>
    <div class="page-container">
        @include('partials.navbar')

        @include('partials.sidebar')

        <div class="layout-container">
            <main>
                @yield('content')
            </main>
        </div>
    </div>
    @include('partials.footer')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const sidebarToggle = document.querySelector('.sidebar-toggle');
            const sidebarContainer = document.querySelector('.sidebar-container');
            if (sidebarToggle && sidebarContainer) {
                sidebarToggle.addEventListener('click', function () {
                    sidebarContainer.classList.toggle('collapsed');
                });
            }
            // Register service worker on page load
            if ('serviceWorker' in navigator) {
                navigator.serviceWorker.register('/service-worker.js');
            }
        });
    </script>   
</body>
</html>
