<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
        @php
        $permissions = [
        'User' => App\Models\PermissionRole::getPermission('User', Auth::user()->role_id),
        'Role' => App\Models\PermissionRole::getPermission('Role', Auth::user()->role_id),
        'Category' => App\Models\PermissionRole::getPermission('Category', Auth::user()->role_id),
        'SubCategory' => App\Models\PermissionRole::getPermission('Sub-category', Auth::user()->role_id),
        'Setting' => App\Models\PermissionRole::getPermission('Setting', Auth::user()->role_id),
        'Slider' => App\Models\PermissionRole::getPermission('Slider', Auth::user()->role_id),
        ];
        @endphp

        <li class="nav-item">
            <a class="nav-link {{ Request::is('panel/dashboard') ? '' : 'collapsed' }}" href="{{ url('panel/dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        @if(!empty($permissions['User']))
        <li class="nav-item">
            <a class="nav-link {{ Request::is('panel/user') || Request::is('panel/user/*') ? '' : 'collapsed' }}" href="{{ url('panel/user') }}">
                <i class="bi bi-box"></i>
                <span>User</span>
            </a>
        </li><!-- End Product Nav -->
        @endif

        @if(!empty($permissions['Role']))
        <li class="nav-item">
            <a class="nav-link {{ Request::is('panel/role') || Request::is('panel/role/*') ? '' : 'collapsed' }}" href="{{ url('panel/role') }}">
                <i class="bi bi-person-badge"></i>
                <span>Role</span>
            </a>
        </li><!-- End Role Nav -->
        @endif

        @if(!empty($permissions['Category']))
        <li class="nav-item">
            <a class="nav-link {{ Request::is('panel/category') || Request::is('panel/category/*') ? '' : 'collapsed' }}" href="{{ url('panel/category') }}">
                <i class="bi bi-tags"></i>
                <span>Category</span>
            </a>
        </li><!-- End Category Nav -->
        @endif

        @if(!empty($permissions['SubCategory']))
        <li class="nav-item">
            <a class="nav-link {{ Request::is('panel/sub-category') || Request::is('panel/sub-category/*') ? '' : 'collapsed' }}" href="{{ url('panel/sub-category') }}">
                <i class="bi bi-tag"></i>
                <span>Sub-Category</span>
            </a>
        </li><!-- End Sub-Category Nav -->
        @endif

        @if(!empty($permissions['Setting']))
        <li class="nav-item">
            <a class="nav-link {{ Request::is('panel/setting') || Request::is('panel/setting/*') ? '' : 'collapsed' }}" href="{{ url('panel/setting') }}">
                <i class="bi bi-gear"></i>
                <span>Setting</span>
            </a>
        </li><!-- End Setting Nav -->
        @endif
        @if(!empty($permissions['Slider']))
        <li class="nav-item">
            <a class="nav-link {{ Request::is('panel/slider') || Request::is('panel/slider/*') ? '' : 'collapsed' }}" href="{{ url('panel/slider') }}">
                <i class="bi bi-gem"></i>
                <span>Slider</span>
            </a>
        </li><!-- End Setting Nav -->
        @endif
    </ul>


</aside><!-- End Sidebar -->
