@extends('layouts.dashboard')

@section('title', 'Student Management')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-lg-12 mb-4 order-0">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-7">
                        <div class="card-body">
                            <h5 class="card-title text-primary">Student Management</h5>
                            <p class="mb-4">
                                Manage all student records, including enrollment, personal information, and academic details.
                            </p>
                            <a href="{{ route('manager.students.create') }}" class="btn btn-sm btn-outline-primary">Add New Student</a>
                        </div>
                    </div>
                    <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                            <img src="{{ asset('assets/img/illustrations/man-with-laptop-light.png') }}" height="140" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Search and Filter Section -->
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Search & Filter Students</h5>
            <button class="btn btn-outline-secondary btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#filterCollapse">
                <i class="bx bx-filter-alt me-1"></i>Filters
            </button>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('manager.students.index') }}">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="search" class="form-label">Search</label>
                        <input type="text" class="form-control" id="search" name="search" 
                               value="{{ request('search') }}" 
                               placeholder="Search by name, student number, or guardian...">
                    </div>
                    <div class="col-md-8">
                        <div class="collapse" id="filterCollapse">
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label for="classroom" class="form-label">Classroom</label>
                                    <select class="form-select" id="classroom" name="classroom">
                                        <option value="">All Classrooms</option>
                                        @foreach($classrooms as $classroom)
                                            <option value="{{ $classroom->id }}" 
                                                {{ request('classroom') == $classroom->id ? 'selected' : '' }}>
                                                {{ $classroom->name }} ({{ $classroom->classCategory->name ?? 'N/A' }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="gender" class="form-label">Gender</label>
                                    <select class="form-select" id="gender" name="gender">
                                        <option value="">All Genders</option>
                                        @foreach($genders as $gender)
                                            <option value="{{ $gender }}" 
                                                {{ request('gender') == $gender ? 'selected' : '' }}>
                                                {{ $gender }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="nationality" class="form-label">Nationality</label>
                                    <select class="form-select" id="nationality" name="nationality">
                                        <option value="">All Nationalities</option>
                                        @foreach($nationalities as $nationality)
                                            <option value="{{ $nationality }}" 
                                                {{ request('nationality') == $nationality ? 'selected' : '' }}>
                                                {{ $nationality }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="session" class="form-label">Session</label>
                                    <select class="form-select" id="session" name="session">
                                        <option value="">All Sessions</option>
                                        @foreach($sessions as $session)
                                            <option value="{{ $session->id }}" 
                                                {{ request('session') == $session->id ? 'selected' : '' }}>
                                                {{ $session->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary me-2">
                            <i class="bx bx-search me-1"></i>Search
                        </button>
                        <a href="{{ route('manager.students.index') }}" class="btn btn-outline-secondary">
                            <i class="bx bx-refresh me-1"></i>Reset
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Students Table -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Students List ({{ $students->total() }} total)</h5>
            <a href="{{ route('manager.students.create') }}" class="btn btn-primary">
                <i class="bx bx-plus me-1"></i>Add Student
            </a>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>Photo</th>
                        <th>Student Info</th>
                        <th>Student Number</th>
                        <th>Classroom</th>
                        <th>Guardian</th>
                        <th>Gender</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse($students as $student)
                        <tr>
                            <td>
                                @if($student->image)
                                    <img src="{{ asset('storage/' . $student->image) }}" 
                                         alt="{{ $student->full_name }}" 
                                         class="rounded-circle" 
                                         width="40" height="40">
                                @else
                                    <div class="avatar avatar-sm">
                                        <span class="avatar-initial rounded-circle bg-label-primary">
                                            {{ substr($student->first_name, 0, 1) }}{{ substr($student->last_name, 0, 1) }}
                                        </span>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <div>
                                    <strong>{{ $student->full_name }}</strong><br>
                                    <small class="text-muted">{{ $student->nationality }}</small>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-label-info">{{ $student->std_number }}</span>
                            </td>
                            <td>
                                <div>
                                    <strong>{{ $student->classroom->name ?? 'N/A' }}</strong><br>
                                    <small class="text-muted">{{ $student->classroom->classCategory->name ?? 'N/A' }}</small>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <strong>{{ $student->guardian->guardian_name ?? 'N/A' }}</strong><br>
                                    <small class="text-muted">{{ $student->guardian->guardian_phone ?? 'N/A' }}</small>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-label-{{ $student->gender == 'Male' ? 'primary' : 'success' }}">
                                    {{ $student->gender }}
                                </span>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('manager.students.show', $student) }}">
                                            <i class="bx bx-show me-1"></i> View
                                        </a>
                                        <a class="dropdown-item" href="{{ route('manager.students.edit', $student) }}">
                                            <i class="bx bx-edit-alt me-1"></i> Edit
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item text-danger" href="#" 
                                           onclick="confirmDelete('{{ $student->id }}', '{{ $student->full_name }}')">
                                            <i class="bx bx-trash me-1"></i> Delete
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <div class="d-flex flex-column align-items-center">
                                    <i class="bx bx-user-x display-4 text-muted mb-2"></i>
                                    <h6 class="text-muted">No students found</h6>
                                    <p class="text-muted mb-3">Try adjusting your search criteria or add a new student.</p>
                                    <a href="{{ route('manager.students.create') }}" class="btn btn-primary">
                                        <i class="bx bx-plus me-1"></i>Add First Student
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($students->hasPages())
            <div class="card-footer">
                {{ $students->links() }}
            </div>
        @endif
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
                <p class="text-danger"><small>This action cannot be undone.</small></p>
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