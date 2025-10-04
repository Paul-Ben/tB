@extends('layouts.dashboard')

@section('title', 'Edit Guardian')

@section('content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 mb-0">Edit Guardian</h1>
                    <p class="text-muted">Update guardian information and profile</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('manager.guardians.show', $guardian) }}" class="btn btn-outline-info">
                        <i class="fas fa-eye me-2"></i>View Profile
                    </a>
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
                    <form action="{{ route('manager.guardians.update', $guardian) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Personal Information -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h6 class="text-primary mb-3">Personal Information</h6>
                            </div>
                            
                            <div class="col-md-6">
                                <label for="guardian_name" class="form-label">Full Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('guardian_name') is-invalid @enderror" 
                                       id="guardian_name" name="guardian_name" 
                                       value="{{ old('guardian_name', $guardian->guardian_name) }}" required>
                                @error('guardian_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="guardian_email" class="form-label">Email Address <span class="text-danger">*</span></label>
                                <input type="email" class="form-control @error('guardian_email') is-invalid @enderror" 
                                       id="guardian_email" name="guardian_email" 
                                       value="{{ old('guardian_email', $guardian->guardian_email) }}" required>
                                @error('guardian_email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="guardian_phone" class="form-label">Phone Number <span class="text-danger">*</span></label>
                                <input type="tel" class="form-control @error('guardian_phone') is-invalid @enderror" 
                                       id="guardian_phone" name="guardian_phone" 
                                       value="{{ old('guardian_phone', $guardian->guardian_phone) }}" required>
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
                                <div class="form-text">Maximum file size: 2MB. Leave empty to keep current image.</div>
                                
                                @if($guardian->image)
                                    <div class="mt-2">
                                        <small class="text-muted">Current image:</small>
                                        <div class="mt-1">
                                            <img src="{{ asset('storage/' . $guardian->image) }}" 
                                                 alt="Current profile picture" 
                                                 class="img-thumbnail" 
                                                 style="max-width: 100px; max-height: 100px;">
                                        </div>
                                    </div>
                                @endif
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
                                          id="address" name="address" rows="3">{{ old('address', $guardian->address) }}</textarea>
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="nationality" class="form-label">Nationality</label>
                                <input type="text" class="form-control @error('nationality') is-invalid @enderror" 
                                       id="nationality" name="nationality" 
                                       value="{{ old('nationality', $guardian->nationality) }}">
                                @error('nationality')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="stateoforigin" class="form-label">State of Origin</label>
                                <input type="text" class="form-control @error('stateoforigin') is-invalid @enderror" 
                                       id="stateoforigin" name="stateoforigin" 
                                       value="{{ old('stateoforigin', $guardian->stateoforigin) }}">
                                @error('stateoforigin')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="lga" class="form-label">Local Government Area</label>
                                <input type="text" class="form-control @error('lga') is-invalid @enderror" 
                                       id="lga" name="lga" 
                                       value="{{ old('lga', $guardian->lga) }}">
                                @error('lga')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Password Update (Optional) -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h6 class="text-primary mb-3">Update Password (Optional)</h6>
                                <p class="text-muted small">Leave password fields empty to keep the current password.</p>
                            </div>
                            
                            <div class="col-md-6">
                                <label for="password" class="form-label">New Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                       id="password" name="password">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Minimum 8 characters</div>
                            </div>

                            <div class="col-md-6">
                                <label for="password_confirmation" class="form-label">Confirm New Password</label>
                                <input type="password" class="form-control" 
                                       id="password_confirmation" name="password_confirmation">
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="row">
                            <div class="col-12">
                                <hr>
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('manager.guardians.show', $guardian) }}" class="btn btn-outline-secondary">
                                        Cancel
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-2"></i>Update Guardian
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Guardian Info Sidebar -->
        <div class="col-lg-4">
            <!-- Current Guardian Info -->
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title mb-0">
                        <i class="fas fa-user me-2"></i>Current Guardian Info
                    </h6>
                </div>
                <div class="card-body">
                    <div class="text-center mb-3">
                        @if($guardian->image)
                            <img src="{{ asset('storage/' . $guardian->image) }}" 
                                 alt="{{ $guardian->guardian_name }}" 
                                 class="rounded-circle img-thumbnail" 
                                 style="width: 80px; height: 80px; object-fit: cover;">
                        @else
                            <div class="bg-primary rounded-circle d-inline-flex align-items-center justify-content-center" 
                                 style="width: 80px; height: 80px;">
                                <i class="fas fa-user text-white fa-2x"></i>
                            </div>
                        @endif
                        <h6 class="mt-2 mb-0">{{ $guardian->guardian_name }}</h6>
                        <small class="text-muted">Guardian ID: #{{ $guardian->id }}</small>
                    </div>

                    <div class="row text-center">
                        <div class="col-6">
                            <div class="border-end">
                                <h5 class="text-primary mb-0">{{ $guardian->students->count() }}</h5>
                                <small class="text-muted">Students</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <h5 class="text-success mb-0">{{ $guardian->created_at->format('M Y') }}</h5>
                            <small class="text-muted">Joined</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Update Guidelines -->
            <div class="card mt-3">
                <div class="card-header">
                    <h6 class="card-title mb-0">
                        <i class="fas fa-info-circle me-2"></i>Update Guidelines
                    </h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <h6 class="text-primary">Important Notes</h6>
                        <ul class="list-unstyled small">
                            <li><i class="fas fa-exclamation-triangle text-warning me-2"></i>Email changes will affect login credentials</li>
                            <li><i class="fas fa-shield-alt text-info me-2"></i>Password updates are optional</li>
                            <li><i class="fas fa-image text-secondary me-2"></i>New images will replace existing ones</li>
                        </ul>
                    </div>

                    <div class="alert alert-warning">
                        <small>
                            <i class="fas fa-exclamation-circle me-2"></i>
                            Changes to email or password will require the guardian to use new credentials for login.
                        </small>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card mt-3">
                <div class="card-header">
                    <h6 class="card-title mb-0">
                        <i class="fas fa-bolt me-2"></i>Quick Actions
                    </h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('manager.guardians.show', $guardian) }}" class="btn btn-outline-info btn-sm">
                            <i class="fas fa-eye me-2"></i>View Full Profile
                        </a>
                        @if($guardian->students->count() > 0)
                            <button class="btn btn-outline-primary btn-sm" disabled>
                                <i class="fas fa-users me-2"></i>View Students ({{ $guardian->students->count() }})
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection