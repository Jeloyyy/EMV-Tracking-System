@php
    $menus=
    [
        [
            'route'=> 'dashboard',
            'roles'=> ['admin','manager']
        ],        
        [
            'title'=> 'Dashboard',
            'route'=> 'userDashboard',
            'roles'=> ['user','supervisor']
        ],
        [
            'title'=> 'Profile',
            'route'=> 'profile',
            'roles'=> ['admin','manager','supervisor','user']
        ],
        [
            'title'=> 'Resort Staffs',
            'route'=> 'users.resortStaffsTable',
            'roles'=> ['supervisor','user']
        ],
        [
            'title'=> 'Users',
            'route'=> 'users.resortStaffs',
            'roles'=> ['admin','manager']
        ],
        [
            'title'=> 'Supplies',
            'route'=> 'users.supplies',
            'roles'=> ['admin','manager']
        ],
        [
            'title'=> 'Issued Supplies',
            'route'=> 'users.issuedSupplies',
            'roles'=> ['admin','manager']
        ],
        [
            'title'=> 'Add User',
            'route'=> 'users.create',
            'roles'=> ['admin','manager']
        ],
        [
            'title'=> 'Add Supplies',
            'route'=> 'users.addSupplies',
            'roles'=> ['admin','manager','supervisor']
        ],
        [
            'title'=> 'Issuance',
            'route'=> 'users.issuance',
            'roles'=> ['admin','manager']
        ],
        [
            'title'=> 'Request Supplies',
            'route'=> 'supply.request',
            'roles'=> ['supervisor','user']
        ],
 //       [
//            'title'=> 'Supply Management',
 //           'roles'=> ['admin','manager','supervisor','user']
 //       ],
        [
            'title'=> 'About',
            'route'=> 'about',
            'roles'=> ['admin','manager','supervisor','user']
        ],
        [
            'title'=> 'Contact',
            'route'=> 'contact',
            'roles'=> ['admin','manager','supervisor','user']
        ],
    ];
@endphp

<aside class="sidebar-container" id="sidebarContainer">
    <div id="sidebar" class="sidebar">
        <nav>
            <ul>
                @foreach ($menus ?? [] as $menu)
                    @if (auth()->check() && auth()->user()->hasAnyRole($menu['roles']))
                        <li>
                            <a href="{{ route($menu['route']) }}">{{ $menu['title'] ?? ucfirst(str_replace('.', ' ', $menu['route'])) }}</a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </nav>
    </div>
</aside>
<script>
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebarContainer = document.getElementById('sidebarContainer');
</script>
