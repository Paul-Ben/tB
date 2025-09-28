<x-dashboard-layout>
    <x-slot name="title">User Management</x-slot>

    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">User Management /</span> All Users</h4>

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

            <!-- Users Management Card -->
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title mb-0">Users ({{ $users->total() }})</h5>
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-outline-secondary" id="bulkActionBtn" style="display: none;">
                            <i class="bx bx-task me-1"></i> Bulk Actions
                        </button>
                        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                            <i class="bx bx-plus me-1"></i> Add User
                        </a>
                    </div>
                </div>
                
                <!-- Filters -->
                <div class="card-body border-bottom">
                    <form method="GET" action="{{ route('admin.users.index') }}" class="row g-3">
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="search" placeholder="Search users..." value="{{ request('search') }}">
                        </div>
                        <div class="col-md-3">
                            <select name="role" class="form-select">
                                <option value="">All Roles</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->name }}" {{ request('role') == $role->name ? 'selected' : '' }}>
                                        {{ ucfirst($role->name) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
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

                <!-- Users Table -->
                <div class="table-responsive text-nowrap">
                    @if($users->count() > 0)
                        <form id="bulkActionForm" method="POST" action="{{ route('admin.users.bulk-action') }}">
                            @csrf
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th width="30">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="selectAll">
                                            </div>
                                        </th>
                                        <th>User</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                        <th>Joined</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input user-checkbox" type="checkbox" name="user_ids[]" value="{{ $user->id }}">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar avatar-sm me-3">
                                                        <img src="{{ asset('assets/img/avatars/1.png') }}" alt="Avatar" class="rounded-circle">
                                                    </div>
                                                    <div>
                                                        <strong>{{ $user->name }}</strong>
                                                        @if($user->id === auth()->id())
                                                            <span class="badge bg-info ms-1">You</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                @php
                                                    $role = $user->getPrimaryRole() ?? 'No Role';
                                                    $badgeClass = match($role) {
                                                        'admin' => 'bg-label-primary',
                                                        'manager' => 'bg-label-success',
                                                        'teacher' => 'bg-label-info',
                                                        'guardian' => 'bg-label-warning',
                                                        default => 'bg-label-secondary'
                                                    };
                                                @endphp
                                                <span class="badge {{ $badgeClass }}">{{ ucfirst($role) }}</span>
                                            </td>
                                            <td>
                                                @if($user->email_verified_at)
                                                    <span class="badge bg-success">
                                                        <i class="bx bx-check me-1"></i>Verified
                                                    </span>
                                                @else
                                                    <span class="badge bg-warning">
                                                        <i class="bx bx-time me-1"></i>Unverified
                                                    </span>
                                                @endif
                                            </td>
                                            <td>{{ $user->created_at->format('M j, Y') }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="{{ route('admin.users.show', $user) }}">
                                                            <i class="bx bx-show-alt me-1"></i> View
                                                        </a>
                                                        <a class="dropdown-item" href="{{ route('admin.users.edit', $user) }}">
                                                            <i class="bx bx-edit-alt me-1"></i> Edit
                                                        </a>
                                                        <form method="POST" action="{{ route('admin.users.toggle-verification', $user) }}" class="d-inline">
                                                            @csrf
                                                            <button type="submit" class="dropdown-item">
                                                                @if($user->email_verified_at)
                                                                    <i class="bx bx-x me-1"></i> Unverify
                                                                @else
                                                                    <i class="bx bx-check me-1"></i> Verify
                                                                @endif
                                                            </button>
                                                        </form>
                                                        @if($user->id !== auth()->id())
                                                            <div class="dropdown-divider"></div>
                                                            <button type="button" class="dropdown-item text-danger" onclick="confirmDelete('{{ $user->name }}', '{{ route('admin.users.destroy', $user) }}')">
                                                                <i class="bx bx-trash me-1"></i> Delete
                                                            </button>
                                                        @endif
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
                            <h5 class="mb-1">No users found</h5>
                            <p class="text-muted">No users match your current filters.</p>
                            <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                                <i class="bx bx-plus me-1"></i> Add First User
                            </a>
                        </div>
                    @endif
                </div>

                <!-- Pagination -->
                @if($users->hasPages())
                    <div class="card-footer">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="text-muted">
                                Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} results
                            </div>
                            {{ $users->links() }}
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
                    <p>Are you sure you want to delete user <strong id="deleteUserName"></strong>?</p>
                    <p class="text-muted">This action cannot be undone.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form id="deleteForm" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete User</button>
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
                    <p>Select an action to perform on <span id="selectedCount">0</span> selected users:</p>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="action" value="verify" id="bulkVerify">
                        <label class="form-check-label" for="bulkVerify">
                            <i class="bx bx-check me-1"></i> Verify Users
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="action" value="unverify" id="bulkUnverify">
                        <label class="form-check-label" for="bulkUnverify">
                            <i class="bx bx-x me-1"></i> Unverify Users
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="action" value="delete" id="bulkDelete">
                        <label class="form-check-label text-danger" for="bulkDelete">
                            <i class="bx bx-trash me-1"></i> Delete Users
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
            const checkboxes = document.querySelectorAll('.user-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
            updateBulkActionButton();
        });

        // Individual checkbox functionality
        document.querySelectorAll('.user-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', updateBulkActionButton);
        });

        function updateBulkActionButton() {
            const checkedBoxes = document.querySelectorAll('.user-checkbox:checked');
            const bulkBtn = document.getElementById('bulkActionBtn');
            
            if (checkedBoxes.length > 0) {
                bulkBtn.style.display = 'inline-block';
            } else {
                bulkBtn.style.display = 'none';
            }
        }

        // Bulk action modal
        document.getElementById('bulkActionBtn').addEventListener('click', function() {
            const checkedBoxes = document.querySelectorAll('.user-checkbox:checked');
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
        function confirmDelete(userName, deleteUrl) {
            document.getElementById('deleteUserName').textContent = userName;
            document.getElementById('deleteForm').action = deleteUrl;
            
            const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
            modal.show();
        }
    </script>
    @endpush
</x-dashboard-layout>