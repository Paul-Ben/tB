<x-dashboard-layout>
    <x-slot name="title">Edit User</x-slot>

    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4">
                <span class="text-muted fw-light">User Management /</span> Edit User
            </h4>

            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="card-title mb-0">Edit User Information</h5>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.users.show', $user) }}" class="btn btn-outline-info">
                                    <i class="bx bx-show me-1"></i> View
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

                            <form method="POST" action="{{ route('admin.users.update', $user) }}">
                                @csrf
                                @method('PUT')
                                
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label" for="name">Full Name</label>
                                    <div class="col-sm-9">
                                        <input 
                                            type="text" 
                                            class="form-control @error('name') is-invalid @enderror" 
                                            id="name" 
                                            name="name" 
                                            value="{{ old('name', $user->name) }}" 
                                            placeholder="Enter full name" 
                                            required
                                        >
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label" for="email">Email Address</label>
                                    <div class="col-sm-9">
                                        <input 
                                            type="email" 
                                            class="form-control @error('email') is-invalid @enderror" 
                                            id="email" 
                                            name="email" 
                                            value="{{ old('email', $user->email) }}" 
                                            placeholder="Enter email address" 
                                            required
                                        >
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label" for="role">User Role</label>
                                    <div class="col-sm-9">
                                        @php
                                            $currentRole = old('role', $user->getPrimaryRole());
                                        @endphp
                                        <select class="form-select @error('role') is-invalid @enderror" id="role" name="role" required>
                                            <option value="">Select Role</option>
                                            @foreach($roles as $role)
                                                <option value="{{ $role->name }}" {{ $currentRole == $role->name ? 'selected' : '' }}>
                                                    {{ ucfirst($role->name) }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('role')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        @if($currentRole)
                                            <div class="form-text">
                                                Current role: <span class="badge bg-label-primary">{{ ucfirst($currentRole) }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label" for="password">New Password</label>
                                    <div class="col-sm-9">
                                        <div class="input-group input-group-merge">
                                            <input 
                                                type="password" 
                                                class="form-control @error('password') is-invalid @enderror" 
                                                id="password" 
                                                name="password" 
                                                placeholder="Enter new password (leave blank to keep current)"
                                            >
                                            <span class="input-group-text cursor-pointer" id="password-toggle">
                                                <i class="bx bx-hide"></i>
                                            </span>
                                        </div>
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">
                                            Leave blank to keep the current password. New password must be at least 8 characters long.
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label class="col-sm-3 col-form-label" for="password_confirmation">Confirm Password</label>
                                    <div class="col-sm-9">
                                        <div class="input-group input-group-merge">
                                            <input 
                                                type="password" 
                                                class="form-control" 
                                                id="password_confirmation" 
                                                name="password_confirmation" 
                                                placeholder="Confirm new password"
                                            >
                                            <span class="input-group-text cursor-pointer" id="password-confirm-toggle">
                                                <i class="bx bx-hide"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row justify-content-end">
                                    <div class="col-sm-9">
                                        <button type="submit" class="btn btn-primary me-2">
                                            <i class="bx bx-check me-1"></i> Update User
                                        </button>
                                        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">
                                            <i class="bx bx-x me-1"></i> Cancel
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- User Info Panel -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="bx bx-user me-1"></i> User Details
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="avatar avatar-lg me-3">
                                    <img src="{{ asset('assets/img/avatars/1.png') }}" alt="Avatar" class="rounded-circle">
                                </div>
                                <div>
                                    <h6 class="mb-0">{{ $user->name }}</h6>
                                    <small class="text-muted">{{ $user->email }}</small>
                                </div>
                            </div>

                            <div class="info-list">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="text-muted">User ID:</span>
                                    <span>#{{ $user->id }}</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="text-muted">Current Role:</span>
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
                                    <span class="badge {{ $badgeClass }}">{{ ucfirst($role) }}</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="text-muted">Status:</span>
                                    @if($user->email_verified_at)
                                        <span class="badge bg-success">Verified</span>
                                    @else
                                        <span class="badge bg-warning">Unverified</span>
                                    @endif
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="text-muted">Joined:</span>
                                    <span>{{ $user->created_at->format('M j, Y') }}</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-muted">Last Updated:</span>
                                    <span>{{ $user->updated_at->format('M j, Y') }}</span>
                                </div>
                            </div>

                            <div class="mt-4">
                                <h6 class="mb-3">Quick Actions</h6>
                                <div class="d-grid gap-2">
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
                                        <button type="button" class="btn btn-outline-danger w-100" onclick="confirmDelete()">
                                            <i class="bx bx-trash me-1"></i> Delete User
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Change Log -->
                    <div class="card mt-3">
                        <div class="card-header">
                            <h6 class="card-title mb-0">
                                <i class="bx bx-history me-1"></i> Account History
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
                                        </div>
                                    </div>
                                @endif
                                
                                <div class="timeline-item">
                                    <div class="timeline-point-wrapper">
                                        <div class="timeline-point timeline-point-info"></div>
                                    </div>
                                    <div class="timeline-content">
                                        <h6 class="timeline-title">Last Updated</h6>
                                        <small class="text-muted">{{ $user->updated_at->format('M j, Y \a\t g:i A') }}</small>
                                    </div>
                                </div>
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
                    <p>Are you sure you want to delete user <strong>{{ $user->name }}</strong>?</p>
                    <p class="text-muted">This action cannot be undone and will permanently remove:</p>
                    <ul class="text-muted">
                        <li>User account and profile</li>
                        <li>All associated data</li>
                        <li>Access permissions and role assignments</li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form method="POST" action="{{ route('admin.users.destroy', $user) }}" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete User</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Password visibility toggle
        document.getElementById('password-toggle').addEventListener('click', function() {
            const password = document.getElementById('password');
            const icon = this.querySelector('i');
            
            if (password.type === 'password') {
                password.type = 'text';
                icon.className = 'bx bx-show';
            } else {
                password.type = 'password';
                icon.className = 'bx bx-hide';
            }
        });

        document.getElementById('password-confirm-toggle').addEventListener('click', function() {
            const passwordConfirm = document.getElementById('password_confirmation');
            const icon = this.querySelector('i');
            
            if (passwordConfirm.type === 'password') {
                passwordConfirm.type = 'text';
                icon.className = 'bx bx-show';
            } else {
                passwordConfirm.type = 'password';
                icon.className = 'bx bx-hide';
            }
        });

        // Real-time password match validation
        document.getElementById('password_confirmation').addEventListener('input', function() {
            const password = document.getElementById('password').value;
            const confirmPassword = this.value;
            
            if (password && confirmPassword && password !== confirmPassword) {
                this.classList.add('is-invalid');
                if (!this.nextElementSibling || !this.nextElementSibling.classList.contains('invalid-feedback')) {
                    const feedback = document.createElement('div');
                    feedback.className = 'invalid-feedback';
                    feedback.textContent = 'Passwords do not match';
                    this.parentNode.appendChild(feedback);
                }
            } else {
                this.classList.remove('is-invalid');
                const feedback = this.parentNode.querySelector('.invalid-feedback');
                if (feedback) {
                    feedback.remove();
                }
            }
        });

        // Delete confirmation
        function confirmDelete() {
            const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
            modal.show();
        }

        // Clear password confirmation when password is cleared
        document.getElementById('password').addEventListener('input', function() {
            if (!this.value) {
                const confirmPassword = document.getElementById('password_confirmation');
                confirmPassword.value = '';
                confirmPassword.classList.remove('is-invalid');
                const feedback = confirmPassword.parentNode.querySelector('.invalid-feedback');
                if (feedback) {
                    feedback.remove();
                }
            }
        });
    </script>
    @endpush
</x-dashboard-layout>