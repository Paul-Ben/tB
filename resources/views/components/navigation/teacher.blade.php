<ul class="menu-inner py-1">
    <!-- Dashboard -->
    <li class="menu-item {{ request()->routeIs('teacher.dashboard') ? 'active' : '' }}">
        <a href="{{ route('teacher.dashboard') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-home-circle"></i>
            <div data-i18n="Dashboard">Dashboard</div>
        </a>
    </li>

    <!-- My Classes -->
    <li class="menu-header small text-uppercase">
        <span class="menu-header-text">Teaching</span>
    </li>
    <li class="menu-item {{ request()->routeIs('teacher.classes*') ? 'active open' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-book-open"></i>
            <div data-i18n="My Classes">My Classes</div>
        </a>
        <ul class="menu-sub">
            <li class="menu-item {{ request()->routeIs('teacher.classes.index') ? 'active' : '' }}">
                <a href="#" class="menu-link">
                    <div data-i18n="All Classes">All Classes</div>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('teacher.classes.schedule') ? 'active' : '' }}">
                <a href="#" class="menu-link">
                    <div data-i18n="My Schedule">My Schedule</div>
                </a>
            </li>
        </ul>
    </li>

    <!-- Students -->
    <li class="menu-item {{ request()->routeIs('teacher.students*') ? 'active open' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-group"></i>
            <div data-i18n="Students">My Students</div>
        </a>
        <ul class="menu-sub">
            <li class="menu-item {{ request()->routeIs('teacher.students.index') ? 'active' : '' }}">
                <a href="#" class="menu-link">
                    <div data-i18n="All Students">All Students</div>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('teacher.students.attendance') ? 'active' : '' }}">
                <a href="#" class="menu-link">
                    <div data-i18n="Attendance">Attendance</div>
                </a>
            </li>
        </ul>
    </li>

    <!-- Assessments -->
    <li class="menu-header small text-uppercase">
        <span class="menu-header-text">Assessment</span>
    </li>
    <li class="menu-item {{ request()->routeIs('teacher.assignments*') ? 'active open' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-task"></i>
            <div data-i18n="Assignments">Assignments</div>
        </a>
        <ul class="menu-sub">
            <li class="menu-item {{ request()->routeIs('teacher.assignments.index') ? 'active' : '' }}">
                <a href="#" class="menu-link">
                    <div data-i18n="All Assignments">All Assignments</div>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('teacher.assignments.create') ? 'active' : '' }}">
                <a href="#" class="menu-link">
                    <div data-i18n="Create Assignment">Create Assignment</div>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('teacher.assignments.grading') ? 'active' : '' }}">
                <a href="#" class="menu-link">
                    <div data-i18n="Grading">Grading</div>
                </a>
            </li>
        </ul>
    </li>

    <!-- Grades -->
    <li class="menu-item {{ request()->routeIs('teacher.grades*') ? 'active open' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-medal"></i>
            <div data-i18n="Grades">Grades</div>
        </a>
        <ul class="menu-sub">
            <li class="menu-item {{ request()->routeIs('teacher.grades.index') ? 'active' : '' }}">
                <a href="#" class="menu-link">
                    <div data-i18n="Grade Book">Grade Book</div>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('teacher.grades.reports') ? 'active' : '' }}">
                <a href="#" class="menu-link">
                    <div data-i18n="Grade Reports">Grade Reports</div>
                </a>
            </li>
        </ul>
    </li>

    <!-- Communication -->
    <li class="menu-header small text-uppercase">
        <span class="menu-header-text">Communication</span>
    </li>
    <li class="menu-item {{ request()->routeIs('teacher.messages*') ? 'active open' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-message-dots"></i>
            <div data-i18n="Messages">Messages</div>
        </a>
        <ul class="menu-sub">
            <li class="menu-item {{ request()->routeIs('teacher.messages.guardians') ? 'active' : '' }}">
                <a href="#" class="menu-link">
                    <div data-i18n="Guardian Messages">Guardian Messages</div>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('teacher.messages.announcements') ? 'active' : '' }}">
                <a href="#" class="menu-link">
                    <div data-i18n="Announcements">Announcements</div>
                </a>
            </li>
        </ul>
    </li>

    <!-- Resources -->
    <li class="menu-item {{ request()->routeIs('teacher.resources*') ? 'active' : '' }}">
        <a href="#" class="menu-link">
            <i class="menu-icon tf-icons bx bx-folder"></i>
            <div data-i18n="Resources">Teaching Resources</div>
        </a>
    </li>
</ul>