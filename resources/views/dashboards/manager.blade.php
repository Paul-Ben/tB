<x-dashboard-layout>
    <x-slot name="title">Manager Dashboard</x-slot>

    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> Manager Overview</h4>

            <!-- Statistics Cards -->
            <div class="row">
                <div class="col-lg-6 col-md-6 col-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <img src="{{ asset('assets/img/icons/unicons/chart-success.png') }}" alt="Teachers" class="rounded">
                                </div>
                                <div class="dropdown">
                                    <button class="btn p-0" type="button" id="cardOpt1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt1">
                                        <a class="dropdown-item" href="{{ route('manager.teachers.index') }}">View All Teachers</a>
                                        <a class="dropdown-item" href="{{ route('manager.teachers.create') }}">Add Teacher</a>
                                    </div>
                                </div>
                            </div>
                            <span class="fw-semibold d-block mb-1">Total Teachers</span>
                            <h3 class="card-title mb-2">{{ $teacherCount }}</h3>
                            <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> Active teachers</small>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6 col-md-6 col-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <img src="{{ asset('assets/img/icons/unicons/wallet-info.png') }}" alt="Guardians" class="rounded">
                                </div>
                                <div class="dropdown">
                                    <button class="btn p-0" type="button" id="cardOpt2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt2">
                                        <a class="dropdown-item" href="javascript:void(0);">View All Guardians</a>
                                        <a class="dropdown-item" href="javascript:void(0);">Send Communication</a>
                                    </div>
                                </div>
                            </div>
                            <span class="fw-semibold d-block mb-1">Total Guardians</span>
                            <h3 class="card-title mb-2">{{ $guardianCount }}</h3>
                            <small class="text-info fw-semibold"><i class="bx bx-user"></i> Registered guardians</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="row">
                <div class="col-lg-4 col-md-6 col-12 mb-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <div class="avatar mx-auto mb-3">
                                <span class="avatar-initial rounded-circle bg-label-primary">
                                    <i class="bx bx-user-check bx-md"></i>
                                </span>
                            </div>
                            <h5 class="card-title">Manage Teachers</h5>
                            <p class="card-text">Add, edit, or remove teachers from the system</p>
                            <a href="{{ route('manager.teachers.index') }}" class="btn btn-primary">Manage Teachers</a>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6 col-12 mb-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <div class="avatar mx-auto mb-3">
                                <span class="avatar-initial rounded-circle bg-label-success">
                                    <i class="bx bx-book-open bx-md"></i>
                                </span>
                            </div>
                            <h5 class="card-title">Manage Classes</h5>
                            <p class="card-text">Organize classes and assignments</p>
                            <a href="#" class="btn btn-success">Manage Classes</a>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6 col-12 mb-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <div class="avatar mx-auto mb-3">
                                <span class="avatar-initial rounded-circle bg-label-info">
                                    <i class="bx bx-bar-chart-alt-2 bx-md"></i>
                                </span>
                            </div>
                            <h5 class="card-title">View Reports</h5>
                            <p class="card-text">Generate and view detailed reports</p>
                            <a href="#" class="btn btn-info">View Reports</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Users -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="card-title m-0">Recent Users</h5>
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
                                                        'teacher' => 'bg-label-success',
                                                        'guardian' => 'bg-label-info',
                                                        'admin' => 'bg-label-primary',
                                                        'manager' => 'bg-label-warning',
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
                                                        <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-show-alt me-1"></i> View</a>
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
            </div>
        </div>
        <!-- / Content -->
    </div>
    <!-- Content wrapper -->
</x-dashboard-layout>