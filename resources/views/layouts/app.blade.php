<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title','E.M. Villanueva Resort')</title>
    <link rel="manifest" href="/manifest.json">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
