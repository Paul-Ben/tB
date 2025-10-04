@extends('layouts.dashboard')

@section('title', 'Add Guardian')

@section('content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 mb-0">Add New Guardian</h1>
                    <p class="text-muted">Create a new guardian account and profile</p>
                </div>
                <div>
                    <a href="{{ route('manager.guardians.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Back to Guardians
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Main Form -->
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Guardian Information</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('manager.guardians.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Personal Information -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h6 class="text-primary mb-3">Personal Information</h6>
                            </div>
                            
                            <div class="col-md-6">
                                <label for="guardian_name" class="form-label">Full Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('guardian_name') is-invalid @enderror" 
                                       id="guardian_name" name="guardian_name" value="{{ old('guardian_name') }}" required>
                                @error('guardian_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="guardian_email" class="form-label">Email Address <span class="text-danger">*</span></label>
                                <input type="email" class="form-control @error('guardian_email') is-invalid @enderror" 
                                       id="guardian_email" name="guardian_email" value="{{ old('guardian_email') }}" required>
                                @error('guardian_email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="guardian_phone" class="form-label">Phone Number <span class="text-danger">*</span></label>
                                <input type="tel" class="form-control @error('guardian_phone') is-invalid @enderror" 
                                       id="guardian_phone" name="guardian_phone" value="{{ old('guardian_phone') }}" required>
                                @error('guardian_phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="image" class="form-label">Profile Picture</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                       id="image" name="image" accept="image/*">
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Maximum file size: 2MB. Supported formats: JPEG, PNG, JPG, GIF</div>
                            </div>
                        </div>

                        <!-- Location Information -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h6 class="text-primary mb-3">Location Information</h6>
                            </div>
                            
                            <div class="col-12 mb-3">
                                <label for="address" class="form-label">Address</label>
                                <textarea class="form-control @error('address') is-invalid @enderror" 
                                          id="address" name="address" rows="3">{{ old('address') }}</textarea>
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="nationality" class="form-label">Nationality</label>
                                <input type="text" class="form-control @error('nationality') is-invalid @enderror" 
                                       id="nationality" name="nationality" value="{{ old('nationality') }}">
                                @error('nationality')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="stateoforigin" class="form-label">State of Origin</label>
                                <input type="text" class="form-control @error('stateoforigin') is-invalid @enderror" 
                                       id="stateoforigin" name="stateoforigin" value="{{ old('stateoforigin') }}">
                                @error('stateoforigin')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="lga" class="form-label">Local Government Area</label>
                                <input type="text" class="form-control @error('lga') is-invalid @enderror" 
                                       id="lga" name="lga" value="{{ old('lga') }}">
                                @error('lga')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Account Information -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h6 class="text-primary mb-3">Account Information</h6>
                                <p class="text-muted small">A user account will be created for this guardian to access the system.</p>
                            </div>
                            
                            <div class="col-md-6">
                                <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                       id="password" name="password" required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Minimum 8 characters</div>
                            </div>

                            <div class="col-md-6">
                                <label for="password_confirmation" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" 
                                       id="password_confirmation" name="password_confirmation" required>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="row">
                            <div class="col-12">
                                <hr>
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('manager.guardians.index') }}" class="btn btn-outline-secondary">
                                        Cancel
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-2"></i>Create Guardian
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Help Sidebar -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title mb-0">
                        <i class="fas fa-info-circle me-2"></i>Guardian Creation Guidelines
                    </h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <h6 class="text-primary">Required Information</h6>
                        <ul class="list-unstyled small">
                            <li><i class="fas fa-check text-success me-2"></i>Full name</li>
                            <li><i class="fas fa-check text-success me-2"></i>Valid email address</li>
                            <li><i class="fas fa-check text-success me-2"></i>Phone number</li>
                            <li><i class="fas fa-check text-success me-2"></i>Secure password</li>
                        </ul>
                    </div>

                    <div class="mb-3">
                        <h6 class="text-primary">Best Practices</h6>
                        <ul class="list-unstyled small">
                            <li><i class="fas fa-lightbulb text-warning me-2"></i>Use a unique email for each guardian</li>
                            <li><i class="fas fa-lightbulb text-warning me-2"></i>Ensure phone numbers are current</li>
                            <li><i class="fas fa-lightbulb text-warning me-2"></i>Complete location information helps with records</li>
                            <li><i class="fas fa-lightbulb text-warning me-2"></i>Profile pictures improve identification</li>
                        </ul>
                    </div>

                    <div class="alert alert-info">
                        <small>
                            <i class="fas fa-info-circle me-2"></i>
                            After creation, the guardian will be able to log in using their email and password to access their dashboard.
                        </small>
                    </div>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="card mt-3">
                <div class="card-header">
                    <h6 class="card-title mb-0">
                        <i class="fas fa-chart-bar me-2"></i>Current Statistics
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-6">
                            <div class="border-end">
                                <h4 class="text-primary mb-0">{{ \App\Models\Guardian::count() }}</h4>
                                <small class="text-muted">Total Guardians</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <h4 class="text-success mb-0">{{ \App\Models\Guardian::count() }}</h4>
                            <small class="text-muted">Active Accounts</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection