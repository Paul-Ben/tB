<x-dashboard-layout>
    <x-slot name="title">Class Details</x-slot>

    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4">
                <span class="text-muted fw-light">Teaching / Classes /</span> {{ $classroom->name }}
            </h4>

            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <div class="avatar avatar-sm me-3">
                            <span class="avatar-initial rounded-circle bg-label-primary">
                                <i class="bx bx-book-open"></i>
                            </span>
                        </div>
                        <div>
                            <h5 class="mb-0">{{ $classroom->name }}</h5>
                            <small class="text-muted">Category: {{ $classroom->classCategory->name ?? 'No category' }}</small>
                        </div>
                    </div>
                    <div class="text-muted small">
                        Teacher: {{ $teacher->user->name }}
                    </div>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center">
                                <span class="badge bg-label-secondary me-2">{{ $students->total() }}</span>
                                <span class="text-muted">students enrolled</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <form method="GET" action="{{ route('teacher.classes.show', $classroom->id) }}" class="d-flex">
                                <input type="text" class="form-control me-2" name="search" placeholder="Search students by name or number..." value="{{ request('search') }}">
                                <button type="submit" class="btn btn-outline-primary">
                                    <i class="bx bx-search me-1"></i> Search
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Students</h5>
                </div>
                <div class="card-body">
                    @if($students->count() > 0)
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Student No.</th>
                                        <th>Gender</th>
                                        <th>Guardian</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($students as $index => $student)
                                        <tr>
                                            <td>{{ $students->firstItem() + $index }}</td>
                                            <td>{{ $student->getFullNameAttribute() }}</td>
                                            <td>{{ $student->std_number }}</td>
                                            <td>{{ ucfirst($student->gender ?? 'N/A') }}</td>
                                            <td>{{ $student->guardian->guardian_name ?? '—' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <div class="avatar mx-auto mb-3">
                                <span class="avatar-initial rounded-circle bg-label-secondary">
                                    <i class="bx bx-group bx-md"></i>
                                </span>
                            </div>
                            <h5 class="mb-1">No students found</h5>
                            <p class="text-muted">This classroom currently has no enrolled students.</p>
                        </div>
                    @endif
                </div>

                @if($students->hasPages())
                    <div class="card-footer d-flex justify-content-between align-items-center">
                        <div class="text-muted">
                            Showing {{ $students->firstItem() }} to {{ $students->lastItem() }} of {{ $students->total() }} results
                        </div>
                        {{ $students->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-dashboard-layout>