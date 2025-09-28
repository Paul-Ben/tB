<x-dashboard-layout>
    <x-slot name="title">User Details</x-slot>

    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4">
                <span class="text-muted fw-light">User Management /</span> User Details
            </h4>

            <div class="row">
                <!-- User Profile -->
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="card-title mb-0">
                                <i class="bx bx-user me-1"></i> User Information
                            </h5>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-primary">
                                    <i class="bx bx-edit me-1"></i> Edit User
                                </a>
                                <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">
                                    <i class="bx bx-arrow-back me-1"></i> Back to Users
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            <div class="row">
                                <div class="col-12">
                                    <div class="d-flex align-items-center mb-4">
                                        <div class="avatar avatar-xl me-4">
                                            <img src="{{ asset('assets/img/avatars/1.png') }}" alt="Avatar" class="rounded-circle">
                                        </div>
                                        <div>
                                            <h4 class="mb-1">{{ $user->name }}</h4>
                                            <p class="text-muted mb-2">{{ $user->email }}</p>
                                            @php
                                                $role = $user->getPrimaryRole() ?? 'No Role';
                                                $badgeClass = match($role) {
                                                    'admin' => 'bg-label-primary',
                                                    'manager' => 'bg-label-success',
                                                    'teacher' => 'bg-label-info',
                                                    'guardian' => 'bg-label-warning',
                                                    default => 'bg-label-secondary'
                                                };
                                            @endphp
                                            <span class="badge {{ $badgeClass }} me-2">{{ ucfirst($role) }}</span>
                                            @if($user->email_verified_at)
                                                <span class="badge bg-success">
                                                    <i class="bx bx-check me-1"></i>Verified
                                                </span>
                                            @else
                                                <span class="badge bg-warning">
                                                    <i class="bx bx-time me-1"></i>Unverified
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- User Details Table -->
                            <div class="table-responsive">
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <td class="px-0 py-3">
                                                <strong class="text-muted">User ID</strong>
                                            </td>
                                            <td class="px-0 py-3">#{{ $user->id }}</td>
                                        </tr>
                                        <tr>
                                            <td class="px-0 py-3">
                                                <strong class="text-muted">Full Name</strong>
                                            </td>
                                            <td class="px-0 py-3">{{ $user->name }}</td>
                                        </tr>
                                        <tr>
                                            <td class="px-0 py-3">
                                                <strong class="text-muted">Email Address</strong>
                                            </td>
                                            <td class="px-0 py-3">{{ $user->email }}</td>
                                        </tr>
                                        <tr>
                                            <td class="px-0 py-3">
                                                <strong class="text-muted">Role</strong>
                                            </td>
                                            <td class="px-0 py-3">
                                                <span class="badge {{ $badgeClass }}">{{ ucfirst($role) }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="px-0 py-3">
                                                <strong class="text-muted">Email Verification</strong>
                                            </td>
                                            <td class="px-0 py-3">
                                                @if($user->email_verified_at)
                                                    <span class="badge bg-success me-2">
                                                        <i class="bx bx-check me-1"></i>Verified
                                                    </span>
                                                    <small class="text-muted">on {{ $user->email_verified_at->format('M j, Y \a\t g:i A') }}</small>
                                                @else
                                                    <span class="badge bg-warning">
                                                        <i class="bx bx-time me-1"></i>Unverified
                                                    </span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="px-0 py-3">
                                                <strong class="text-muted">Account Created</strong>
                                            </td>
                                            <td class="px-0 py-3">{{ $user->created_at->format('M j, Y \a\t g:i A') }}</td>
                                        </tr>
                                        <tr>
                                            <td class="px-0 py-3">
                                                <strong class="text-muted">Last Updated</strong>
                                            </td>
                                            <td class="px-0 py-3">{{ $user->updated_at->format('M j, Y \a\t g:i A') }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Role & Permissions -->
                    <div class="card mt-4">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="bx bx-shield me-1"></i> Role & Permissions
                            </h5>
                        </div>
                        <div class="card-body">
                            @if($user->roles->count() > 0)
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6 class="mb-3">Assigned Roles</h6>
                                        @foreach($user->roles as $userRole)
                                            @php
                                                $roleBadgeClass = match($userRole->name) {
                                                    'admin' => 'bg-primary',
                                                    'manager' => 'bg-success',
                                                    'teacher' => 'bg-info',
                                                    'guardian' => 'bg-warning',
                                                    default => 'bg-secondary'
                                                };
                                            @endphp
                                            <span class="badge {{ $roleBadgeClass }} me-2 mb-2">
                                                <i class="bx bx-user me-1"></i>{{ ucfirst($userRole->name) }}
                                            </span>
                                        @endforeach
                                    </div>
                                    <div class="col-md-6">
                                        <h6 class="mb-3">Role Description</h6>
                                        <p class="text-muted">
                                            @switch($role)
                                                @case('admin')
                                                    Full system access and user management capabilities. Can manage all users, roles, and system settings.
                                                    @break
                                                @case('manager')
                                                    Manage teachers and view reports. Can oversee educational operations and staff management.
                                                    @break
                                                @case('teacher')
                                                    Manage classes and student records. Can create and manage educational content and track student progress.
                                                    @break
                                                @case('guardian')
                                                    View student progress and communicate with teachers. Can monitor child's educational journey.
                                                    @break
                                                @default
                                                    Standard user access with basic permissions.
                                            @endswitch
                                        </p>
                                    </div>
                                </div>
                            @else
                                <div class="text-center py-4">
                                    <div class="avatar mx-auto mb-3">
                                        <span class="avatar-initial rounded-circle bg-label-warning">
                                            <i class="bx bx-error-circle bx-md"></i>
                                        </span>
                                    </div>
                                    <h6>No Role Assigned</h6>
                                    <p class="text-muted">This user has no roles assigned. Consider assigning a role to grant appropriate permissions.</p>
                                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-primary">
                                        <i class="bx bx-plus me-1"></i> Assign Role
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-md-4">
                    <!-- Quick Actions -->
                    <div class="card">
                        <div class="card-header">
                            <h6 class="card-title mb-0">
                                <i class="bx bx-zap me-1"></i> Quick Actions
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="d-grid gap-2">
                                <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-primary">
                                    <i class="bx bx-edit me-1"></i> Edit User
                                </a>
                                
                                <form method="POST" action="{{ route('admin.users.toggle-verification', $user) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-info w-100">
                                        @if($user->email_verified_at)
                                            <i class="bx bx-x me-1"></i> Remove Verification
                                        @else
                                            <i class="bx bx-check me-1"></i> Verify Email
                                        @endif
                                    </button>
                                </form>
                                
                                @if($user->id !== auth()->id())
                                    <button type="button" class="btn btn-outline-danger" onclick="confirmDelete()">
                                        <i class="bx bx-trash me-1"></i> Delete User
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Account Statistics -->
                    <div class="card mt-4">
                        <div class="card-header">
                            <h6 class="card-title mb-0">
                                <i class="bx bx-stats me-1"></i> Account Statistics
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="text-muted">Days since joined:</span>
                                <strong>{{ $user->created_at->diffInDays(now()) }}</strong>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="text-muted">Profile updates:</span>
                                <strong>{{ $user->created_at->eq($user->updated_at) ? '0' : '1+' }}</strong>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-muted">Account status:</span>
                                @if($user->email_verified_at)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-warning">Pending</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Activity Timeline -->
                    <div class="card mt-4">
                        <div class="card-header">
                            <h6 class="card-title mb-0">
                                <i class="bx bx-time me-1"></i> Account Timeline
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="timeline timeline-sm">
                                <div class="timeline-item">
                                    <div class="timeline-point-wrapper">
                                        <div class="timeline-point timeline-point-primary"></div>
                                    </div>
                                    <div class="timeline-content">
                                        <h6 class="timeline-title">Account Created</h6>
                                        <small class="text-muted">{{ $user->created_at->format('M j, Y \a\t g:i A') }}</small>
                                        <p class="mt-1 mb-0">User account was created in the system</p>
                                    </div>
                                </div>
                                
                                @if($user->email_verified_at)
                                    <div class="timeline-item">
                                        <div class="timeline-point-wrapper">
                                            <div class="timeline-point timeline-point-success"></div>
                                        </div>
                                        <div class="timeline-content">
                                            <h6 class="timeline-title">Email Verified</h6>
                                            <small class="text-muted">{{ $user->email_verified_at->format('M j, Y \a\t g:i A') }}</small>
                                            <p class="mt-1 mb-0">Email address was verified successfully</p>
                                        </div>
                                    </div>
                                @endif
                                
                                @if(!$user->created_at->eq($user->updated_at))
                                    <div class="timeline-item">
                                        <div class="timeline-point-wrapper">
                                            <div class="timeline-point timeline-point-info"></div>
                                        </div>
                                        <div class="timeline-content">
                                            <h6 class="timeline-title">Profile Updated</h6>
                                            <small class="text-muted">{{ $user->updated_at->format('M j, Y \a\t g:i A') }}</small>
                                            <p class="mt-1 mb-0">User information was last modified</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- / Content -->
    </div>
    <!-- Content wrapper -->

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <div class="avatar mx-auto mb-3">
                            <span class="avatar-initial rounded-circle bg-label-danger">
                                <i class="bx bx-trash bx-md"></i>
                            </span>
                        </div>
                        <h5>Delete User Account</h5>
                        <p>Are you sure you want to delete <strong>{{ $user->name }}</strong>?</p>
                        <p class="text-muted">This action cannot be undone and will permanently remove:</p>
                        <ul class="text-muted text-start">
                            <li>User account and profile information</li>
                            <li>All associated data and records</li>
                            <li>Access permissions and role assignments</li>
                            <li>Any related system activities</li>
                        </ul>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <i class="bx bx-x me-1"></i> Cancel
                    </button>
                    <form method="POST" action="{{ route('admin.users.destroy', $user) }}" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="bx bx-trash me-1"></i> Delete User
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Delete confirmation
        function confirmDelete() {
            const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
            modal.show();
        }
    </script>
    @endpush
</x-dashboard-layout>