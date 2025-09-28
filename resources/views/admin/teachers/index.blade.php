<x-dashboard-layout>
    <x-slot name="title">Teacher Management</x-slot>

    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Teacher Management /</span> All Teachers</h4>

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

            <!-- Teachers Management Card -->
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title mb-0">Teachers ({{ $teachers->total() }})</h5>
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-outline-secondary" id="bulkActionBtn" style="display: none;">
                            <i class="bx bx-task me-1"></i> Bulk Actions
                        </button>
                        <a href="{{ route('admin.teachers.create') }}" class="btn btn-primary">
                            <i class="bx bx-plus me-1"></i> Add Teacher
                        </a>
                    </div>
                </div>
                
                <!-- Filters -->
                <div class="card-body border-bottom">
                    <form method="GET" action="{{ route('admin.teachers.index') }}" class="row g-3">
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="search" placeholder="Search teachers..." value="{{ request('search') }}">
                        </div>
                        <div class="col-md-4">
                            <select name="status" class="form-select">
                                <option value="">All Status</option>
                                <option value="verified" {{ request('status') == 'verified' ? 'selected' : '' }}>Verified</option>
                                <option value="unverified" {{ request('status') == 'unverified' ? 'selected' : '' }}>Unverified</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-outline-primary w-100">
                                <i class="bx bx-search me-1"></i> Search
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Teachers Table -->
                <div class="table-responsive text-nowrap">
                    @if($teachers->count() > 0)
                        <form id="bulkActionForm" method="POST" action="{{ route('admin.teachers.bulk-action') }}">
                            @csrf
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th width="30">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="selectAll">
                                            </div>
                                        </th>
                                        <th>Teacher</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Qualification</th>
                                        <th>Status</th>
                                        <th>Joined</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($teachers as $teacher)
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input teacher-checkbox" type="checkbox" name="teacher_ids[]" value="{{ $teacher->id }}">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar avatar-sm me-3">
                                                        @if($teacher->image)
                                                            <img src="{{ asset('storage/' . $teacher->image) }}" alt="Avatar" class="rounded-circle">
                                                        @else
                                                            <img src="{{ asset('assets/img/avatars/1.png') }}" alt="Avatar" class="rounded-circle">
                                                        @endif
                                                    </div>
                                                    <div>
                                                        <strong>{{ $teacher->full_name }}</strong>
                                                        @if($teacher->qualification)
                                                            <div class="text-muted small">{{ $teacher->qualification }}</div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $teacher->email }}</td>
                                            <td>{{ $teacher->phone_number ?: 'Not provided' }}</td>
                                            <td>
                                                @if($teacher->qualification)
                                                    <span class="badge bg-label-info">{{ $teacher->qualification }}</span>
                                                @else
                                                    <span class="text-muted">Not specified</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($teacher->user->email_verified_at)
                                                    <span class="badge bg-success">
                                                        <i class="bx bx-check me-1"></i>Verified
                                                    </span>
                                                @else
                                                    <span class="badge bg-warning">
                                                        <i class="bx bx-time me-1"></i>Unverified
                                                    </span>
                                                @endif
                                            </td>
                                            <td>{{ $teacher->created_at->format('M j, Y') }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="{{ route('admin.teachers.show', $teacher) }}">
                                                            <i class="bx bx-show-alt me-1"></i> View
                                                        </a>
                                                        <a class="dropdown-item" href="{{ route('admin.teachers.edit', $teacher) }}">
                                                            <i class="bx bx-edit-alt me-1"></i> Edit
                                                        </a>
                                                        <form method="POST" action="{{ route('admin.teachers.toggle-verification', $teacher) }}" class="d-inline">
                                                            @csrf
                                                            <button type="submit" class="dropdown-item">
                                                                @if($teacher->user->email_verified_at)
                                                                    <i class="bx bx-x me-1"></i> Unverify
                                                                @else
                                                                    <i class="bx bx-check me-1"></i> Verify
                                                                @endif
                                                            </button>
                                                        </form>
                                                        <form method="POST" action="{{ route('admin.teachers.resend-welcome-email', $teacher) }}" class="d-inline">
                                                            @csrf
                                                            <button type="submit" class="dropdown-item">
                                                                <i class="bx bx-envelope me-1"></i> Resend Welcome Email
                                                            </button>
                                                        </form>
                                                        <div class="dropdown-divider"></div>
                                                        <button type="button" class="dropdown-item text-danger" onclick="confirmDelete('{{ $teacher->full_name }}', '{{ route('admin.teachers.destroy', $teacher) }}')">
                                                            <i class="bx bx-trash me-1"></i> Delete
                                                        </button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </form>
                    @else
                        <div class="text-center py-5">
                            <div class="avatar mx-auto mb-3">
                                <span class="avatar-initial rounded-circle bg-label-secondary">
                                    <i class="bx bx-user bx-md"></i>
                                </span>
                            </div>
                            <h5 class="mb-1">No teachers found</h5>
                            <p class="text-muted">No teachers match your current filters.</p>
                            <a href="{{ route('admin.teachers.create') }}" class="btn btn-primary">
                                <i class="bx bx-plus me-1"></i> Add First Teacher
                            </a>
                        </div>
                    @endif
                </div>

                <!-- Pagination -->
                @if($teachers->hasPages())
                    <div class="card-footer">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="text-muted">
                                Showing {{ $teachers->firstItem() }} to {{ $teachers->lastItem() }} of {{ $teachers->total() }} results
                            </div>
                            {{ $teachers->links() }}
                        </div>
                    </div>
                @endif
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
                    <h5 class="modal-title">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete teacher <strong id="deleteTeacherName"></strong>?</p>
                    <p class="text-muted">This action cannot be undone and will permanently remove:</p>
                    <ul class="text-muted">
                        <li>Teacher profile and account</li>
                        <li>Associated user account</li>
                        <li>All related data</li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form id="deleteForm" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete Teacher</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bulk Action Modal -->
    <div class="modal fade" id="bulkActionModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Bulk Actions</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Select an action to perform on <span id="selectedCount">0</span> selected teachers:</p>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="action" value="verify" id="bulkVerify">
                        <label class="form-check-label" for="bulkVerify">
                            <i class="bx bx-check me-1"></i> Verify Teachers
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="action" value="unverify" id="bulkUnverify">
                        <label class="form-check-label" for="bulkUnverify">
                            <i class="bx bx-x me-1"></i> Unverify Teachers
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="action" value="delete" id="bulkDelete">
                        <label class="form-check-label text-danger" for="bulkDelete">
                            <i class="bx bx-trash me-1"></i> Delete Teachers
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" onclick="executeBulkAction()">Execute Action</button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Select all functionality
        document.getElementById('selectAll').addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.teacher-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
            updateBulkActionButton();
        });

        // Individual checkbox functionality
        document.querySelectorAll('.teacher-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', updateBulkActionButton);
        });

        function updateBulkActionButton() {
            const checkedBoxes = document.querySelectorAll('.teacher-checkbox:checked');
            const bulkBtn = document.getElementById('bulkActionBtn');
            
            if (checkedBoxes.length > 0) {
                bulkBtn.style.display = 'inline-block';
            } else {
                bulkBtn.style.display = 'none';
            }
        }

        // Bulk action modal
        document.getElementById('bulkActionBtn').addEventListener('click', function() {
            const checkedBoxes = document.querySelectorAll('.teacher-checkbox:checked');
            document.getElementById('selectedCount').textContent = checkedBoxes.length;
            
            const modal = new bootstrap.Modal(document.getElementById('bulkActionModal'));
            modal.show();
        });

        function executeBulkAction() {
            const action = document.querySelector('input[name="action"]:checked');
            if (!action) {
                alert('Please select an action.');
                return;
            }
            
            const actionInput = document.createElement('input');
            actionInput.type = 'hidden';
            actionInput.name = 'action';
            actionInput.value = action.value;
            
            document.getElementById('bulkActionForm').appendChild(actionInput);
            document.getElementById('bulkActionForm').submit();
        }

        // Delete confirmation
        function confirmDelete(teacherName, deleteUrl) {
            document.getElementById('deleteTeacherName').textContent = teacherName;
            document.getElementById('deleteForm').action = deleteUrl;
            
            const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
            modal.show();
        }
    </script>
    @endpush
</x-dashboard-layout>