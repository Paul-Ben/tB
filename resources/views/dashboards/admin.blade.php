<x-dashboard-layout>
    <x-slot name="title">Admin Dashboard</x-slot>

    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> Admin Overview</h4>

            <!-- Statistics Cards -->
            <div class="row">
                <div class="col-lg-4 col-md-4 order-1">
                    <div class="card">
                        <div class="d-flex align-items-end row">
                            <div class="col-sm-7">
                                <div class="card-body">
                                    <h5 class="card-title text-primary">Total Users</h5>
                                    <p class="mb-4">
                                        <span class="fw-bold">{{ $totalUsers }}</span> registered users
                                    </p>
                                    <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-outline-primary">View Details</a>
                                </div>
                            </div>
                            <div class="col-sm-5 text-center text-sm-left">
                                <div class="card-body pb-0 px-0 px-md-4">
                                    <img src="{{ asset('assets/img/illustrations/man-with-laptop-light.png') }}" height="140" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6 col-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <img src="{{ asset('assets/img/icons/unicons/chart-success.png') }}" alt="chart success" class="rounded">
                                </div>
                                <div class="dropdown">
                                    <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                        <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                        <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                    </div>
                                </div>
                            </div>
                            <span class="fw-semibold d-block mb-1">Total Roles</span>
                            <h3 class="card-title mb-2">{{ $totalRoles }}</h3>
                            <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> Active roles</small>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6 col-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <img src="{{ asset('assets/img/icons/unicons/chart-success.png') }}" alt="Teachers" class="rounded">
                                </div>
                                <div class="dropdown">
                                    <button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                                        <a class="dropdown-item" href="{{ route('admin.teachers.index') }}">View All</a>
                                        <a class="dropdown-item" href="{{ route('admin.teachers.create') }}">Add Teacher</a>
                                    </div>
                                </div>
                            </div>
                            <span class="fw-semibold d-block mb-1">Total Teachers</span>
                            <h3 class="card-title mb-2">{{ $totalTeachers }}</h3>
                            <small class="text-success fw-semibold"><i class="bx bx-user-check"></i> {{ $verifiedTeachers }} verified</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Users -->
            <div class="row">
                <div class="col-md-6 col-lg-8 col-xl-8 order-0 mb-4">
                    <div class="card h-100">
                        <div class="card-header d-flex align-items-center justify-content-between pb-0">
                            <div class="card-title mb-0">
                                <h5 class="m-0 me-2">Recent Users</h5>
                                <small class="text-muted">Latest registered users</small>
                            </div>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="recentUsersDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="recentUsersDropdown">
                                    <a class="dropdown-item" href="javascript:void(0);">View All</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Export</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive text-nowrap">
                                <table class="table table-borderless">
                                    <thead>
                                        <tr>
                                            <th>User</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Joined</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        @foreach($recentUsers as $user)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar avatar-sm me-3">
                                                        <img src="{{ asset('assets/img/avatars/1.png') }}" alt="Avatar" class="rounded-circle">
                                                    </div>
                                                    <div>
                                                        <strong>{{ $user->name }}</strong>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                @php
                                                    $role = $user->userRole ?? $user->getPrimaryRole() ?? 'No Role';
                                                    $badgeClass = match($role) {
                                                        'admin' => 'bg-label-primary',
                                                        'manager' => 'bg-label-success',
                                                        'teacher' => 'bg-label-info',
                                                        'guardian' => 'bg-label-warning',
                                                        default => 'bg-label-secondary'
                                                    };
                                                @endphp
                                                <span class="badge {{ $badgeClass }} me-1">{{ $role }}</span>
                                            </td>
                                            <td>{{ $user->created_at->format('M j, Y') }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                                        <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Quick Actions -->
                <div class="col-md-6 col-lg-4 order-2 mb-4">
                    <div class="card h-100">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="card-title m-0 me-2">Quick Actions</h5>
                        </div>
                        <div class="card-body">
                            <ul class="p-0 m-0">
                                <li class="d-flex mb-4 pb-1">
                                    <div class="avatar flex-shrink-0 me-3">
                                        <span class="avatar-initial rounded bg-label-primary"><i class="bx bx-user-plus"></i></span>
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <h6 class="mb-0">Add New User</h6>
                                            <small class="text-muted">Create user account</small>
                                        </div>
                                        <div class="user-progress">
                                            <a href="{{ route('admin.users.create') }}" class="btn btn-sm btn-outline-primary">Add</a>
                                        </div>
                                    </div>
                                </li>
                                <li class="d-flex mb-4 pb-1">
                                    <div class="avatar flex-shrink-0 me-3">
                                        <span class="avatar-initial rounded bg-label-success"><i class="bx bx-user-check"></i></span>
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <h6 class="mb-0">Manage Teachers</h6>
                                            <small class="text-muted">Add and manage teachers</small>
                                        </div>
                                        <div class="user-progress">
                                            <a href="{{ route('admin.teachers.index') }}" class="btn btn-sm btn-outline-success">Manage</a>
                                        </div>
                                    </div>
                                </li>
                                <li class="d-flex mb-4 pb-1">
                                    <div class="avatar flex-shrink-0 me-3">
                                        <span class="avatar-initial rounded bg-label-warning"><i class="bx bx-shield"></i></span>
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <h6 class="mb-0">Manage Roles</h6>
                                            <small class="text-muted">Configure permissions</small>
                                        </div>
                                        <div class="user-progress">
                                            <a href="#" class="btn btn-sm btn-outline-warning">Manage</a>
                                        </div>
                                    </div>
                                </li>
                                <li class="d-flex mb-4 pb-1">
                                    <div class="avatar flex-shrink-0 me-3">
                                        <span class="avatar-initial rounded bg-label-info"><i class="bx bx-cog"></i></span>
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <h6 class="mb-0">System Settings</h6>
                                            <small class="text-muted">Configure system</small>
                                        </div>
                                        <div class="user-progress">
                                            <a href="#" class="btn btn-sm btn-outline-info">Settings</a>
                                        </div>
                                    </div>
                                </li>
                                <li class="d-flex">
                                    <div class="avatar flex-shrink-0 me-3">
                                        <span class="avatar-initial rounded bg-label-warning"><i class="bx bx-bar-chart-alt-2"></i></span>
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <h6 class="mb-0">View Reports</h6>
                                            <small class="text-muted">System analytics</small>
                                        </div>
                                        <div class="user-progress">
                                            <a href="#" class="btn btn-sm btn-outline-warning">Reports</a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Teachers -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="card-title m-0">Recent Teachers</h5>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="recentTeachersDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="recentTeachersDropdown">
                                    <a class="dropdown-item" href="{{ route('admin.teachers.index') }}">View All</a>
                                    <a class="dropdown-item" href="{{ route('admin.teachers.create') }}">Add Teacher</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            @if($recentTeachers->count() > 0)
                                <div class="table-responsive text-nowrap">
                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th>Teacher</th>
                                                <th>Email</th>
                                                <th>Qualification</th>
                                                <th>Status</th>
                                                <th>Added</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-border-bottom-0">
                                            @foreach($recentTeachers as $teacher)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar avatar-sm me-3">
                                                            <img src="{{ asset('assets/img/avatars/1.png') }}" alt="Avatar" class="rounded-circle">
                                                        </div>
                                                        <div>
                                                            <strong>{{ $teacher->full_name }}</strong>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{ $teacher->email }}</td>
                                                <td>
                                                    @if($teacher->qualification)
                                                        <span class="badge bg-label-info">{{ $teacher->qualification }}</span>
                                                    @else
                                                        <span class="text-muted">Not specified</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($teacher->user->email_verified_at)
                                                        <span class="badge bg-success">
                                                            <i class="bx bx-check me-1"></i>Verified
                                                        </span>
                                                    @else
                                                        <span class="badge bg-warning">
                                                            <i class="bx bx-time me-1"></i>Unverified
                                                        </span>
                                                    @endif
                                                </td>
                                                <td>{{ $teacher->created_at->format('M j, Y') }}</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                            <i class="bx bx-dots-vertical-rounded"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="{{ route('admin.teachers.show', $teacher) }}"><i class="bx bx-show-alt me-1"></i> View</a>
                                                            <a class="dropdown-item" href="{{ route('admin.teachers.edit', $teacher) }}"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="text-center py-4">
                                    <div class="avatar mx-auto mb-3">
                                        <span class="avatar-initial rounded-circle bg-label-secondary">
                                            <i class="bx bx-user-check bx-md"></i>
                                        </span>
                                    </div>
                                    <h6>No Teachers Yet</h6>
                                    <p class="text-muted">Start by adding your first teacher to the system.</p>
                                    <a href="{{ route('admin.teachers.create') }}" class="btn btn-primary">
                                        <i class="bx bx-plus me-1"></i> Add First Teacher
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- / Content -->
    </div>
    <!-- Content wrapper -->
</x-dashboard-layout>
