<x-dashboard-layout>
    <x-slot name="title">Term Management</x-slot>

    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Term Management /</span> All Terms</h4>

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

            <!-- Terms Management Card -->
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title mb-0">Terms ({{ $terms->total() }})</h5>
                    <div class="d-flex gap-2">
                        <a href="{{ route('manager.terms.create') }}" class="btn btn-primary">
                            <i class="bx bx-plus me-1"></i> Add Term
                        </a>
                    </div>
                </div>
                
                <!-- Filters -->
                <div class="card-body border-bottom">
                    <form method="GET" action="{{ route('manager.terms.index') }}" class="row g-3">
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="search" placeholder="Search terms..." value="{{ request('search') }}">
                        </div>
                        <div class="col-md-3">
                            <select name="session_id" class="form-select">
                                <option value="">All Sessions</option>
                                @foreach($schoolSessions as $session)
                                    <option value="{{ $session->id }}" {{ request('session_id') == $session->id ? 'selected' : '' }}>
                                        {{ $session->sessionName }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select name="status" class="form-select">
                                <option value="">All Status</option>
                                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-outline-primary w-100">
                                <i class="bx bx-search me-1"></i> Filter
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Terms Table -->
                <div class="table-responsive text-nowrap">
                    @if($terms->count() > 0)
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Term Name</th>
                                    <th>School Session</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach($terms as $term)
                                    <tr>
                                        <td>
                                            <strong>{{ $term->name }}</strong>
                                        </td>
                                        <td>
                                            <span class="badge bg-label-info">{{ $term->schoolSession->sessionName ?? 'N/A' }}</span>
                                        </td>
                                        <td>
                                            {{ $term->startDate ? \Carbon\Carbon::parse($term->startDate)->format('M d, Y') : 'Not set' }}
                                        </td>
                                        <td>
                                            {{ $term->endDate ? \Carbon\Carbon::parse($term->endDate)->format('M d, Y') : 'Not set' }}
                                        </td>
                                        <td>
                                            @if($term->status === 'active')
                                                <span class="badge bg-label-success">Active</span>
                                            @else
                                                <span class="badge bg-label-secondary">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="{{ route('manager.terms.show', $term) }}">
                                                        <i class="bx bx-show me-1"></i> View
                                                    </a>
                                                    <a class="dropdown-item" href="{{ route('manager.terms.edit', $term) }}">
                                                        <i class="bx bx-edit-alt me-1"></i> Edit
                                                    </a>
                                                    <div class="dropdown-divider"></div>
                                                    <button class="dropdown-item text-danger" onclick="confirmDelete('{{ $term->id }}', '{{ $term->name }}')">
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
                            <div class="mb-3">
                                <i class="bx bx-calendar-alt" style="font-size: 4rem; color: #d1d5db;"></i>
                            </div>
                            <h5 class="text-muted">No terms found</h5>
                            <p class="text-muted">
                                @if(request()->hasAny(['search', 'session_id', 'status']))
                                    Try adjusting your search criteria or 
                                    <a href="{{ route('manager.terms.index') }}" class="text-decoration-none">clear filters</a>
                                @else
                                    Get started by creating your first term
                                @endif
                            </p>
                            @if(!request()->hasAny(['search', 'session_id', 'status']))
                                <a href="{{ route('manager.terms.create') }}" class="btn btn-primary">
                                    <i class="bx bx-plus me-1"></i> Add Term
                                </a>
                            @endif
                        </div>
                    @endif
                </div>

                <!-- Pagination -->
                @if($terms->hasPages())
                    <div class="card-footer">
                        {{ $terms->links() }}
                    </div>
                @endif
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
                    <p>Are you sure you want to delete the term "<span id="termName"></span>"?</p>
                    <p class="text-muted small">This action cannot be undone.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form id="deleteForm" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete Term</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(termId, termName) {
            document.getElementById('termName').textContent = termName;
            document.getElementById('deleteForm').action = `/manager/terms/${termId}`;
            new bootstrap.Modal(document.getElementById('deleteModal')).show();
        }
    </script>
</x-dashboard-layout>