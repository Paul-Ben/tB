<x-dashboard-layout>
    <x-slot name="title">Add New Teacher</x-slot>

    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4">
                <span class="text-muted fw-light">Teacher Management /</span> Add New Teacher
            </h4>

            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="card-title mb-0">Teacher Information</h5>
                            <a href="{{ route('manager.teachers.index') }}" class="btn btn-outline-secondary">
                                <i class="bx bx-arrow-back me-1"></i> Back to Teachers
                            </a>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('manager.teachers.store') }}">
                                @csrf
                                
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
                                                value="{{ old('first_name') }}" 
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
                                                value="{{ old('middle_name') }}" 
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
                                                value="{{ old('last_name') }}" 
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
                                                value="{{ old('email') }}" 
                                                placeholder="Enter email address" 
                                                required
                                            >
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <div class="form-text">This will be used as the login email</div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label" for="date_of_birth">Date of Birth</label>
                                            <input 
                                                type="date" 
                                                class="form-control @error('date_of_birth') is-invalid @enderror" 
                                                id="date_of_birth" 
                                                name="date_of_birth" 
                                                value="{{ old('date_of_birth') }}"
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
                                                value="{{ old('phone_number') }}" 
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
                                                value="{{ old('qualification') }}" 
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
                                        >{{ old('address') }}</textarea>
                                        @error('address')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row justify-content-end">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary me-2">
                                            <i class="bx bx-check me-1"></i> Create Teacher Account
                                        </button>
                                        <a href="{{ route('manager.teachers.index') }}" class="btn btn-outline-secondary">
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
                                <i class="bx bx-info-circle me-1"></i> Teacher Account Setup
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-info">
                                <h6 class="alert-heading">
                                    <i class="bx bx-lightbulb me-1"></i> Important Information
                                </h6>
                                <ul class="mb-0">
                                    <li><strong>Automatic Account:</strong> A user account with teacher role will be created automatically</li>
                                    <li><strong>Default Password:</strong> Teacher@123</li>
                                    <li><strong>Email Notification:</strong> Welcome email with login details will be sent</li>
                                    <li><strong>Password Change:</strong> Teacher should change password on first login</li>
                                </ul>
                            </div>

                            <div class="mt-4">
                                <h6 class="mb-3">Account Features</h6>
                                <div class="d-flex align-items-center mb-2">
                                    <i class="bx bx-check-circle text-success me-2"></i>
                                    <span>Access to teacher dashboard</span>
                                </div>
                                <div class="d-flex align-items-center mb-2">
                                    <i class="bx bx-check-circle text-success me-2"></i>
                                    <span>Class management tools</span>
                                </div>
                                <div class="d-flex align-items-center mb-2">
                                    <i class="bx bx-check-circle text-success me-2"></i>
                                    <span>Student progress tracking</span>
                                </div>
                                <div class="d-flex align-items-center mb-2">
                                    <i class="bx bx-check-circle text-success me-2"></i>
                                    <span>Communication with parents</span>
                                </div>
                                <div class="d-flex align-items-center">
                                    <i class="bx bx-check-circle text-success me-2"></i>
                                    <span>Resource library access</span>
                                </div>
                            </div>

                            <div class="mt-4">
                                <h6 class="mb-3">Next Steps</h6>
                                <ol class="ps-3">
                                    <li>Teacher receives welcome email</li>
                                    <li>Teacher logs in and changes password</li>
                                    <li>Profile completion and photo upload</li>
                                    <li>Class assignment by administration</li>
                                </ol>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Stats -->
                    <div class="card mt-4">
                        <div class="card-header">
                            <h6 class="card-title mb-0">
                                <i class="bx bx-stats me-1"></i> System Statistics
                            </h6>
                        </div>
                        <div class="card-body">
                            @php
                                $teacherCount = \App\Models\Teacher::count();
                                $verifiedTeachers = \App\Models\Teacher::whereHas('user', function($q) {
                                    $q->whereNotNull('email_verified_at');
                                })->count();
                            @endphp
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="text-muted">Total Teachers:</span>
                                <strong>{{ $teacherCount }}</strong>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-muted">Verified Accounts:</span>
                                <strong>{{ $verifiedTeachers }}</strong>
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
        // Auto-populate full name preview
        function updateFullNamePreview() {
            const firstName = document.getElementById('first_name').value;
            const middleName = document.getElementById('middle_name').value;
            const lastName = document.getElementById('last_name').value;
            
            const names = [firstName, middleName, lastName].filter(name => name.trim() !== '');
            const fullName = names.join(' ');
            
            // You could add a preview element here if needed
        }

        document.getElementById('first_name').addEventListener('input', updateFullNamePreview);
        document.getElementById('middle_name').addEventListener('input', updateFullNamePreview);
        document.getElementById('last_name').addEventListener('input', updateFullNamePreview);

        // Validate form before submission
        document.querySelector('form').addEventListener('submit', function(e) {
            const requiredFields = ['first_name', 'last_name', 'email'];
            let hasErrors = false;

            requiredFields.forEach(fieldName => {
                const field = document.getElementById(fieldName);
                if (!field.value.trim()) {
                    field.classList.add('is-invalid');
                    hasErrors = true;
                } else {
                    field.classList.remove('is-invalid');
                }
            });

            if (hasErrors) {
                e.preventDefault();
                alert('Please fill in all required fields.');
            }
        });
    </script>
    @endpush
</x-dashboard-layout>