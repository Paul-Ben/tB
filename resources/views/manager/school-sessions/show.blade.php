<x-dashboard-layout>
    <div class="content-wrapper">
        <!-- Content Header -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">School Session Details</h5>
                            <div class="d-flex gap-2">
                                <a href="{{ route('manager.school-sessions.edit', $schoolSession) }}" class="btn btn-primary">
                                    <i class="bx bx-edit me-1"></i>Edit Session
                                </a>
                                <a href="{{ route('manager.school-sessions.index') }}" class="btn btn-secondary">
                                    <i class="bx bx-arrow-back me-1"></i>Back to Sessions
                                </a>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="mb-4">
                                        <h6 class="text-muted mb-2">Session Name</h6>
                                        <h4 class="mb-0">{{ $schoolSession->sessionName }}</h4>
                                    </div>

                                    <div class="mb-4">
                                        <h6 class="text-muted mb-2">Status</h6>
                                        <span class="badge {{ $schoolSession->getStatusBadgeClass() }} fs-6">
                                            <i class="bx {{ $schoolSession->isActive() ? 'bx-check-circle' : 'bx-x-circle' }} me-1"></i>
                                            {{ ucfirst($schoolSession->status) }}
                                        </span>
                                    </div>

                                    @if($schoolSession->isActive())
                                        <div class="alert alert-success">
                                            <i class="bx bx-check-circle me-2"></i>
                                            <strong>Active Session:</strong> This is the current active school session.
                                        </div>
                                    @endif
                                </div>

                                <div class="col-md-4">
                                    <div class="card bg-light">
                                        <div class="card-body">
                                            <h6 class="card-title">Session Information</h6>
                                            
                                            <div class="mb-3">
                                                <small class="text-muted">Created Date</small>
                                                <div class="fw-medium">{{ $schoolSession->created_at->format('M j, Y') }}</div>
                                                <small class="text-muted">{{ $schoolSession->created_at->format('g:i A') }}</small>
                                            </div>

                                            <div class="mb-3">
                                                <small class="text-muted">Last Updated</small>
                                                <div class="fw-medium">{{ $schoolSession->updated_at->format('M j, Y') }}</div>
                                                <small class="text-muted">{{ $schoolSession->updated_at->format('g:i A') }}</small>
                                            </div>

                                            <div class="mb-0">
                                                <small class="text-muted">Session ID</small>
                                                <div class="fw-medium">#{{ $schoolSession->id }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr class="my-4">

                            <div class="row">
                                <div class="col-12">
                                    <h6 class="mb-3">Quick Actions</h6>
                                    <div class="d-flex gap-2 flex-wrap">
                                        @if(!$schoolSession->isActive())
                                            <form action="{{ route('manager.school-sessions.toggle-status', $schoolSession) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-success" onclick="return confirm('Are you sure you want to activate this session? This will deactivate all other sessions.')">
                                                    <i class="bx bx-check-circle me-1"></i>Activate Session
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('manager.school-sessions.toggle-status', $schoolSession) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-warning" onclick="return confirm('Are you sure you want to deactivate this session?')">
                                                    <i class="bx bx-x-circle me-1"></i>Deactivate Session
                                                </button>
                                            </form>
                                        @endif

                                        <a href="{{ route('manager.school-sessions.edit', $schoolSession) }}" class="btn btn-primary">
                                            <i class="bx bx-edit me-1"></i>Edit Session
                                        </a>

                                        <form action="{{ route('manager.school-sessions.destroy', $schoolSession) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this session? This action cannot be undone.')">
                                                <i class="bx bx-trash me-1"></i>Delete Session
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>