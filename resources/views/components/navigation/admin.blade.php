<ul class="menu-inner py-1">
    <!-- Dashboard -->
    <li class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <a href="{{ route('admin.dashboard') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-home-circle"></i>
            <div data-i18n="Dashboard">Dashboard</div>
        </a>
    </li>

    <!-- User Management -->
    <li class="menu-header small text-uppercase">
        <span class="menu-header-text">User Management</span>
    </li>
    <li class="menu-item {{ request()->routeIs('admin.users*') ? 'active open' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-user"></i>
            <div data-i18n="Users">Users</div>
        </a>
        <ul class="menu-sub">
            <li class="menu-item {{ request()->routeIs('admin.users.index') ? 'active' : '' }}">
                <a href="{{ route('admin.users.index') }}" class="menu-link">
                    <div data-i18n="All Users">All Users</div>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('admin.users.create') ? 'active' : '' }}">
                <a href="{{ route('admin.users.create') }}" class="menu-link">
                    <div data-i18n="Add User">Add User</div>
                </a>
            </li>
        </ul>
    </li>

    <!-- Teacher Management -->
    <li class="menu-item {{ request()->routeIs('admin.teachers*') ? 'active open' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-user-check"></i>
            <div data-i18n="Teachers">Teachers</div>
        </a>
        <ul class="menu-sub">
            <li class="menu-item {{ request()->routeIs('admin.teachers.index') ? 'active' : '' }}">
                <a href="{{ route('admin.teachers.index') }}" class="menu-link">
                    <div data-i18n="All Teachers">All Teachers</div>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('admin.teachers.create') ? 'active' : '' }}">
                <a href="{{ route('admin.teachers.create') }}" class="menu-link">
                    <div data-i18n="Add Teacher">Add Teacher</div>
                </a>
            </li>
        </ul>
    </li>

    <!-- Role Management -->
    <li class="menu-item {{ request()->routeIs('admin.roles*') ? 'active open' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-shield"></i>
            <div data-i18n="Roles">Roles & Permissions</div>
        </a>
        <ul class="menu-sub">
            <li class="menu-item {{ request()->routeIs('admin.roles.index') ? 'active' : '' }}">
                <a href="#" class="menu-link">
                    <div data-i18n="All Roles">All Roles</div>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('admin.permissions.index') ? 'active' : '' }}">
                <a href="#" class="menu-link">
                    <div data-i18n="Permissions">Permissions</div>
                </a>
            </li>
        </ul>
    </li>

    <!-- System Management -->
    <li class="menu-header small text-uppercase">
        <span class="menu-header-text">System</span>
    </li>
    <li class="menu-item {{ request()->routeIs('admin.settings*') ? 'active' : '' }}">
        <a href="#" class="menu-link">
            <i class="menu-icon tf-icons bx bx-cog"></i>
            <div data-i18n="Settings">System Settings</div>
        </a>
    </li>

    <!-- Reports -->
    <li class="menu-item {{ request()->routeIs('admin.reports*') ? 'active open' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-bar-chart-alt-2"></i>
            <div data-i18n="Reports">Reports</div>
        </a>
        <ul class="menu-sub">
            <li class="menu-item {{ request()->routeIs('admin.reports.users') ? 'active' : '' }}">
                <a href="#" class="menu-link">
                    <div data-i18n="User Reports">User Reports</div>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('admin.reports.activity') ? 'active' : '' }}">
                <a href="#" class="menu-link">
                    <div data-i18n="Activity Reports">Activity Reports</div>
                </a>
            </li>
        </ul>
    </li>

    <!-- Logs -->
    <li class="menu-item {{ request()->routeIs('admin.logs*') ? 'active' : '' }}">
        <a href="#" class="menu-link">
            <i class="menu-icon tf-icons bx bx-file"></i>
            <div data-i18n="System Logs">System Logs</div>
        </a>
    </li>
</ul>