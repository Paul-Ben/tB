@extends('layouts.dashboard')

@section('title', 'Guardian Management')

@section('content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 mb-0">Guardian Management</h1>
                    <p class="text-muted">Manage guardian accounts and information</p>
                </div>
                <div>
                    <a href="{{ route('manager.guardians.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Add Guardian
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Search and Filter Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="GET" action="{{ route('manager.guardians.index') }}" class="row g-3">
                        <!-- Search -->
                        <div class="col-md-4">
                            <label for="search" class="form-label">Search Guardians</label>
                            <input type="text" class="form-control" id="search" name="search" 
                                   value="{{ request('search') }}" placeholder="Search by name, phone, or email">
                        </div>

                        <!-- Nationality Filter -->
                        <div class="col-md-3">
                            <label for="nationality" class="form-label">Nationality</label>
                            <select class="form-select" id="nationality" name="nationality">
                                <option value="">All Nationalities</option>
                                @foreach($nationalities as $nationality)
                                    <option value="{{ $nationality }}" {{ request('nationality') == $nationality ? 'selected' : '' }}>
                                        {{ $nationality }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- State Filter -->
                        <div class="col-md-3">
                            <label for="state" class="form-label">State of Origin</label>
                            <select class="form-select" id="state" name="state">
                                <option value="">All States</option>
                                @foreach($states as $state)
                                    <option value="{{ $state }}" {{ request('state') == $state ? 'selected' : '' }}>
                                        {{ $state }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Actions -->
                        <div class="col-md-2">
                            <label class="form-label">&nbsp;</label>
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-outline-primary">
                                    <i class="fas fa-search"></i>
                                </button>
                                <a href="{{ route('manager.guardians.index') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-times"></i>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Guardians Table -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        Guardians ({{ $guardians->total() }})
                    </h5>
                </div>
                <div class="card-body">
                    @if($guardians->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Guardian</th>
                                        <th>Contact Information</th>
                                        <th>Location</th>
                                        <th>Students</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($guardians as $guardian)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    @if($guardian->image)
                                                        <img src="{{ asset('storage/' . $guardian->image) }}" 
                                                             alt="{{ $guardian->guardian_name }}" 
                                                             class="rounded-circle me-3" 
                                                             width="40" height="40">
                                                    @else
                                                        <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center me-3" 
                                                             style="width: 40px; height: 40px;">
                                                            <span class="text-white fw-bold">
                                                                {{ substr($guardian->guardian_name, 0, 1) }}
                                                            </span>
                                                        </div>
                                                    @endif
                                                    <div>
                                                        <h6 class="mb-0">{{ $guardian->guardian_name }}</h6>
                                                        <small class="text-muted">ID: {{ $guardian->id }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div>
                                                    <div><i class="fas fa-envelope text-muted me-1"></i>{{ $guardian->guardian_email }}</div>
                                                    <div><i class="fas fa-phone text-muted me-1"></i>{{ $guardian->guardian_phone }}</div>
                                                </div>
                                            </td>
                                            <td>
                                                <div>
                                                    @if($guardian->nationality)
                                                        <div><small class="text-muted">Nationality:</small> {{ $guardian->nationality }}</div>
                                                    @endif
                                                    @if($guardian->stateoforigin)
                                                        <div><small class="text-muted">State:</small> {{ $guardian->stateoforigin }}</div>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge bg-info">{{ $guardian->students->count() }} Students</span>
                                            </td>
                                            <td>
                                                <span class="badge bg-success">Active</span>
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" 
                                                            type="button" data-bs-toggle="dropdown">
                                                        Actions
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a class="dropdown-item" href="{{ route('manager.guardians.show', $guardian) }}">
                                                                <i class="fas fa-eye me-2"></i>View Details
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="{{ route('manager.guardians.edit', $guardian) }}">
                                                                <i class="fas fa-edit me-2"></i>Edit
                                                            </a>
                                                        </li>
                                                        <li><hr class="dropdown-divider"></li>
                                                        <li>
                                                            <button type="button" class="dropdown-item text-danger" 
                                                                    onclick="confirmDelete('{{ $guardian->guardian_name }}', '{{ route('manager.guardians.destroy', $guardian) }}')">
                                                                <i class="fas fa-trash me-2"></i>Delete
                                                            </button>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <div>
                                <small class="text-muted">
                                    Showing {{ $guardians->firstItem() }} to {{ $guardians->lastItem() }} 
                                    of {{ $guardians->total() }} results
                                </small>
                            </div>
                            <div>
                                {{ $guardians->links() }}
                            </div>
                        </div>
                    @else
                        <!-- Empty State -->
                        <div class="text-center py-5">
                            <i class="fas fa-users fa-3x text-muted mb-3"></i>
                            <h5>No Guardians Found</h5>
                            <p class="text-muted">
                                @if(request()->hasAny(['search', 'nationality', 'state']))
                                    No guardians match your current filters. 
                                    <a href="{{ route('manager.guardians.index') }}" class="text-decoration-none">Clear filters</a>
                                @else
                                    Start by adding your first guardian to the system.
                                @endif
                            </p>
                            <a href="{{ route('manager.guardians.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus me-2"></i>Add Guardian
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete <strong id="deleteItemName"></strong>?</p>
                <p class="text-danger"><small>This action cannot be undone and will also delete the associated user account.</small></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function confirmDelete(name, url) {
    document.getElementById('deleteItemName').textContent = name;
    document.getElementById('deleteForm').action = url;
    new bootstrap.Modal(document.getElementById('deleteModal')).show();
}
</script>
@endpush
@endsection