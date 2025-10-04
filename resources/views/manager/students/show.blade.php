@extends('layouts.dashboard')

@section('title', 'Student Profile - ' . $student->full_name)

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Student Management /</span> Student Profile
    </h4>

    <div class="row">
        <!-- Student Profile Card -->
        <div class="col-xl-4 col-lg-5 col-md-5 order-1 mb-4">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="user-avatar-section">
                        <div class="d-flex align-items-center flex-column">
                            @if($student->image)
                                <img class="img-fluid rounded my-4" 
                                     src="{{ asset('storage/' . $student->image) }}" 
                                     alt="{{ $student->full_name }}" 
                                     height="110" width="110">
                            @else
                                <div class="avatar avatar-xl my-4">
                                    <span class="avatar-initial rounded-circle bg-label-primary fs-2">
                                        {{ substr($student->first_name, 0, 1) }}{{ substr($student->last_name, 0, 1) }}
                                    </span>
                                </div>
                            @endif
                            <div class="user-info text-center">
                                <h4 class="mb-2">{{ $student->full_name }}</h4>
                                <span class="badge bg-label-info">{{ $student->std_number }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-around flex-wrap my-4 py-3">
                        <div class="d-flex align-items-start me-4 mt-3 gap-3">
                            <span class="badge bg-label-primary p-2 rounded">
                                <i class="bx bx-user bx-sm"></i>
                            </span>
                            <div>
                                <h5 class="mb-0">{{ $student->gender }}</h5>
                                <span>Gender</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-start mt-3 gap-3">
                            <span class="badge bg-label-primary p-2 rounded">
                                <i class="bx bx-calendar bx-sm"></i>
                            </span>
                            <div>
                                <h5 class="mb-0">{{ $student->date_of_birth?->age ?? 'N/A' }}</h5>
                                <span>Years Old</span>
                            </div>
                        </div>
                    </div>
                    <h5 class="pb-2 border-bottom mb-4">Details</h5>
                    <div class="info-container">
                        <ul class="list-unstyled">
                            <li class="mb-3">
                                <span class="fw-bold me-2">Full Name:</span>
                                <span>{{ $student->full_name }}</span>
                            </li>
                            <li class="mb-3">
                                <span class="fw-bold me-2">Student Number:</span>
                                <span>{{ $student->std_number }}</span>
                            </li>
                            <li class="mb-3">
                                <span class="fw-bold me-2">Date of Birth:</span>
                                <span>{{ $student->date_of_birth?->format('F j, Y') ?? 'Not specified' }}</span>
                            </li>
                            <li class="mb-3">
                                <span class="fw-bold me-2">Nationality:</span>
                                <span>{{ $student->nationality }}</span>
                            </li>
                            <li class="mb-3">
                                <span class="fw-bold me-2">Gender:</span>
                                <span class="badge bg-label-{{ $student->gender == 'Male' ? 'primary' : 'success' }}">
                                    {{ $student->gender }}
                                </span>
                            </li>
                        </ul>
                        <div class="d-flex justify-content-center pt-3">
                            <a href="{{ route('manager.students.edit', $student) }}" class="btn btn-primary me-3">
                                <i class="bx bx-edit-alt me-1"></i>Edit
                            </a>
                            <a href="{{ route('manager.students.index') }}" class="btn btn-outline-secondary">
                                <i class="bx bx-arrow-back me-1"></i>Back to List
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Student Information Cards -->
        <div class="col-xl-8 col-lg-7 col-md-7 order-0 mb-4">
            <!-- Academic Information -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="bx bx-book me-2"></i>Academic Information
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-primary">
                                        <i class="bx bx-home"></i>
                                    </span>
                                </div>
                                <div>
                                    <h6 class="mb-0">Classroom</h6>
                                    <small class="text-muted">
                                        {{ $student->classroom->name ?? 'Not assigned' }}
                                        @if($student->classroom && $student->classroom->classCategory)
                                            <br><span class="badge bg-label-info">{{ $student->classroom->classCategory->name }}</span>
                                        @endif
                                    </small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-success">
                                        <i class="bx bx-calendar-event"></i>
                                    </span>
                                </div>
                                <div>
                                    <h6 class="mb-0">Current Session</h6>
                                    <small class="text-muted">{{ $student->schoolSession->name ?? 'Not assigned' }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Guardian Information -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="bx bx-user-circle me-2"></i>Guardian Information
                    </h5>
                </div>
                <div class="card-body">
                    @if($student->guardian)
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-center">
                                    <div class="avatar flex-shrink-0 me-3">
                                        <span class="avatar-initial rounded bg-label-warning">
                                            <i class="bx bx-user"></i>
                                        </span>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">Guardian Name</h6>
                                        <small class="text-muted">{{ $student->guardian->guardian_name }}</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-center">
                                    <div class="avatar flex-shrink-0 me-3">
                                        <span class="avatar-initial rounded bg-label-info">
                                            <i class="bx bx-phone"></i>
                                        </span>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">Phone Number</h6>
                                        <small class="text-muted">{{ $student->guardian->guardian_phone ?? 'Not provided' }}</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-center">
                                    <div class="avatar flex-shrink-0 me-3">
                                        <span class="avatar-initial rounded bg-label-secondary">
                                            <i class="bx bx-envelope"></i>
                                        </span>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">Email</h6>
                                        <small class="text-muted">{{ $student->guardian->guardian_email ?? 'Not provided' }}</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-center">
                                    <div class="avatar flex-shrink-0 me-3">
                                        <span class="avatar-initial rounded bg-label-dark">
                                            <i class="bx bx-map"></i>
                                        </span>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">Address</h6>
                                        <small class="text-muted">{{ $student->guardian->guardian_address ?? 'Not provided' }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <a href="{{ route('manager.guardians.show', $student->guardian) }}" class="btn btn-outline-primary btn-sm">
                                <i class="bx bx-show me-1"></i>View Guardian Profile
                            </a>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="bx bx-user-x display-4 text-muted mb-2"></i>
                            <h6 class="text-muted">No Guardian Assigned</h6>
                            <p class="text-muted mb-3">This student doesn't have a guardian assigned yet.</p>
                            <a href="{{ route('manager.students.edit', $student) }}" class="btn btn-primary btn-sm">
                                <i class="bx bx-edit me-1"></i>Assign Guardian
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Medical Information -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="bx bx-plus-medical me-2"></i>Medical Information
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-danger">
                                        <i class="bx bx-dna"></i>
                                    </span>
                                </div>
                                <div>
                                    <h6 class="mb-0">Genotype</h6>
                                    <small class="text-muted">
                                        @if($student->genotype)
                                            <span class="badge bg-label-primary">{{ $student->genotype }}</span>
                                        @else
                                            Not specified
                                        @endif
                                    </small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-danger">
                                        <i class="bx bx-droplet"></i>
                                    </span>
                                </div>
                                <div>
                                    <h6 class="mb-0">Blood Group</h6>
                                    <small class="text-muted">
                                        @if($student->bgroup)
                                            <span class="badge bg-label-danger">{{ $student->bgroup }}</span>
                                        @else
                                            Not specified
                                        @endif
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if(!$student->genotype && !$student->bgroup)
                        <div class="alert alert-warning" role="alert">
                            <i class="bx bx-info-circle me-2"></i>
                            Medical information is not complete. Consider updating the student's medical details.
                        </div>
                    @endif
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="bx bx-cog me-2"></i>Actions
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mb-2">
                            <a href="{{ route('manager.students.edit', $student) }}" class="btn btn-primary w-100">
                                <i class="bx bx-edit-alt me-1"></i>Edit Student
                            </a>
                        </div>
                        <div class="col-md-4 mb-2">
                            <a href="{{ route('manager.students.index') }}" class="btn btn-outline-secondary w-100">
                                <i class="bx bx-list-ul me-1"></i>All Students
                            </a>
                        </div>
                        <div class="col-md-4 mb-2">
                            <button type="button" class="btn btn-outline-danger w-100" 
                                    onclick="confirmDelete('{{ $student->id }}', '{{ $student->full_name }}')">
                                <i class="bx bx-trash me-1"></i>Delete Student
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete student <strong id="studentName"></strong>?</p>
                <p class="text-danger"><small>This action cannot be undone and will remove all associated data.</small></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete Student</button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function confirmDelete(studentId, studentName) {
    document.getElementById('studentName').textContent = studentName;
    document.getElementById('deleteForm').action = `/manager/students/${studentId}`;
    new bootstrap.Modal(document.getElementById('deleteModal')).show();
}
</script>
@endpush
@endsection