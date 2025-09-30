@extends('layouts.dashboard')

@section('content')
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-lg-12 mb-4 order-0">
                    <div class="card">
                        <div class="d-flex align-items-end row">
                            <div class="col-sm-7">
                                <div class="card-body">
                                    <h5 class="card-title text-primary">Edit Subject</h5>
                                    <p class="mb-4">
                                        Update the subject information. You can modify the name, code, teacher assignment, and classroom.
                                    </p>
                                    <a href="{{ route('manager.subjects.index') }}" class="btn btn-sm btn-outline-primary me-2">
                                        <i class="bx bx-arrow-back me-1"></i>Back to Subjects
                                    </a>
                                    <a href="{{ route('manager.subjects.show', $subject) }}" class="btn btn-sm btn-outline-info">
                                        <i class="bx bx-show me-1"></i>View Subject
                                    </a>
                                </div>
                            </div>
                            <div class="col-sm-5 text-center text-sm-left">
                                <div class="card-body pb-0 px-0 px-md-4">
                                    <img src="{{ asset('assets/img/illustrations/man-with-laptop-light.png') }}" height="140" alt="Edit Subject" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit Subject Form -->
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">Subject Information</h5>
                            <small class="text-muted float-end">Update the subject details</small>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('manager.subjects.update', $subject) }}" method="POST">
                                @csrf
                                @method('PUT')
                                
                                <!-- Subject Name -->
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label" for="name">Subject Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                               id="name" name="name" value="{{ old('name', $subject->name) }}" 
                                               placeholder="e.g., Mathematics, English Literature">
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Subject Code -->
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label" for="code">Subject Code</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control @error('code') is-invalid @enderror" 
                                               id="code" name="code" value="{{ old('code', $subject->code) }}" 
                                               placeholder="e.g., MATH101, ENG201">
                                        @error('code')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">Unique identifier for the subject</div>
                                    </div>
                                </div>

                                <!-- Teacher Assignment -->
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label" for="teacher_id">Assigned Teacher</label>
                                    <div class="col-sm-9">
                                        <select class="form-select @error('teacher_id') is-invalid @enderror" 
                                                id="teacher_id" name="teacher_id">
                                            <option value="">Select a teacher</option>
                                            @foreach($teachers as $teacher)
                                                <option value="{{ $teacher->id }}" 
                                                    {{ old('teacher_id', $subject->teacher_id) == $teacher->id ? 'selected' : '' }}>
                                                    {{ $teacher->user->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('teacher_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">Choose the teacher who will handle this subject</div>
                                    </div>
                                </div>

                                <!-- Classroom Assignment -->
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label" for="classroom_id">Classroom</label>
                                    <div class="col-sm-9">
                                        <select class="form-select @error('classroom_id') is-invalid @enderror" 
                                                id="classroom_id" name="classroom_id">
                                            <option value="">Select a classroom</option>
                                            @foreach($classrooms as $classroom)
                                                <option value="{{ $classroom->id }}" 
                                                    {{ old('classroom_id', $subject->classroom_id) == $classroom->id ? 'selected' : '' }}>
                                                    {{ $classroom->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('classroom_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">Select the classroom where this subject will be taught</div>
                                    </div>
                                </div>

                                <!-- Form Actions -->
                                <div class="row">
                                    <div class="col-sm-9 offset-sm-3">
                                        <button type="submit" class="btn btn-primary me-2">
                                            <i class="bx bx-save me-1"></i>Update Subject
                                        </button>
                                        <a href="{{ route('manager.subjects.show', $subject) }}" class="btn btn-outline-info me-2">
                                            <i class="bx bx-show me-1"></i>View Subject
                                        </a>
                                        <a href="{{ route('manager.subjects.index') }}" class="btn btn-outline-secondary">
                                            <i class="bx bx-x me-1"></i>Cancel
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Subject Info Card -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="bx bx-info-circle me-2"></i>Current Subject Info
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <h6 class="fw-semibold">Subject Details:</h6>
                                <ul class="list-unstyled">
                                    <li class="mb-2">
                                        <strong>Name:</strong> {{ $subject->name }}
                                    </li>
                                    <li class="mb-2">
                                        <strong>Code:</strong> 
                                        <span class="badge bg-label-primary">{{ $subject->code }}</span>
                                    </li>
                                    <li class="mb-2">
                                        <strong>Teacher:</strong> 
                                        <span class="badge bg-label-info">{{ $subject->teacher->user->name ?? 'Not Assigned' }}</span>
                                    </li>
                                    <li class="mb-2">
                                        <strong>Classroom:</strong> 
                                        <span class="badge bg-label-secondary">{{ $subject->classroom->name ?? 'Not Assigned' }}</span>
                                    </li>
                                    <li class="mb-2">
                                        <strong>Created:</strong> {{ $subject->created_at->format('M d, Y') }}
                                    </li>
                                    <li>
                                        <strong>Last Updated:</strong> {{ $subject->updated_at->format('M d, Y') }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Help Card -->
                    <div class="card mt-3">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="bx bx-help-circle me-2"></i>Help & Tips
                            </h5>
                        </div>
                        <div class="card-body">
                            <h6 class="fw-semibold">Editing Guidelines:</h6>
                            <ul class="list-unstyled">
                                <li class="mb-2">
                                    <i class="bx bx-check text-success me-2"></i>
                                    <strong>Subject Code:</strong> Must remain unique
                                </li>
                                <li class="mb-2">
                                    <i class="bx bx-check text-success me-2"></i>
                                    <strong>Teacher:</strong> Can be changed anytime
                                </li>
                                <li class="mb-2">
                                    <i class="bx bx-check text-success me-2"></i>
                                    <strong>Classroom:</strong> Can be reassigned as needed
                                </li>
                            </ul>
                            
                            <div class="alert alert-warning">
                                <h6 class="alert-heading fw-bold mb-1">Warning:</h6>
                                <p class="mb-0">Changing assignments may affect ongoing classes and schedules.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- / Content -->
    </div>
@endsection