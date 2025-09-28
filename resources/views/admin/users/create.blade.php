<x-dashboard-layout>
    <x-slot name="title">Add New User</x-slot>

    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4">
                <span class="text-muted fw-light">User Management /</span> Add New User
            </h4>

            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="card-title mb-0">User Information</h5>
                            <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">
                                <i class="bx bx-arrow-back me-1"></i> Back to Users
                            </a>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.users.store') }}">
                                @csrf
                                
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label" for="name">Full Name</label>
                                    <div class="col-sm-9">
                                        <input 
                                            type="text" 
                                            class="form-control @error('name') is-invalid @enderror" 
                                            id="name" 
                                            name="name" 
                                            value="{{ old('name') }}" 
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
                                            value="{{ old('email') }}" 
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
                                        <select class="form-select @error('role') is-invalid @enderror" id="role" name="role" required>
                                            <option value="">Select Role</option>
                                            @foreach($roles as $role)
                                                <option value="{{ $role->name }}" {{ old('role') == $role->name ? 'selected' : '' }}>
                                                    {{ ucfirst($role->name) }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('role')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">
                                            This determines what permissions the user will have in the system.
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label" for="password">Password</label>
                                    <div class="col-sm-9">
                                        <div class="input-group input-group-merge">
                                            <input 
                                                type="password" 
                                                class="form-control @error('password') is-invalid @enderror" 
                                                id="password" 
                                                name="password" 
                                                placeholder="Enter password" 
                                                required
                                            >
                                            <span class="input-group-text cursor-pointer" id="password-toggle">
                                                <i class="bx bx-hide"></i>
                                            </span>
                                            @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-text">
                                            Password must be at least 8 characters long.
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
                                                placeholder="Confirm password" 
                                                required
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
                                            <i class="bx bx-check me-1"></i> Create User
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

                <!-- Info Panel -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="bx bx-info-circle me-1"></i> User Creation Info
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-info">
                                <h6 class="alert-heading">
                                    <i class="bx bx-lightbulb me-1"></i> Tips
                                </h6>
                                <ul class="mb-0">
                                    <li>The user will receive an email notification once created</li>
                                    <li>They can change their password after first login</li>
                                    <li>User role determines their access level</li>
                                    <li>Email verification status can be managed later</li>
                                </ul>
                            </div>

                            <h6 class="mb-3">Role Descriptions</h6>
                            <div class="role-descriptions">
                                @foreach($roles as $role)
                                    <div class="mb-2">
                                        <span class="badge bg-label-primary">{{ ucfirst($role->name) }}</span>
                                        <small class="d-block text-muted mt-1">
                                            @switch($role->name)
                                                @case('admin')
                                                    Full system access and user management
                                                    @break
                                                @case('manager')
                                                    Manage teachers and view reports
                                                    @break
                                                @case('teacher')
                                                    Manage classes and student records
                                                    @break
                                                @case('guardian')
                                                    View student progress and communicate
                                                    @break
                                                @default
                                                    Standard user access
                                            @endswitch
                                        </small>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- / Content -->
    </div>
    <!-- Content wrapper -->

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
            
            if (confirmPassword && password !== confirmPassword) {
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
    </script>
    @endpush
</x-dashboard-layout>