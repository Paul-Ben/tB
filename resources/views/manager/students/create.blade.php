@extends('layouts.dashboard')

@section('title', 'Add New Student')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Student Management /</span> Add New Student
    </h4>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Student Information</h5>
                    <a href="{{ route('manager.students.index') }}" class="btn btn-outline-secondary">
                        <i class="bx bx-arrow-back me-1"></i>Back to Students
                    </a>
                </div>
                <div class="card-body">
                    <form action="{{ route('manager.students.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- Personal Information Section -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h6 class="text-primary mb-3">
                                    <i class="bx bx-user me-1"></i>Personal Information
                                </h6>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="first_name" class="form-label">First Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('first_name') is-invalid @enderror" 
                                       id="first_name" name="first_name" value="{{ old('first_name') }}" required>
                                @error('first_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="last_name" class="form-label">Last Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('last_name') is-invalid @enderror" 
                                       id="last_name" name="last_name" value="{{ old('last_name') }}" required>
                                @error('last_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="std_number" class="form-label">Student Number <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('std_number') is-invalid @enderror" 
                                       id="std_number" name="std_number" value="{{ old('std_number') }}" required>
                                @error('std_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Must be unique across all students</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="date_of_birth" class="form-label">Date of Birth <span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror" 
                                       id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') }}" required>
                                @error('date_of_birth')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="gender" class="form-label">Gender <span class="text-danger">*</span></label>
                                <select class="form-select @error('gender') is-invalid @enderror" id="gender" name="gender" required>
                                    <option value="">Select Gender</option>
                                    <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                                </select>
                                @error('gender')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="nationality" class="form-label">Nationality <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nationality') is-invalid @enderror" 
                                       id="nationality" name="nationality" value="{{ old('nationality') }}" required>
                                @error('nationality')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="image" class="form-label">Student Photo</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                       id="image" name="image" accept="image/*">
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Optional. Max size: 2MB. Formats: JPG, PNG, GIF</div>
                            </div>
                        </div>

                        <!-- Medical Information Section -->
                        <div class="row mb-4 mt-4">
                            <div class="col-12">
                                <h6 class="text-primary mb-3">
                                    <i class="bx bx-plus-medical me-1"></i>Medical Information
                                </h6>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="genotype" class="form-label">Genotype</label>
                                <select class="form-select @error('genotype') is-invalid @enderror" id="genotype" name="genotype">
                                    <option value="">Select Genotype</option>
                                    <option value="AA" {{ old('genotype') == 'AA' ? 'selected' : '' }}>AA</option>
                                    <option value="AS" {{ old('genotype') == 'AS' ? 'selected' : '' }}>AS</option>
                                    <option value="SS" {{ old('genotype') == 'SS' ? 'selected' : '' }}>SS</option>
                                    <option value="AC" {{ old('genotype') == 'AC' ? 'selected' : '' }}>AC</option>
                                    <option value="SC" {{ old('genotype') == 'SC' ? 'selected' : '' }}>SC</option>
                                </select>
                                @error('genotype')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="bgroup" class="form-label">Blood Group</label>
                                <select class="form-select @error('bgroup') is-invalid @enderror" id="bgroup" name="bgroup">
                                    <option value="">Select Blood Group</option>
                                    <option value="A+" {{ old('bgroup') == 'A+' ? 'selected' : '' }}>A+</option>
                                    <option value="A-" {{ old('bgroup') == 'A-' ? 'selected' : '' }}>A-</option>
                                    <option value="B+" {{ old('bgroup') == 'B+' ? 'selected' : '' }}>B+</option>
                                    <option value="B-" {{ old('bgroup') == 'B-' ? 'selected' : '' }}>B-</option>
                                    <option value="AB+" {{ old('bgroup') == 'AB+' ? 'selected' : '' }}>AB+</option>
                                    <option value="AB-" {{ old('bgroup') == 'AB-' ? 'selected' : '' }}>AB-</option>
                                    <option value="O+" {{ old('bgroup') == 'O+' ? 'selected' : '' }}>O+</option>
                                    <option value="O-" {{ old('bgroup') == 'O-' ? 'selected' : '' }}>O-</option>
                                </select>
                                @error('bgroup')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Academic Information Section -->
                        <div class="row mb-4 mt-4">
                            <div class="col-12">
                                <h6 class="text-primary mb-3">
                                    <i class="bx bx-book me-1"></i>Academic Information
                                </h6>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="guardian_id" class="form-label">Guardian <span class="text-danger">*</span></label>
                                <select class="form-select @error('guardian_id') is-invalid @enderror" id="guardian_id" name="guardian_id" required>
                                    <option value="">Select Guardian</option>
                                    @foreach($guardians as $guardian)
                                        <option value="{{ $guardian->id }}" {{ old('guardian_id') == $guardian->id ? 'selected' : '' }}>
                                            {{ $guardian->guardian_name }} ({{ $guardian->guardian_phone }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('guardian_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="class_id" class="form-label">Classroom <span class="text-danger">*</span></label>
                                <select class="form-select @error('class_id') is-invalid @enderror" id="class_id" name="class_id" required>
                                    <option value="">Select Classroom</option>
                                    @foreach($classrooms as $classroom)
                                        <option value="{{ $classroom->id }}" {{ old('class_id') == $classroom->id ? 'selected' : '' }}>
                                            {{ $classroom->name }} ({{ $classroom->classCategory->name ?? 'N/A' }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('class_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="current_session" class="form-label">Current Session <span class="text-danger">*</span></label>
                                <select class="form-select @error('current_session') is-invalid @enderror" id="current_session" name="current_session" required>
                                    <option value="">Select Session</option>
                                    @foreach($sessions as $session)
                                        <option value="{{ $session->id }}" {{ old('current_session') == $session->id ? 'selected' : '' }}>
                                            {{ $session->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('current_session')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('manager.students.index') }}" class="btn btn-outline-secondary">
                                        <i class="bx bx-x me-1"></i>Cancel
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bx bx-check me-1"></i>Create Student
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
// Auto-generate student number based on current year and random number
document.addEventListener('DOMContentLoaded', function() {
    const stdNumberInput = document.getElementById('std_number');
    if (stdNumberInput && !stdNumberInput.value) {
        const currentYear = new Date().getFullYear();
        const randomNum = Math.floor(Math.random() * 10000).toString().padStart(4, '0');
        stdNumberInput.value = `STD${currentYear}${randomNum}`;
    }
});

// Preview image before upload
document.getElementById('image').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            // Create preview if it doesn't exist
            let preview = document.getElementById('imagePreview');
            if (!preview) {
                preview = document.createElement('img');
                preview.id = 'imagePreview';
                preview.className = 'mt-2 rounded';
                preview.style.maxWidth = '150px';
                preview.style.maxHeight = '150px';
                document.getElementById('image').parentNode.appendChild(preview);
            }
            preview.src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
});
</script>
@endpush
@endsection