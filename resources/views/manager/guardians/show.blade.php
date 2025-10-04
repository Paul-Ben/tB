@extends('layouts.dashboard')

@section('title', 'Guardian Details')

@section('content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 mb-0">Guardian Details</h1>
                    <p class="text-muted">Complete guardian profile and information</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('manager.guardians.edit', $guardian) }}" class="btn btn-outline-primary">
                        <i class="fas fa-edit me-2"></i>Edit Guardian
                    </a>
                    <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                        <i class="fas fa-trash me-2"></i>Delete
                    </button>
                    <a href="{{ route('manager.guardians.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-2"></i>All Guardians
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Main Profile Information -->
        <div class="col-lg-8">
            <!-- Basic Information Card -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-user me-2"></i>Basic Information
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 text-center">
                            @if($guardian->image)
                                <img src="{{ asset('storage/' . $guardian->image) }}" 
                                     alt="{{ $guardian->guardian_name }}" 
                                     class="rounded-circle img-thumbnail mb-3" 
                                     style="width: 120px; height: 120px; object-fit: cover;">
                            @else
                                <div class="bg-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                                     style="width: 120px; height: 120px;">
                                    <i class="fas fa-user text-white fa-3x"></i>
                                </div>
                            @endif
                            <h5 class="mb-1">{{ $guardian->guardian_name }}</h5>
                            <p class="text-muted small">Guardian ID: #{{ $guardian->id }}</p>
                        </div>
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label text-muted small">Full Name</label>
                                    <p class="mb-0">{{ $guardian->guardian_name }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label text-muted small">Email Address</label>
                                    <p class="mb-0">
                                        <a href="mailto:{{ $guardian->guardian_email }}" class="text-decoration-none">
                                            {{ $guardian->guardian_email }}
                                        </a>
                                    </p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label text-muted small">Phone Number</label>
                                    <p class="mb-0">
                                        <a href="tel:{{ $guardian->guardian_phone }}" class="text-decoration-none">
                                            {{ $guardian->guardian_phone }}
                                        </a>
                                    </p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label text-muted small">Account Status</label>
                                    <p class="mb-0">
                                        <span class="badge bg-success">Active</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Location Information Card -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-map-marker-alt me-2"></i>Location Information
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label class="form-label text-muted small">Address</label>
                            <p class="mb-0">{{ $guardian->address ?: 'Not provided' }}</p>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label text-muted small">Nationality</label>
                            <p class="mb-0">{{ $guardian->nationality ?: 'Not specified' }}</p>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label text-muted small">State of Origin</label>
                            <p class="mb-0">{{ $guardian->stateoforigin ?: 'Not specified' }}</p>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label text-muted small">Local Government Area</label>
                            <p class="mb-0">{{ $guardian->lga ?: 'Not specified' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Students Information Card -->
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-users me-2"></i>Associated Students
                    </h5>
                    <span class="badge bg-primary">{{ $guardian->students->count() }} Student(s)</span>
                </div>
                <div class="card-body">
                    @if($guardian->students->count() > 0)
                        <div class="row">
                            @foreach($guardian->students as $student)
                                <div class="col-md-6 mb-3">
                                    <a href="{{ route('manager.students.show', $student) }}" class="text-decoration-none">
                                        <div class="border rounded p-3 student-tile">
                                            <div class="d-flex align-items-center">
                                                @if($student->image)
                                                     <img src="{{ asset('storage/' . $student->image) }}" 
                                                          alt="{{ $student->first_name }} {{ $student->last_name }}" 
                                                          class="rounded-circle me-3" 
                                                          style="width: 50px; height: 50px; object-fit: cover;">
                                                 @else
                                                    <div class="bg-secondary rounded-circle d-flex align-items-center justify-content-center me-3" 
                                                         style="width: 50px; height: 50px;">
                                                        <i class="fas fa-user text-white"></i>
                                                    </div>
                                                @endif
                                                <div class="flex-grow-1">
                                                     <h6 class="mb-1 text-dark">{{ $student->first_name }} {{ $student->last_name }}</h6>
                                                     <small class="text-muted d-block">Student No: {{ $student->std_number }}</small>
                                                     @if($student->classroom)
                                                         <small class="text-info d-block">
                                                             <i class="fas fa-graduation-cap me-1"></i>{{ $student->classroom->name }}
                                                         </small>
                                                     @else
                                                         <small class="text-warning d-block">
                                                             <i class="fas fa-exclamation-triangle me-1"></i>No Class Assigned
                                                         </small>
                                                     @endif
                                                 </div>
                                                <div class="ms-2">
                                                    <i class="fas fa-chevron-right text-muted"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-users text-muted fa-3x mb-3"></i>
                            <h6 class="text-muted">No Students Associated</h6>
                            <p class="text-muted small">This guardian currently has no students assigned to them.</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Account Information Card -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-cog me-2"></i>Account Information
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted small">User Account</label>
                            <p class="mb-0">
                                @if($guardian->user)
                                    <span class="badge bg-success">Linked</span>
                                    <small class="text-muted d-block">User ID: #{{ $guardian->user->id }}</small>
                                @else
                                    <span class="badge bg-warning">Not Linked</span>
                                @endif
                            </p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted small">Registration Date</label>
                            <p class="mb-0">{{ $guardian->created_at->format('F j, Y') }}</p>
                            <small class="text-muted">{{ $guardian->created_at->diffForHumans() }}</small>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted small">Last Updated</label>
                            <p class="mb-0">{{ $guardian->updated_at->format('F j, Y') }}</p>
                            <small class="text-muted">{{ $guardian->updated_at->diffForHumans() }}</small>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted small">Profile Completion</label>
                            <p class="mb-0">
                                @php
                                    $fields = ['guardian_name', 'guardian_email', 'guardian_phone', 'address', 'nationality', 'stateoforigin', 'lga', 'image'];
                                    $completed = 0;
                                    foreach($fields as $field) {
                                        if(!empty($guardian->$field)) $completed++;
                                    }
                                    $percentage = round(($completed / count($fields)) * 100);
                                @endphp
                                <div class="progress" style="height: 20px;">
                                    <div class="progress-bar" role="progressbar" style="width: {{ $percentage }}%">
                                        {{ $percentage }}%
                                    </div>
                                </div>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Quick Actions -->
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="card-title mb-0">
                        <i class="fas fa-bolt me-2"></i>Quick Actions
                    </h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('manager.guardians.edit', $guardian) }}" class="btn btn-primary">
                            <i class="fas fa-edit me-2"></i>Edit Guardian
                        </a>
                        <a href="mailto:{{ $guardian->guardian_email }}" class="btn btn-outline-info">
                            <i class="fas fa-envelope me-2"></i>Send Email
                        </a>
                        <a href="tel:{{ $guardian->guardian_phone }}" class="btn btn-outline-success">
                            <i class="fas fa-phone me-2"></i>Call Guardian
                        </a>
                        <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                            <i class="fas fa-trash me-2"></i>Delete Guardian
                        </button>
                    </div>
                </div>
            </div>

            <!-- Guardian Statistics -->
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="card-title mb-0">
                        <i class="fas fa-chart-bar me-2"></i>Guardian Statistics
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-6">
                            <div class="border-end">
                                <h4 class="text-primary mb-0">{{ $guardian->students->count() }}</h4>
                                <small class="text-muted">Students</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <h4 class="text-success mb-0">{{ $guardian->created_at->diffInDays() }}</h4>
                            <small class="text-muted">Days Active</small>
                        </div>
                    </div>
                    <hr>
                    <div class="row text-center">
                        <div class="col-12">
                            <h5 class="text-info mb-0">{{ $percentage }}%</h5>
                            <small class="text-muted">Profile Complete</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title mb-0">
                        <i class="fas fa-clock me-2"></i>Recent Activity
                    </h6>
                </div>
                <div class="card-body">
                    <div class="timeline">
                        <div class="timeline-item">
                            <div class="timeline-marker bg-success"></div>
                            <div class="timeline-content">
                                <h6 class="timeline-title">Profile Created</h6>
                                <p class="timeline-text">Guardian account was created</p>
                                <small class="text-muted">{{ $guardian->created_at->diffForHumans() }}</small>
                            </div>
                        </div>
                        @if($guardian->updated_at != $guardian->created_at)
                            <div class="timeline-item">
                                <div class="timeline-marker bg-info"></div>
                                <div class="timeline-content">
                                    <h6 class="timeline-title">Profile Updated</h6>
                                    <p class="timeline-text">Guardian information was modified</p>
                                    <small class="text-muted">{{ $guardian->updated_at->diffForHumans() }}</small>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <i class="fas fa-exclamation-triangle text-warning fa-3x mb-3"></i>
                    <h5>Are you sure you want to delete this guardian?</h5>
                    <p class="text-muted">
                        This action will permanently delete <strong>{{ $guardian->guardian_name }}</strong> 
                        and cannot be undone.
                    </p>
                    @if($guardian->students->count() > 0)
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            This guardian has {{ $guardian->students->count() }} associated student(s). 
                            Please reassign or remove these associations before deletion.
                        </div>
                    @endif
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                @if($guardian->students->count() == 0)
                    <form action="{{ route('manager.guardians.destroy', $guardian) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash me-2"></i>Delete Guardian
                        </button>
                    </form>
                @else
                    <button type="button" class="btn btn-danger" disabled>
                        <i class="fas fa-ban me-2"></i>Cannot Delete
                    </button>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
.timeline {
    position: relative;
    padding-left: 30px;
}

.timeline-item {
    position: relative;
    margin-bottom: 20px;
}

.timeline-marker {
    position: absolute;
    left: -35px;
    top: 5px;
    width: 10px;
    height: 10px;
    border-radius: 50%;
}

.timeline-item:not(:last-child)::before {
    content: '';
    position: absolute;
    left: -31px;
    top: 15px;
    width: 2px;
    height: calc(100% + 10px);
    background-color: #dee2e6;
}

.timeline-title {
    font-size: 0.9rem;
    margin-bottom: 5px;
}

.timeline-text {
    font-size: 0.8rem;
    margin-bottom: 5px;
    color: #6c757d;
}

/* Student tile styles */
.student-tile {
    transition: all 0.3s ease;
    cursor: pointer;
    border: 1px solid #dee2e6 !important;
}

.student-tile:hover {
    border-color: #0d6efd !important;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transform: translateY(-2px);
    background-color: #f8f9fa;
}

.student-tile:hover .fas.fa-chevron-right {
    color: #0d6efd !important;
    transform: translateX(3px);
}

.student-tile .fas.fa-chevron-right {
    transition: all 0.3s ease;
}

.student-tile:hover h6 {
    color: #0d6efd !important;
}
</style>
@endsection