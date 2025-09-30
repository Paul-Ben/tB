<x-dashboard-layout>
    <x-slot name="title">{{ $classroom->name }} - Classroom Details</x-slot>

    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4">
                <span class="text-muted fw-light">Classroom Management /</span> {{ $classroom->name }}
            </h4>

            <!-- Alert Messages -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row">
                <!-- Classroom Details -->
                <div class="col-md-8">
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="card-title mb-0">
                                <i class="bx bx-book-open me-2"></i>{{ $classroom->name }}
                            </h5>
                            <div class="d-flex gap-2">
                                <a href="{{ route('manager.classrooms.edit', $classroom) }}" class="btn btn-outline-primary">
                                    <i class="bx bx-edit-alt me-1"></i> Edit
                                </a>
                                <a href="{{ route('manager.classrooms.index') }}" class="btn btn-outline-secondary">
                                    <i class="bx bx-arrow-back me-1"></i> Back to Classrooms
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h6 class="text-primary">Category</h6>
                                    @if($classroom->classCategory)
                                        <span class="badge bg-label-info mb-3">{{ $classroom->classCategory->name }}</span>
                                    @else
                                        <span class="text-muted mb-3">No category assigned</span>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <h6 class="text-primary">Students Enrolled</h6>
                                    <span class="badge bg-label-secondary mb-3">{{ $classroom->students->count() }} students</span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <h6 class="text-primary">Created</h6>
                                    <p class="text-muted">{{ $classroom->created_at->format('M j, Y \a\t g:i A') }}</p>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="text-primary">Last Updated</h6>
                                    <p class="text-muted">{{ $classroom->updated_at->format('M j, Y \a\t g:i A') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Students List -->
                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="card-title mb-0">Students ({{ $classroom->students->count() }})</h5>
                            @if($classroom->students->count() > 0)
                                <button class="btn btn-outline-primary btn-sm">
                                    <i class="bx bx-download me-1"></i> Export List
                                </button>
                            @endif
                        </div>
                        <div class="card-body">
                            @if($classroom->students->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Student</th>
                                                <th>Guardian</th>
                                                <th>Enrolled</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($classroom->students as $student)
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar avatar-sm me-3">
                                                                <span class="avatar-initial rounded-circle bg-label-primary">
                                                                    {{ substr($student->first_name, 0, 1) }}{{ substr($student->last_name, 0, 1) }}
                                                                </span>
                                                            </div>
                                                            <div>
                                                                <strong>{{ $student->first_name }} {{ $student->last_name }}</strong>
                                                                @if($student->middle_name)
                                                                    <div class="text-muted small">{{ $student->middle_name }}</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        @if($student->guardian)
                                                            <div>
                                                                <strong>{{ $student->guardian->first_name }} {{ $student->guardian->last_name }}</strong>
                                                                @if($student->guardian->phone_number)
                                                                    <div class="text-muted small">{{ $student->guardian->phone_number }}</div>
                                                                @endif
                                                            </div>
                                                        @else
                                                            <span class="text-muted">No guardian assigned</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $student->created_at->format('M j, Y') }}</td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                                <i class="bx bx-dots-vertical-rounded"></i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item" href="#">
                                                                    <i class="bx bx-show-alt me-1"></i> View Profile
                                                                </a>
                                                                <a class="dropdown-item" href="#">
                                                                    <i class="bx bx-edit-alt me-1"></i> Edit
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="text-center py-4">
                                    <div class="avatar mx-auto mb-3">
                                        <span class="avatar-initial rounded-circle bg-label-secondary">
                                            <i class="bx bx-user bx-md"></i>
                                        </span>
                                    </div>
                                    <h6 class="mb-1">No students enrolled</h6>
                                    <p class="text-muted">This classroom doesn't have any students yet.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-md-4">
                    <!-- Teacher Card -->
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h6 class="card-title mb-0">
                                <i class="bx bx-user me-1"></i> Class Teacher
                            </h6>
                            @if(!$classroom->teacher)
                                <a href="{{ route('manager.classrooms.assign-teacher', $classroom) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="bx bx-user-plus"></i> Assign
                                </a>
                            @endif
                        </div>
                        <div class="card-body">
                            @if($classroom->teacher)
                                <div class="d-flex align-items-center mb-3">
                                    <div class="avatar avatar-lg me-3">
                                        @if($classroom->teacher->image)
                                            <img src="{{ asset('storage/' . $classroom->teacher->image) }}" alt="Avatar" class="rounded-circle">
                                        @else
                                            <img src="{{ asset('assets/img/avatars/1.png') }}" alt="Avatar" class="rounded-circle">
                                        @endif
                                    </div>
                                    <div>
                                        <h6 class="mb-0">{{ $classroom->teacher->full_name }}</h6>
                                        @if($classroom->teacher->qualification)
                                            <small class="text-muted">{{ $classroom->teacher->qualification }}</small>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="mb-2">
                                    <strong>Email:</strong>
                                    <div class="text-muted">{{ $classroom->teacher->email }}</div>
                                </div>
                                
                                @if($classroom->teacher->phone_number)
                                    <div class="mb-2">
                                        <strong>Phone:</strong>
                                        <div class="text-muted">{{ $classroom->teacher->phone_number }}</div>
                                    </div>
                                @endif

                                <div class="d-flex gap-2 mt-3">
                                    <a href="#" class="btn btn-sm btn-outline-primary">
                                        <i class="bx bx-show-alt me-1"></i> View Profile
                                    </a>
                                    <a href="{{ route('manager.classrooms.assign-teacher', $classroom) }}" class="btn btn-sm btn-outline-secondary">
                                        <i class="bx bx-user-plus me-1"></i> Change
                                    </a>
                                </div>
                            @else
                                <div class="text-center py-3">
                                    <div class="avatar mx-auto mb-2">
                                        <span class="avatar-initial rounded-circle bg-label-secondary">
                                            <i class="bx bx-user"></i>
                                        </span>
                                    </div>
                                    <p class="text-muted small mb-2">No teacher assigned</p>
                                    <a href="{{ route('manager.classrooms.assign-teacher', $classroom) }}" class="btn btn-sm btn-primary">
                                        <i class="bx bx-user-plus me-1"></i> Assign Teacher
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="card">
                        <div class="card-header">
                            <h6 class="card-title mb-0">
                                <i class="bx bx-cog me-1"></i> Quick Actions
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="d-grid gap-2">
                                <a href="{{ route('manager.classrooms.edit', $classroom) }}" class="btn btn-outline-primary">
                                    <i class="bx bx-edit-alt me-1"></i> Edit Classroom
                                </a>
                                @if(!$classroom->teacher)
                                    <a href="{{ route('manager.classrooms.assign-teacher', $classroom) }}" class="btn btn-outline-info">
                                        <i class="bx bx-user-plus me-1"></i> Assign Teacher
                                    </a>
                                @endif
                                <button type="button" class="btn btn-outline-danger" onclick="confirmDelete('{{ $classroom->name }}', '{{ route('manager.classrooms.destroy', $classroom) }}')">
                                    <i class="bx bx-trash me-1"></i> Delete Classroom
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- / Content -->
    </div>
    <!-- Content wrapper -->

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete the classroom <strong id="deleteItemName"></strong>?</p>
                    <p class="text-muted small">This action cannot be undone and will affect all enrolled students.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form id="deleteForm" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(itemName, deleteUrl) {
            document.getElementById('deleteItemName').textContent = itemName;
            document.getElementById('deleteForm').action = deleteUrl;
            new bootstrap.Modal(document.getElementById('deleteModal')).show();
        }
    </script>
</x-dashboard-layout>