<x-dashboard-layout>
    <div class="content-wrapper">
        <!-- Content Header -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">School Sessions Management</h5>
                            <a href="{{ route('manager.school-sessions.create') }}" class="btn btn-primary">
                                <i class="bx bx-plus me-1"></i>Add New Session
                            </a>
                        </div>

                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="card-body">
                            @if($schoolSessions->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Session Name</th>
                                                <th>Status</th>
                                                <th>Created Date</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($schoolSessions as $session)
                                                <tr>
                                                    <td>{{ $loop->iteration + ($schoolSessions->currentPage() - 1) * $schoolSessions->perPage() }}</td>
                                                    <td>
                                                        <strong>{{ $session->sessionName }}</strong>
                                                    </td>
                                                    <td>
                                                        <span class="badge {{ $session->getStatusBadgeClass() }}">
                                                            {{ ucfirst($session->status) }}
                                                        </span>
                                                    </td>
                                                    <td>{{ $session->created_at->format('M j, Y') }}</td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                                <i class="bx bx-dots-vertical-rounded"></i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item" href="{{ route('manager.school-sessions.show', $session) }}">
                                                                    <i class="bx bx-show me-1"></i> View
                                                                </a>
                                                                <a class="dropdown-item" href="{{ route('manager.school-sessions.edit', $session) }}">
                                                                    <i class="bx bx-edit-alt me-1"></i> Edit
                                                                </a>
                                                                
                                                                <form action="{{ route('manager.school-sessions.toggle-status', $session) }}" method="POST" class="d-inline">
                                                                    @csrf
                                                                    <button type="submit" class="dropdown-item">
                                                                        @if($session->isActive())
                                                                            <i class="bx bx-pause me-1"></i> Deactivate
                                                                        @else
                                                                            <i class="bx bx-play me-1"></i> Activate
                                                                        @endif
                                                                    </button>
                                                                </form>

                                                                @if(!$session->isActive())
                                                                    <div class="dropdown-divider"></div>
                                                                    <form action="{{ route('manager.school-sessions.destroy', $session) }}" method="POST" class="d-inline" 
                                                                          onsubmit="return confirm('Are you sure you want to delete this school session?')">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="dropdown-item text-danger">
                                                                            <i class="bx bx-trash me-1"></i> Delete
                                                                        </button>
                                                                    </form>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Pagination -->
                                <div class="d-flex justify-content-center mt-4">
                                    {{ $schoolSessions->links() }}
                                </div>
                            @else
                                <div class="text-center py-5">
                                    <div class="mb-3">
                                        <i class="bx bx-calendar-alt" style="font-size: 4rem; color: #ddd;"></i>
                                    </div>
                                    <h5 class="text-muted">No School Sessions Found</h5>
                                    <p class="text-muted">Get started by creating your first school session.</p>
                                    <a href="{{ route('manager.school-sessions.create') }}" class="btn btn-primary">
                                        <i class="bx bx-plus me-1"></i>Create School Session
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>