<nav class="navbar">
    <div class="navbar-left">
        <button class="sidebar-toggle" id="sidebarToggle">☰</button>
        <div class="navbar-brand">EMV Resort Management</div>
    </div>
    <div class="navbar-menu">
        <button class="menu-toggle" id="menuToggle">Menu ▾</button>
        
        <div class="menu-dropdown" id="menuDropdown">
            <button type="button" onclick="window.location='{{ route('profile') }}'" class="dropdown-btn">Profile</button>
            <button id="modeToggle">Change Theme</button>
            <button type="button" onclick="window.location='{{ route('contact') }}'" class="dropdown-btn">Settings</button>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebarContainer = document.getElementById('sidebarContainer');
        const menuToggle = document.getElementById('menuToggle');
        const menuDropdown = document.getElementById('menuDropdown');
        const modeToggle = document.getElementById('modeToggle');

        if (sidebarToggle && sidebarContainer) {
            sidebarToggle.addEventListener('click', function () {
                sidebarContainer.classList.toggle('collapsed');
            });
        }

        if (menuToggle && menuDropdown) {
            menuToggle.addEventListener('click', function () {
                const isVisible = menuDropdown.style.display === 'flex';
                menuDropdown.style.display = isVisible ? 'none' : 'flex';
            });

            document.addEventListener('click', function (e) {
                if (!menuToggle.contains(e.target) && !menuDropdown.contains(e.target)) {
                    menuDropdown.style.display = 'none';
                }
            });
        }

        // Night mode toggle
        if (modeToggle) {
            modeToggle.onclick = function() {
                document.body.classList.toggle('dark-mode');
                localStorage.setItem('nightMode', document.body.classList.contains('dark-mode'));
            };
            if(localStorage.getItem('nightMode') === 'true') {
                document.body.classList.add('dark-mode');
            }
        }
    });
</script>
