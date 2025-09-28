<x-dashboard-layout>
    <x-slot name="title">Edit Teacher</x-slot>

    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4">
                <span class="text-muted fw-light">Teacher Management /</span> Edit Teacher
            </h4>

            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="card-title mb-0">Edit Teacher Information</h5>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.teachers.show', $teacher) }}" class="btn btn-outline-info">
                                    <i class="bx bx-show me-1"></i> View
                                </a>
                                <a href="{{ route('admin.teachers.index') }}" class="btn btn-outline-secondary">
                                    <i class="bx bx-arrow-back me-1"></i> Back to Teachers
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

                            <form method="POST" action="{{ route('admin.teachers.update', $teacher) }}">
                                @csrf
                                @method('PUT')
                                
                                <!-- Personal Information -->
                                <div class="mb-4">
                                    <h6 class="mb-3 text-primary">
                                        <i class="bx bx-user me-1"></i> Personal Information
                                    </h6>
                                    
                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <label class="form-label" for="first_name">First Name *</label>
                                            <input 
                                                type="text" 
                                                class="form-control @error('first_name') is-invalid @enderror" 
                                                id="first_name" 
                                                name="first_name" 
                                                value="{{ old('first_name', $teacher->first_name) }}" 
                                                placeholder="Enter first name" 
                                                required
                                            >
                                            @error('first_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="middle_name">Middle Name</label>
                                            <input 
                                                type="text" 
                                                class="form-control @error('middle_name') is-invalid @enderror" 
                                                id="middle_name" 
                                                name="middle_name" 
                                                value="{{ old('middle_name', $teacher->middle_name) }}" 
                                                placeholder="Enter middle name"
                                            >
                                            @error('middle_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="last_name">Last Name *</label>
                                            <input 
                                                type="text" 
                                                class="form-control @error('last_name') is-invalid @enderror" 
                                                id="last_name" 
                                                name="last_name" 
                                                value="{{ old('last_name', $teacher->last_name) }}" 
                                                placeholder="Enter last name" 
                                                required
                                            >
                                            @error('last_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label" for="email">Email Address *</label>
                                            <input 
                                                type="email" 
                                                class="form-control @error('email') is-invalid @enderror" 
                                                id="email" 
                                                name="email" 
                                                value="{{ old('email', $teacher->email) }}" 
                                                placeholder="Enter email address" 
                                                required
                                            >
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label" for="date_of_birth">Date of Birth</label>
                                            <input 
                                                type="date" 
                                                class="form-control @error('date_of_birth') is-invalid @enderror" 
                                                id="date_of_birth" 
                                                name="date_of_birth" 
                                                value="{{ old('date_of_birth', $teacher->date_of_birth?->format('Y-m-d')) }}"
                                                max="{{ date('Y-m-d') }}"
                                            >
                                            @error('date_of_birth')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Contact Information -->
                                <div class="mb-4">
                                    <h6 class="mb-3 text-primary">
                                        <i class="bx bx-phone me-1"></i> Contact Information
                                    </h6>
                                    
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label" for="phone_number">Phone Number</label>
                                            <input 
                                                type="tel" 
                                                class="form-control @error('phone_number') is-invalid @enderror" 
                                                id="phone_number" 
                                                name="phone_number" 
                                                value="{{ old('phone_number', $teacher->phone_number) }}" 
                                                placeholder="Enter phone number"
                                            >
                                            @error('phone_number')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label" for="qualification">Qualification</label>
                                            <input 
                                                type="text" 
                                                class="form-control @error('qualification') is-invalid @enderror" 
                                                id="qualification" 
                                                name="qualification" 
                                                value="{{ old('qualification', $teacher->qualification) }}" 
                                                placeholder="e.g., Bachelor's in Education"
                                            >
                                            @error('qualification')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="address">Address</label>
                                        <textarea 
                                            class="form-control @error('address') is-invalid @enderror" 
                                            id="address" 
                                            name="address" 
                                            rows="3" 
                                            placeholder="Enter full address"
                                        >{{ old('address', $teacher->address) }}</textarea>
                                        @error('address')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row justify-content-end">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary me-2">
                                            <i class="bx bx-check me-1"></i> Update Teacher
                                        </button>
                                        <a href="{{ route('admin.teachers.index') }}" class="btn btn-outline-secondary">
                                            <i class="bx bx-x me-1"></i> Cancel
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Teacher Info Panel -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="bx bx-user me-1"></i> Teacher Details
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="avatar avatar-lg me-3">
                                    <img src="{{ asset('assets/img/avatars/1.png') }}" alt="Avatar" class="rounded-circle">
                                </div>
                                <div>
                                    <h6 class="mb-0">{{ $teacher->full_name }}</h6>
                                    <small class="text-muted">{{ $teacher->email }}</small>
                                </div>
                            </div>

                            <div class="info-list">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="text-muted">Teacher ID:</span>
                                    <span>#{{ $teacher->id }}</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="text-muted">Account Status:</span>
                                    @if($teacher->user->email_verified_at)
                                        <span class="badge bg-success">Verified</span>
                                    @else
                                        <span class="badge bg-warning">Unverified</span>
                                    @endif
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="text-muted">Joined:</span>
                                    <span>{{ $teacher->created_at->format('M j, Y') }}</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-muted">Last Updated:</span>
                                    <span>{{ $teacher->updated_at->format('M j, Y') }}</span>
                                </div>
                            </div>

                            <div class="mt-4">
                                <h6 class="mb-3">Quick Actions</h6>
                                <div class="d-grid gap-2">
                                    <form method="POST" action="{{ route('admin.teachers.toggle-verification', $teacher) }}">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-info w-100">
                                            @if($teacher->user->email_verified_at)
                                                <i class="bx bx-x me-1"></i> Remove Verification
                                            @else
                                                <i class="bx bx-check me-1"></i> Verify Email
                                            @endif
                                        </button>
                                    </form>
                                    
                                    <form method="POST" action="{{ route('admin.teachers.resend-welcome-email', $teacher) }}">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-success w-100">
                                            <i class="bx bx-envelope me-1"></i> Resend Welcome Email
                                        </button>
                                    </form>

                                    <button type="button" class="btn btn-outline-danger w-100" onclick="confirmDelete()">
                                        <i class="bx bx-trash me-1"></i> Delete Teacher
                                    </button>
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
                    <form method="POST" action="{{ route('admin.teachers.destroy', $teacher) }}" class="d-inline">
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