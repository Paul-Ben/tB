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
                                    <h5 class="card-title text-primary">Subject Management</h5>
                                    <p class="mb-4">
                                        Manage all subjects in the system. You can create, edit, and assign subjects to teachers and classrooms.
                                    </p>
                                </div>
                            </div>
                            <div class="col-sm-5 text-center text-sm-left">
                                <div class="card-body pb-0 px-0 px-md-4">
                                    <img src="{{ asset('assets/img/illustrations/man-with-laptop-light.png') }}" height="140" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png">
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

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Subject Management Card -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">All Subjects ({{ $subjects->total() }})</h5>
                    <a href="{{ route('manager.subjects.create') }}" class="btn btn-primary">
                        <i class="bx bx-plus me-1"></i>Add Subject
                    </a>
                </div>

                <div class="card-body">
                    <!-- Filters -->
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <form method="GET" action="{{ route('manager.subjects.index') }}">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="search" 
                                           placeholder="Search by name or code..." 
                                           value="{{ request('search') }}">
                                    <button class="btn btn-outline-primary" type="submit">
                                        <i class="bx bx-search"></i>
                                    </button>
                                </div>
                                <input type="hidden" name="teacher_id" value="{{ request('teacher_id') }}">
                                <input type="hidden" name="classroom_id" value="{{ request('classroom_id') }}">
                            </form>
                        </div>
                        <div class="col-md-4">
                            <form method="GET" action="{{ route('manager.subjects.index') }}">
                                <select class="form-select" name="teacher_id" onchange="this.form.submit()">
                                    <option value="">All Teachers</option>
                                    @foreach($teachers as $teacher)
                                        <option value="{{ $teacher->id }}" {{ request('teacher_id') == $teacher->id ? 'selected' : '' }}>
                                            {{ $teacher->user->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <input type="hidden" name="search" value="{{ request('search') }}">
                                <input type="hidden" name="classroom_id" value="{{ request('classroom_id') }}">
                            </form>
                        </div>
                        <div class="col-md-4">
                            <form method="GET" action="{{ route('manager.subjects.index') }}">
                                <select class="form-select" name="classroom_id" onchange="this.form.submit()">
                                    <option value="">All Classrooms</option>
                                    @foreach($classrooms as $classroom)
                                        <option value="{{ $classroom->id }}" {{ request('classroom_id') == $classroom->id ? 'selected' : '' }}>
                                            {{ $classroom->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <input type="hidden" name="search" value="{{ request('search') }}">
                                <input type="hidden" name="teacher_id" value="{{ request('teacher_id') }}">
                            </form>
                        </div>
                    </div>

                    <!-- Subjects Table -->
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Subject Name</th>
                                    <th>Code</th>
                                    <th>Teacher</th>
                                    <th>Classroom</th>
                                    <th>Created</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($subjects as $subject)
                                    <tr>
                                        <td>
                                            <strong>{{ $subject->name }}</strong>
                                        </td>
                                        <td>
                                            <span class="badge bg-label-primary">{{ $subject->code }}</span>
                                        </td>
                                        <td>
                                            <span class="badge bg-label-info">{{ $subject->teacher->user->name ?? 'N/A' }}</span>
                                        </td>
                                        <td>
                                            <span class="badge bg-label-secondary">{{ $subject->classroom->name ?? 'N/A' }}</span>
                                        </td>
                                        <td>
                                            <small class="text-muted">{{ $subject->created_at->format('M d, Y') }}</small>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="{{ route('manager.subjects.show', $subject) }}">
                                                        <i class="bx bx-show me-1"></i> View
                                                    </a>
                                                    <a class="dropdown-item" href="{{ route('manager.subjects.edit', $subject) }}">
                                                        <i class="bx bx-edit-alt me-1"></i> Edit
                                                    </a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item text-danger" href="javascript:void(0);" 
                                                       onclick="confirmDelete('{{ $subject->id }}', '{{ $subject->name }}')">
                                                        <i class="bx bx-trash me-1"></i> Delete
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4">
                                            <div class="d-flex flex-column align-items-center">
                                                <i class="bx bx-book-open display-4 text-muted mb-2"></i>
                                                <h6 class="text-muted">No subjects found</h6>
                                                <p class="text-muted mb-3">Start by creating your first subject</p>
                                                <a href="{{ route('manager.subjects.create') }}" class="btn btn-primary">
                                                    <i class="bx bx-plus me-1"></i>Add Subject
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($subjects->hasPages())
                        <div class="d-flex justify-content-center mt-4">
                            {{ $subjects->links() }}
                        </div>
                    @endif
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
                        <p>Are you sure you want to delete the subject "<span id="subjectName"></span>"?</p>
                        <p class="text-danger"><small>This action cannot be undone.</small></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                        <form id="deleteForm" method="POST" style="display: inline;">
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
        function confirmDelete(subjectId, subjectName) {
            document.getElementById('subjectName').textContent = subjectName;
            document.getElementById('deleteForm').action = `/manager/subjects/${subjectId}`;
            new bootstrap.Modal(document.getElementById('deleteModal')).show();
        }
    </script>
@endsection