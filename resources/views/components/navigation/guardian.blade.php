<ul class="menu-inner py-1">
    <!-- Dashboard -->
    <li class="menu-item {{ request()->routeIs('guardian.dashboard') ? 'active' : '' }}">
        <a href="{{ route('guardian.dashboard') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-home-circle"></i>
            <div data-i18n="Dashboard">Dashboard</div>
        </a>
    </li>

    <!-- My Children -->
    <li class="menu-header small text-uppercase">
        <span class="menu-header-text">My Children</span>
    </li>
    <li class="menu-item {{ request()->routeIs('guardian.children*') ? 'active open' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-group"></i>
            <div data-i18n="Children">My Children</div>
        </a>
        <ul class="menu-sub">
            <li class="menu-item {{ request()->routeIs('guardian.children.index') ? 'active' : '' }}">
                <a href="{{ route('guardian.children.index') }}" class="menu-link">
                    <div data-i18n="All Children">All Children</div>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('guardian.children.profile') ? 'active' : '' }}">
                <a href="#" class="menu-link">
                    <div data-i18n="Child Profile">Child Profile</div>
                </a>
            </li>
        </ul>
    </li>

    <!-- Academic Progress -->
    <li class="menu-header small text-uppercase">
        <span class="menu-header-text">Academic</span>
    </li>
    <li class="menu-item {{ request()->routeIs('guardian.grades*') ? 'active open' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-medal"></i>
            <div data-i18n="Grades">Grades & Progress</div>
        </a>
        <ul class="menu-sub">
            <li class="menu-item {{ request()->routeIs('guardian.grades.current') ? 'active' : '' }}">
                <a href="#" class="menu-link">
                    <div data-i18n="Current Grades">Current Grades</div>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('guardian.grades.reports') ? 'active' : '' }}">
                <a href="#" class="menu-link">
                    <div data-i18n="Report Cards">Report Cards</div>
                </a>
            </li>
        </ul>
    </li>

    <!-- Attendance -->
    <li class="menu-item {{ request()->routeIs('guardian.attendance*') ? 'active open' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-calendar-check"></i>
            <div data-i18n="Attendance">Attendance</div>
        </a>
        <ul class="menu-sub">
            <li class="menu-item {{ request()->routeIs('guardian.attendance.current') ? 'active' : '' }}">
                <a href="#" class="menu-link">
                    <div data-i18n="Current Month">Current Month</div>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('guardian.attendance.history') ? 'active' : '' }}">
                <a href="#" class="menu-link">
                    <div data-i18n="Attendance History">Attendance History</div>
                </a>
            </li>
        </ul>
    </li>

    <!-- Assignments -->
    <li class="menu-item {{ request()->routeIs('guardian.assignments*') ? 'active open' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-task"></i>
            <div data-i18n="Assignments">Assignments</div>
        </a>
        <ul class="menu-sub">
            <li class="menu-item {{ request()->routeIs('guardian.assignments.current') ? 'active' : '' }}">
                <a href="#" class="menu-link">
                    <div data-i18n="Current Assignments">Current Assignments</div>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('guardian.assignments.completed') ? 'active' : '' }}">
                <a href="#" class="menu-link">
                    <div data-i18n="Completed">Completed</div>
                </a>
            </li>
        </ul>
    </li>

    <!-- Communication -->
    <li class="menu-header small text-uppercase">
        <span class="menu-header-text">Communication</span>
    </li>
    <li class="menu-item {{ request()->routeIs('guardian.messages*') ? 'active open' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-message-dots"></i>
            <div data-i18n="Messages">Messages</div>
        </a>
        <ul class="menu-sub">
            <li class="menu-item {{ request()->routeIs('guardian.messages.teachers') ? 'active' : '' }}">
                <a href="#" class="menu-link">
                    <div data-i18n="Teacher Messages">Teacher Messages</div>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('guardian.messages.school') ? 'active' : '' }}">
                <a href="#" class="menu-link">
                    <div data-i18n="School Announcements">School Announcements</div>
                </a>
            </li>
        </ul>
    </li>

    <!-- Events & Calendar -->
    <li class="menu-item {{ request()->routeIs('guardian.events*') ? 'active open' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-calendar-event"></i>
            <div data-i18n="Events">Events & Calendar</div>
        </a>
        <ul class="menu-sub">
            <li class="menu-item {{ request()->routeIs('guardian.events.upcoming') ? 'active' : '' }}">
                <a href="#" class="menu-link">
                    <div data-i18n="Upcoming Events">Upcoming Events</div>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('guardian.events.calendar') ? 'active' : '' }}">
                <a href="#" class="menu-link">
                    <div data-i18n="School Calendar">School Calendar</div>
                </a>
            </li>
        </ul>
    </li>

    <!-- Settings -->
    <li class="menu-item {{ request()->routeIs('guardian.settings*') ? 'active' : '' }}">
        <a href="#" class="menu-link">
            <i class="menu-icon tf-icons bx bx-cog"></i>
            <div data-i18n="Settings">Settings</div>
        </a>
    </li>
</ul>