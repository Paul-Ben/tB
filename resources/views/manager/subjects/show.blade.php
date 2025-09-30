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
                                    <h5 class="card-title text-primary">Subject Details</h5>
                                    <p class="mb-4">
                                        View comprehensive information about <strong>{{ $subject->name }}</strong> including assignments and related data.
                                    </p>
                                    <a href="{{ route('manager.subjects.index') }}" class="btn btn-sm btn-outline-primary me-2">
                                        <i class="bx bx-arrow-back me-1"></i>Back to Subjects
                                    </a>
                                    <a href="{{ route('manager.subjects.edit', $subject) }}" class="btn btn-sm btn-primary">
                                        <i class="bx bx-edit-alt me-1"></i>Edit Subject
                                    </a>
                                </div>
                            </div>
                            <div class="col-sm-5 text-center text-sm-left">
                                <div class="card-body pb-0 px-0 px-md-4">
                                    <img src="{{ asset('assets/img/illustrations/man-with-laptop-light.png') }}" height="140" alt="Subject Details" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Success/Error Messages -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row">
                <!-- Subject Information -->
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">{{ $subject->name }}</h5>
                            <span class="badge bg-label-primary fs-6">{{ $subject->code }}</span>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h6 class="fw-semibold mb-3">Basic Information</h6>
                                    <table class="table table-borderless">
                                        <tr>
                                            <td class="fw-semibold">Subject Name:</td>
                                            <td>{{ $subject->name }}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-semibold">Subject Code:</td>
                                            <td><span class="badge bg-label-primary">{{ $subject->code }}</span></td>
                                        </tr>
                                        <tr>
                                            <td class="fw-semibold">Created:</td>
                                            <td>{{ $subject->created_at->format('M d, Y \a\t g:i A') }}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-semibold">Last Updated:</td>
                                            <td>{{ $subject->updated_at->format('M d, Y \a\t g:i A') }}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="fw-semibold mb-3">Assignments</h6>
                                    <table class="table table-borderless">
                                        <tr>
                                            <td class="fw-semibold">Assigned Teacher:</td>
                                            <td>
                                                @if($subject->teacher)
                                                    <span class="badge bg-label-info">{{ $subject->teacher->user->name }}</span>
                                                @else
                                                    <span class="badge bg-label-secondary">Not Assigned</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fw-semibold">Classroom:</td>
                                            <td>
                                                @if($subject->classroom)
                                                    <span class="badge bg-label-secondary">{{ $subject->classroom->name }}</span>
                                                @else
                                                    <span class="badge bg-label-warning">Not Assigned</span>
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Teacher Details -->
                    @if($subject->teacher)
                        <div class="card mt-4">
                            <div class="card-header">
                                <h5 class="mb-0">
                                    <i class="bx bx-user me-2"></i>Teacher Information
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-lg me-3">
                                        <span class="avatar-initial rounded-circle bg-label-info">
                                            {{ substr($subject->teacher->user->name, 0, 2) }}
                                        </span>
                                    </div>
                                    <div>
                                        <h6 class="mb-1">{{ $subject->teacher->user->name }}</h6>
                                        <p class="mb-0 text-muted">{{ $subject->teacher->user->email }}</p>
                                        <small class="text-muted">Teacher ID: {{ $subject->teacher->id }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Classroom Details -->
                    @if($subject->classroom)
                        <div class="card mt-4">
                            <div class="card-header">
                                <h5 class="mb-0">
                                    <i class="bx bx-building me-2"></i>Classroom Information
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <table class="table table-borderless">
                                            <tr>
                                                <td class="fw-semibold">Classroom Name:</td>
                                                <td>{{ $subject->classroom->name }}</td>
                                            </tr>
                                            <tr>
                                                <td class="fw-semibold">Capacity:</td>
                                                <td>{{ $subject->classroom->capacity ?? 'Not specified' }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table table-borderless">
                                            <tr>
                                                <td class="fw-semibold">Location:</td>
                                                <td>{{ $subject->classroom->location ?? 'Not specified' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="fw-semibold">Classroom ID:</td>
                                                <td>{{ $subject->classroom->id }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Actions & Quick Info -->
                <div class="col-md-4">
                    <!-- Quick Actions -->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="bx bx-cog me-2"></i>Quick Actions
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="d-grid gap-2">
                                <a href="{{ route('manager.subjects.edit', $subject) }}" class="btn btn-primary">
                                    <i class="bx bx-edit-alt me-1"></i>Edit Subject
                                </a>
                                <button type="button" class="btn btn-danger" onclick="confirmDelete()">
                                    <i class="bx bx-trash me-1"></i>Delete Subject
                                </button>
                                <a href="{{ route('manager.subjects.index') }}" class="btn btn-outline-secondary">
                                    <i class="bx bx-list-ul me-1"></i>All Subjects
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Subject Statistics -->
                    <div class="card mt-3">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="bx bx-stats me-2"></i>Subject Statistics
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span>Subject ID:</span>
                                <span class="badge bg-label-dark">{{ $subject->id }}</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span>Has Teacher:</span>
                                @if($subject->teacher)
                                    <span class="badge bg-label-success">Yes</span>
                                @else
                                    <span class="badge bg-label-danger">No</span>
                                @endif
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span>Has Classroom:</span>
                                @if($subject->classroom)
                                    <span class="badge bg-label-success">Yes</span>
                                @else
                                    <span class="badge bg-label-danger">No</span>
                                @endif
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <span>Status:</span>
                                @if($subject->teacher && $subject->classroom)
                                    <span class="badge bg-label-success">Fully Configured</span>
                                @else
                                    <span class="badge bg-label-warning">Needs Setup</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Recent Activity -->
                    <div class="card mt-3">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="bx bx-time me-2"></i>Recent Activity
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="timeline">
                                <div class="timeline-item">
                                    <div class="timeline-point timeline-point-primary"></div>
                                    <div class="timeline-event">
                                        <div class="timeline-header mb-1">
                                            <h6 class="mb-0">Subject Updated</h6>
                                            <small class="text-muted">{{ $subject->updated_at->diffForHumans() }}</small>
                                        </div>
                                        <p class="mb-0">Last modification made to this subject</p>
                                    </div>
                                </div>
                                <div class="timeline-item">
                                    <div class="timeline-point timeline-point-success"></div>
                                    <div class="timeline-event">
                                        <div class="timeline-header mb-1">
                                            <h6 class="mb-0">Subject Created</h6>
                                            <small class="text-muted">{{ $subject->created_at->diffForHumans() }}</small>
                                        </div>
                                        <p class="mb-0">Subject was added to the system</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- / Content -->

        <!-- Delete Confirmation Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirm Delete</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete the subject "<strong>{{ $subject->name }}</strong>"?</p>
                        <p class="text-danger"><small>This action cannot be undone and will remove all associated data.</small></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                        <form action="{{ route('manager.subjects.destroy', $subject) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete Subject</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete() {
            new bootstrap.Modal(document.getElementById('deleteModal')).show();
        }
    </script>
@endsection