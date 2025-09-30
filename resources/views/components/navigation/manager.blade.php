<ul class="menu-inner py-1">
    <!-- Dashboard -->
    <li class="menu-item {{ request()->routeIs('manager.dashboard') ? 'active' : '' }}">
        <a href="{{ route('manager.dashboard') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-home-circle"></i>
            <div data-i18n="Dashboard">Dashboard</div>
        </a>
    </li>

    <!-- Staff Management -->
    <li class="menu-header small text-uppercase">
        <span class="menu-header-text">Staff Management</span>
    </li>
    <li class="menu-item {{ request()->routeIs('manager.teachers*') ? 'active open' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-user-check"></i>
            <div data-i18n="Teachers">Teachers</div>
        </a>
        <ul class="menu-sub">
            <li class="menu-item {{ request()->routeIs('manager.teachers.index') ? 'active' : '' }}">
                <a href="{{ route('manager.teachers.index') }}" class="menu-link">
                    <div data-i18n="All Teachers">All Teachers</div>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('manager.teachers.create') ? 'active' : '' }}">
                <a href="{{ route('manager.teachers.create') }}" class="menu-link">
                    <div data-i18n="Add Teacher">Add Teacher</div>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('manager.teachers.schedule') ? 'active' : '' }}">
                <a href="#" class="menu-link">
                    <div data-i18n="Teacher Schedule">Teacher Schedule</div>
                </a>
            </li>
        </ul>
    </li>

    <!-- Student Management -->
    <li class="menu-item {{ request()->routeIs('manager.students*') ? 'active open' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-group"></i>
            <div data-i18n="Students">Students</div>
        </a>
        <ul class="menu-sub">
            <li class="menu-item {{ request()->routeIs('manager.students.index') ? 'active' : '' }}">
                <a href="#" class="menu-link">
                    <div data-i18n="All Students">All Students</div>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('manager.students.enrollment') ? 'active' : '' }}">
                <a href="#" class="menu-link">
                    <div data-i18n="Enrollment">Enrollment</div>
                </a>
            </li>
        </ul>
    </li>

    <!-- Guardian Management -->
    <li class="menu-item {{ request()->routeIs('manager.guardians*') ? 'active open' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-user-circle"></i>
            <div data-i18n="Guardians">Guardians</div>
        </a>
        <ul class="menu-sub">
            <li class="menu-item {{ request()->routeIs('manager.guardians.index') ? 'active' : '' }}">
                <a href="#" class="menu-link">
                    <div data-i18n="All Guardians">All Guardians</div>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('manager.guardians.communications') ? 'active' : '' }}">
                <a href="#" class="menu-link">
                    <div data-i18n="Communications">Communications</div>
                </a>
            </li>
        </ul>
    </li>

    <!-- Academic Management -->
    <li class="menu-header small text-uppercase">
        <span class="menu-header-text">Academic</span>
    </li>
    
    <!-- School Sessions -->
    <li class="menu-item {{ request()->routeIs('manager.school-sessions*') ? 'active open' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-calendar-event"></i>
            <div data-i18n="School Sessions">School Sessions</div>
        </a>
        <ul class="menu-sub">
            <li class="menu-item {{ request()->routeIs('manager.school-sessions.index') ? 'active' : '' }}">
                <a href="{{ route('manager.school-sessions.index') }}" class="menu-link">
                    <div data-i18n="All Sessions">All Sessions</div>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('manager.school-sessions.create') ? 'active' : '' }}">
                <a href="{{ route('manager.school-sessions.create') }}" class="menu-link">
                    <div data-i18n="Create Session">Create Session</div>
                </a>
            </li>
        </ul>
    </li>

    <li class="menu-item {{ request()->routeIs('manager.classrooms*') ? 'active open' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-book-open"></i>
            <div data-i18n="Classrooms">Classrooms</div>
        </a>
        <ul class="menu-sub">
            <li class="menu-item {{ request()->routeIs('manager.classrooms.index') ? 'active' : '' }}">
                <a href="{{ route('manager.classrooms.index') }}" class="menu-link">
                    <div data-i18n="All Classrooms">All Classrooms</div>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('manager.classrooms.create') ? 'active' : '' }}">
                <a href="{{ route('manager.classrooms.create') }}" class="menu-link">
                    <div data-i18n="Add Classroom">Add Classroom</div>
                </a>
            </li>
        </ul>
    </li>

    <!-- Terms -->
    <li class="menu-item {{ request()->routeIs('manager.terms*') ? 'active open' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-calendar-alt"></i>
            <div data-i18n="Terms">Terms</div>
        </a>
        <ul class="menu-sub">
            <li class="menu-item {{ request()->routeIs('manager.terms.index') ? 'active' : '' }}">
                <a href="{{ route('manager.terms.index') }}" class="menu-link">
                    <div data-i18n="All Terms">All Terms</div>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('manager.terms.create') ? 'active' : '' }}">
                <a href="{{ route('manager.terms.create') }}" class="menu-link">
                    <div data-i18n="Add Term">Add Term</div>
                </a>
            </li>
        </ul>
    </li>

    <!-- Reports -->
    <li class="menu-item {{ request()->routeIs('manager.reports*') ? 'active open' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-bar-chart-alt-2"></i>
            <div data-i18n="Reports">Reports</div>
        </a>
        <ul class="menu-sub">
            <li class="menu-item {{ request()->routeIs('manager.reports.attendance') ? 'active' : '' }}">
                <a href="#" class="menu-link">
                    <div data-i18n="Attendance">Attendance Reports</div>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('manager.reports.performance') ? 'active' : '' }}">
                <a href="#" class="menu-link">
                    <div data-i18n="Performance">Performance Reports</div>
                </a>
            </li>
        </ul>
    </li>

    <!-- Settings -->
    <li class="menu-item {{ request()->routeIs('manager.settings*') ? 'active' : '' }}">
        <a href="#" class="menu-link">
            <i class="menu-icon tf-icons bx bx-cog"></i>
            <div data-i18n="Settings">Settings</div>
        </a>
    </li>
</ul>