<x-dashboard-layout>
    <x-slot name="title">Teacher Details</x-slot>

    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4">
                <span class="text-muted fw-light">Teacher Management /</span> Teacher Details
            </h4>

            <!-- Alert Messages -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row">
                <!-- Teacher Profile -->
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="card-title mb-0">Teacher Profile</h5>
                            <div class="d-flex gap-2">
                                <a href="{{ route('manager.teachers.edit', $teacher) }}" class="btn btn-primary">
                                    <i class="bx bx-edit me-1"></i> Edit
                                </a>
                                <a href="{{ route('manager.teachers.index') }}" class="btn btn-outline-secondary">
                                    <i class="bx bx-arrow-back me-1"></i> Back to Teachers
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Teacher Header -->
                            <div class="d-flex align-items-center mb-4">
                                <div class="avatar avatar-xl me-3">
                                    @if($teacher->image)
                                        <img src="{{ asset('storage/' . $teacher->image) }}" alt="Avatar" class="rounded-circle">
                                    @else
                                        <img src="{{ asset('assets/img/avatars/1.png') }}" alt="Avatar" class="rounded-circle">
                                    @endif
                                </div>
                                <div>
                                    <h4 class="mb-1">{{ $teacher->full_name }}</h4>
                                    <p class="text-muted mb-1">{{ $teacher->email }}</p>
                                    @if($teacher->user->email_verified_at)
                                        <span class="badge bg-success">
                                            <i class="bx bx-check me-1"></i>Verified Account
                                        </span>
                                    @else
                                        <span class="badge bg-warning">
                                            <i class="bx bx-time me-1"></i>Unverified Account
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Personal Information -->
                            <div class="mb-4">
                                <h6 class="mb-3 text-primary">
                                    <i class="bx bx-user me-1"></i> Personal Information
                                </h6>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="info-item mb-3">
                                            <label class="form-label text-muted">Full Name</label>
                                            <p class="mb-0">{{ $teacher->full_name }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="info-item mb-3">
                                            <label class="form-label text-muted">Email Address</label>
                                            <p class="mb-0">{{ $teacher->email }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="info-item mb-3">
                                            <label class="form-label text-muted">Date of Birth</label>
                                            <p class="mb-0">
                                                @if($teacher->date_of_birth)
                                                    {{ $teacher->date_of_birth->format('F j, Y') }}
                                                    <small class="text-muted">({{ $teacher->date_of_birth->age }} years old)</small>
                                                @else
                                                    <span class="text-muted">Not provided</span>
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="info-item mb-3">
                                            <label class="form-label text-muted">Phone Number</label>
                                            <p class="mb-0">{{ $teacher->phone_number ?: 'Not provided' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Professional Information -->
                            <div class="mb-4">
                                <h6 class="mb-3 text-primary">
                                    <i class="bx bx-briefcase me-1"></i> Professional Information
                                </h6>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="info-item mb-3">
                                            <label class="form-label text-muted">Qualification</label>
                                            <p class="mb-0">
                                                @if($teacher->qualification)
                                                    <span class="badge bg-label-info">{{ $teacher->qualification }}</span>
                                                @else
                                                    <span class="text-muted">Not specified</span>
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="info-item mb-3">
                                            <label class="form-label text-muted">Teacher ID</label>
                                            <p class="mb-0">#{{ $teacher->id }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Contact Information -->
                            <div class="mb-4">
                                <h6 class="mb-3 text-primary">
                                    <i class="bx bx-map me-1"></i> Contact Information
                                </h6>
                                <div class="info-item">
                                    <label class="form-label text-muted">Address</label>
                                    <p class="mb-0">
                                        @if($teacher->address)
                                            {{ $teacher->address }}
                                        @else
                                            <span class="text-muted">No address provided</span>
                                        @endif
                                    </p>
                                </div>
                            </div>

                            <!-- Account Information -->
                            <div class="mb-4">
                                <h6 class="mb-3 text-primary">
                                    <i class="bx bx-shield me-1"></i> Account Information
                                </h6>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="info-item mb-3">
                                            <label class="form-label text-muted">Account Created</label>
                                            <p class="mb-0">{{ $teacher->created_at->format('F j, Y \a\t g:i A') }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="info-item mb-3">
                                            <label class="form-label text-muted">Last Updated</label>
                                            <p class="mb-0">{{ $teacher->updated_at->format('F j, Y \a\t g:i A') }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="info-item mb-3">
                                            <label class="form-label text-muted">Email Verification</label>
                                            <p class="mb-0">
                                                @if($teacher->user->email_verified_at)
                                                    <span class="text-success">
                                                        <i class="bx bx-check me-1"></i>
                                                        Verified on {{ $teacher->user->email_verified_at->format('F j, Y') }}
                                                    </span>
                                                @else
                                                    <span class="text-warning">
                                                        <i class="bx bx-time me-1"></i>
                                                        Not verified
                                                    </span>
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="info-item mb-3">
                                            <label class="form-label text-muted">Last Login</label>
                                            <p class="mb-0">
                                                @if($teacher->user->last_login_at)
                                                    {{ $teacher->user->last_login_at->format('F j, Y \a\t g:i A') }}
                                                @else
                                                    <span class="text-muted">Never logged in</span>
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Actions Panel -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="bx bx-cog me-1"></i> Quick Actions
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="d-grid gap-2">
                                <a href="{{ route('manager.teachers.edit', $teacher) }}" class="btn btn-primary">
                                    <i class="bx bx-edit me-1"></i> Edit Teacher
                                </a>
                                
                                <form method="POST" action="{{ route('manager.teachers.toggle-verification', $teacher) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-info w-100">
                                        @if($teacher->user->email_verified_at)
                                            <i class="bx bx-x me-1"></i> Remove Verification
                                        @else
                                            <i class="bx bx-check me-1"></i> Verify Email
                                        @endif
                                    </button>
                                </form>
                                
                                <form method="POST" action="{{ route('manager.teachers.resend-welcome-email', $teacher) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-success w-100">
                                        <i class="bx bx-envelope me-1"></i> Resend Welcome Email
                                    </button>
                                </form>

                                <hr>

                                <button type="button" class="btn btn-outline-danger w-100" onclick="confirmDelete()">
                                    <i class="bx bx-trash me-1"></i> Delete Teacher
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Statistics Card -->
                    <div class="card mt-4">
                        <div class="card-header">
                            <h6 class="card-title mb-0">
                                <i class="bx bx-stats me-1"></i> Teacher Statistics
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="text-muted">Days Since Joined:</span>
                                <strong>{{ $teacher->created_at->diffInDays(now()) }}</strong>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="text-muted">Profile Completion:</span>
                                @php
                                    $fields = ['first_name', 'last_name', 'email', 'phone_number', 'qualification', 'address', 'date_of_birth'];
                                    $completed = 0;
                                    foreach($fields as $field) {
                                        if($teacher->$field) $completed++;
                                    }
                                    $percentage = round(($completed / count($fields)) * 100);
                                @endphp
                                <strong>{{ $percentage }}%</strong>
                            </div>
                            <div class="progress mb-3" style="height: 6px;">
                                <div class="progress-bar" role="progressbar" style="width: {{ $percentage }}%" aria-valuenow="{{ $percentage }}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-muted">Account Status:</span>
                                @if($teacher->user->email_verified_at)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-warning">Pending</span>
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
                    <p>Are you sure you want to delete teacher <strong>{{ $teacher->full_name }}</strong>?</p>
                    <p class="text-muted">This action cannot be undone and will permanently remove:</p>
                    <ul class="text-muted">
                        <li>Teacher profile and information</li>
                        <li>Associated user account</li>
                        <li>All related data and records</li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form method="POST" action="{{ route('manager.teachers.destroy', $teacher) }}" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete Teacher</button>
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