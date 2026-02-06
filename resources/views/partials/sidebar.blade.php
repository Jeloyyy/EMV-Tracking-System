@php
    $menus = [
        [
            'route' => 'dashboard',
            'roles' => ['admin','manager']
        ],
        [
            'title' => 'Dashboard',
            'route' => 'userDashboard',
            'roles' => ['user','supervisor']
        ],
        [
            'title' => 'Profile',
            'route' => 'profile',
            'roles' => ['admin','manager','supervisor','user']
        ],
        [
            'title' => 'Resort Staffs',
            'route' => 'users.resortStaffsTable',
            'roles' => ['supervisor','user']
        ],
        [
            'title' => 'Users',
            'route' => 'users.resortStaffs',
            'roles' => ['admin','manager']
        ],
        [
            'title' => 'Supplies',
            'route' => 'users.supplies',
            'roles' => ['admin','manager']
        ],
        [
            'title' => 'Issued Supplies',
            'route' => 'users.issuedSupplies',
            'roles' => ['admin','manager']
        ],
        [
            'title' => 'Return Supplies',
            'route' => 'users.returnSupplies',
            'roles' => ['admin','manager','user','supervisor']
        ],
        [
            'title' => 'Add User',
            'route' => 'users.create',
            'roles' => ['admin','manager']
        ],
        [
            'title' => 'Add Supplies',
            'route' => 'users.addSupplies',
            'roles' => ['admin','manager','supervisor']
        ],
        [
            'title' => 'Issuance',
            'route' => 'users.issuance',
            'roles' => ['admin','manager']
        ],
        [
            'title' => 'Request Supplies',
            'route' => 'supply.request',
            'roles' => ['admin','supervisor','user']
        ],
        [
            'title' => 'About',
            'route' => 'about',
            'roles' => ['admin','manager','supervisor','user']
        ],
        [
            'title' => 'Contact',
            'route' => 'contact',
            'roles' => ['admin','manager','supervisor','user']
        ],
    ];
@endphp

<aside class="sidebar-container" id="sidebarContainer">
    <div id="sidebar" class="sidebar">
        <nav>
            <ul>
                @foreach ($menus ?? [] as $menu)
                    @if (isset($menu['type']) && $menu['type'] === 'group')
                        @php
                            $hasVisibleItems = false;
                            foreach ($menu['items'] as $item) {
                                if (auth()->check() && in_array(auth()->user()->role, $item['roles'])) {
                                    $hasVisibleItems = true;
                                    break;
                                }
                            }
                        @endphp
                        @if ($hasVisibleItems)
                            <li class="menu-group">
                                <a href="#group-{{ strtolower(str_replace(' ', '-', $menu['title'])) }}" class="group-toggle" data-bs-toggle="collapse" aria-expanded="false" aria-controls="group-{{ strtolower(str_replace(' ', '-', $menu['title'])) }}">
                                    {{ $menu['title'] }}
                                    <span class="toggle-icon">▶</span>
                                </a>
                                <ul class="submenu collapse" id="group-{{ strtolower(str_replace(' ', '-', $menu['title'])) }}">
                                    @foreach ($menu['items'] as $item)
                                        @if (auth()->check() && in_array(auth()->user()->role, $item['roles']))
                                            <li>
                                                <a href="{{ route($item['route']) }}">{{ $item['title'] }}</a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </li>
                        @endif
                    @else
                        @if (auth()->check() && in_array(auth()->user()->role, $menu['roles']))
                            <li>
                                <a href="{{ route($menu['route']) }}">{{ $menu['title'] ?? ucfirst(str_replace('.', ' ', $menu['route'])) }}</a>
                            </li>
                        @endif
                    @endif
                @endforeach
            </ul>
        </nav>
    </div>
</aside>
<script>
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebarContainer = document.getElementById('sidebarContainer');

    // Group dropdown functionality using Bootstrap collapse
    document.addEventListener('DOMContentLoaded', function() {
        const groupToggles = document.querySelectorAll('.group-toggle');

        groupToggles.forEach(function(toggle) {
            const icon = toggle.querySelector('.toggle-icon');
            const targetId = toggle.getAttribute('href').substring(1);
            const submenu = document.getElementById(targetId);

            // Listen for Bootstrap collapse events
            if (submenu) {
                submenu.addEventListener('show.bs.collapse', function() {
                    if (icon) icon.textContent = '▼';
                });

                submenu.addEventListener('hide.bs.collapse', function() {
                    if (icon) icon.textContent = '▶';
                });
            }
        });
    });
</script>
