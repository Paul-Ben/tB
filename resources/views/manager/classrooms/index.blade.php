<x-dashboard-layout>
    <x-slot name="title">Classroom Management</x-slot>

    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Classroom Management /</span> All Classrooms</h4>

            <!-- Alert Messages -->
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

            <!-- Classrooms Management Card -->
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title mb-0">Classrooms ({{ $classrooms->total() }})</h5>
                    <div class="d-flex gap-2">
                        <a href="{{ route('manager.classrooms.create') }}" class="btn btn-primary">
                            <i class="bx bx-plus me-1"></i> Add Classroom
                        </a>
                    </div>
                </div>
                
                <!-- Filters -->
                <div class="card-body border-bottom">
                    <form method="GET" action="{{ route('manager.classrooms.index') }}" class="row g-3">
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="search" placeholder="Search classrooms..." value="{{ request('search') }}">
                        </div>
                        <div class="col-md-4">
                            <select name="category_id" class="form-select">
                                <option value="">All Categories</option>
                                @foreach($classCategories as $category)
                                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-outline-primary w-100">
                                <i class="bx bx-search me-1"></i> Search
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Classrooms Table -->
                <div class="table-responsive text-nowrap">
                    @if($classrooms->count() > 0)
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Classroom</th>
                                    <th>Category</th>
                                    <th>Teacher</th>
                                    <th>Students</th>
                                    <th>Created</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($classrooms as $classroom)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar avatar-sm me-3">
                                                    <span class="avatar-initial rounded-circle bg-label-primary">
                                                        <i class="bx bx-book-open"></i>
                                                    </span>
                                                </div>
                                                <div>
                                                    <strong>{{ $classroom->name }}</strong>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            @if($classroom->classCategory)
                                                <span class="badge bg-label-info">{{ $classroom->classCategory->name }}</span>
                                            @else
                                                <span class="text-muted">No category</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($classroom->teacher)
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar avatar-xs me-2">
                                                        @if($classroom->teacher->image)
                                                            <img src="{{ asset('storage/' . $classroom->teacher->image) }}" alt="Avatar" class="rounded-circle">
                                                        @else
                                                            <img src="{{ asset('assets/img/avatars/1.png') }}" alt="Avatar" class="rounded-circle">
                                                        @endif
                                                    </div>
                                                    <span>{{ $classroom->teacher->full_name }}</span>
                                                </div>
                                            @else
                                                <span class="text-muted">No teacher assigned</span>
                                                <button type="button" class="btn btn-sm btn-outline-primary ms-2" onclick="showAssignTeacherModal('{{ $classroom->id }}', '{{ $classroom->name }}')">
                                                    <i class="bx bx-user-plus"></i> Assign
                                                </button>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge bg-label-secondary">{{ $classroom->students_count }} students</span>
                                        </td>
                                        <td>{{ $classroom->created_at->format('M j, Y') }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="{{ route('manager.classrooms.show', $classroom) }}">
                                                        <i class="bx bx-show-alt me-1"></i> View
                                                    </a>
                                                    <a class="dropdown-item" href="{{ route('manager.classrooms.edit', $classroom) }}">
                                                        <i class="bx bx-edit-alt me-1"></i> Edit
                                                    </a>
                                                    @if(!$classroom->teacher)
                                                        <button type="button" class="dropdown-item" onclick="showAssignTeacherModal('{{ $classroom->id }}', '{{ $classroom->name }}')">
                                                            <i class="bx bx-user-plus me-1"></i> Assign Teacher
                                                        </button>
                                                    @endif
                                                    <div class="dropdown-divider"></div>
                                                    <button type="button" class="dropdown-item text-danger" onclick="confirmDelete('{{ $classroom->name }}', '{{ route('manager.classrooms.destroy', $classroom) }}')">
                                                        <i class="bx bx-trash me-1"></i> Delete
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="text-center py-5">
                            <div class="avatar mx-auto mb-3">
                                <span class="avatar-initial rounded-circle bg-label-secondary">
                                    <i class="bx bx-book-open bx-md"></i>
                                </span>
                            </div>
                            <h5 class="mb-1">No classrooms found</h5>
                            <p class="text-muted">No classrooms match your current filters.</p>
                            <a href="{{ route('manager.classrooms.create') }}" class="btn btn-primary">
                                <i class="bx bx-plus me-1"></i> Add First Classroom
                            </a>
                        </div>
                    @endif
                </div>

                <!-- Pagination -->
                @if($classrooms->hasPages())
                    <div class="card-footer">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="text-muted">
                                Showing {{ $classrooms->firstItem() }} to {{ $classrooms->lastItem() }} of {{ $classrooms->total() }} results
                            </div>
                            {{ $classrooms->links("pagination::bootstrap-5") }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <!-- / Content -->
    </div>
    <!-- Content wrapper -->

    <!-- Assign Teacher Modal -->
    <div class="modal fade" id="assignTeacherModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Assign Teacher</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="assignTeacherForm" method="POST">
                    @csrf
                    <div class="modal-body">
                        <p>Assign a teacher to classroom <strong id="assignClassroomName"></strong>:</p>
                        <div class="mb-3">
                            <label for="teacher_id" class="form-label">Select Teacher</label>
                            <select name="teacher_id" id="teacher_id" class="form-select" required>
                                <option value="">Choose a teacher...</option>
                                @foreach($availableTeachers as $teacher)
                                    <option value="{{ $teacher->id }}">
                                        {{ $teacher->user->first_name }} {{ $teacher->user->last_name }}
                                        @if($teacher->user->email)
                                            ({{ $teacher->user->email }})
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Assign Teacher</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

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
                    <p class="text-muted small">This action cannot be undone.</p>
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
        function showAssignTeacherModal(classroomId, classroomName) {
            document.getElementById('assignClassroomName').textContent = classroomName;
            document.getElementById('assignTeacherForm').action = `/manager/classrooms/${classroomId}/assign-teacher`;
            new bootstrap.Modal(document.getElementById('assignTeacherModal')).show();
        }

        function confirmDelete(itemName, deleteUrl) {
            document.getElementById('deleteItemName').textContent = itemName;
            document.getElementById('deleteForm').action = deleteUrl;
            new bootstrap.Modal(document.getElementById('deleteModal')).show();
        }
    </script>
</x-dashboard-layout>