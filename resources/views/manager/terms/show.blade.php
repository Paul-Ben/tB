<x-dashboard-layout>
    <x-slot name="title">View Term</x-slot>

    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4">
                <span class="text-muted fw-light">Term Management /</span> {{ $term->name }}
            </h4>

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

            <div class="row">
                <div class="col-md-8">
                    <!-- Term Details Card -->
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">Term Details</h5>
                            <div class="d-flex gap-2">
                                <a href="{{ route('manager.terms.edit', $term) }}" class="btn btn-primary">
                                    <i class="bx bx-edit-alt me-1"></i> Edit Term
                                </a>
                                <a href="{{ route('manager.terms.index') }}" class="btn btn-outline-secondary">
                                    <i class="bx bx-arrow-back me-1"></i> Back to Terms
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <h6 class="text-muted mb-2">Term Name</h6>
                                    <h5 class="mb-0">{{ $term->name }}</h5>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <h6 class="text-muted mb-2">School Session</h6>
                                    <span class="badge bg-label-info fs-6">{{ $term->schoolSession->sessionName ?? 'N/A' }}</span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <h6 class="text-muted mb-2">Start Date</h6>
                                    <p class="mb-0">
                                        @if($term->startDate)
                                            <i class="bx bx-calendar me-1"></i>
                                            {{ \Carbon\Carbon::parse($term->startDate)->format('l, F j, Y') }}
                                        @else
                                            <span class="text-muted">Not set</span>
                                        @endif
                                    </p>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <h6 class="text-muted mb-2">End Date</h6>
                                    <p class="mb-0">
                                        @if($term->endDate)
                                            <i class="bx bx-calendar me-1"></i>
                                            {{ \Carbon\Carbon::parse($term->endDate)->format('l, F j, Y') }}
                                        @else
                                            <span class="text-muted">Not set</span>
                                        @endif
                                    </p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <h6 class="text-muted mb-2">Status</h6>
                                    @if($term->status === 'active')
                                        <span class="badge bg-label-success fs-6">
                                            <i class="bx bx-check-circle me-1"></i>Active
                                        </span>
                                    @else
                                        <span class="badge bg-label-secondary fs-6">
                                            <i class="bx bx-x-circle me-1"></i>Inactive
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-6 mb-4">
                                    <h6 class="text-muted mb-2">Duration</h6>
                                    <p class="mb-0">
                                        @if($term->startDate && $term->endDate)
                                            @php
                                                $start = \Carbon\Carbon::parse($term->startDate);
                                                $end = \Carbon\Carbon::parse($term->endDate);
                                                $duration = $start->diffInDays($end) + 1;
                                            @endphp
                                            <i class="bx bx-time me-1"></i>
                                            {{ $duration }} days
                                        @else
                                            <span class="text-muted">Cannot calculate</span>
                                        @endif
                                    </p>
                                </div>
                            </div>

                            @if($term->startDate && $term->endDate)
                                <div class="row">
                                    <div class="col-12">
                                        <h6 class="text-muted mb-2">Term Progress</h6>
                                        @php
                                            $now = \Carbon\Carbon::now();
                                            $start = \Carbon\Carbon::parse($term->startDate);
                                            $end = \Carbon\Carbon::parse($term->endDate);
                                            
                                            if ($now->lt($start)) {
                                                $status = 'upcoming';
                                                $progress = 0;
                                            } elseif ($now->gt($end)) {
                                                $status = 'completed';
                                                $progress = 100;
                                            } else {
                                                $status = 'ongoing';
                                                $totalDays = $start->diffInDays($end);
                                                $elapsedDays = $start->diffInDays($now);
                                                $progress = $totalDays > 0 ? round(($elapsedDays / $totalDays) * 100) : 0;
                                            }
                                        @endphp
                                        
                                        <div class="progress mb-2" style="height: 10px;">
                                            <div class="progress-bar 
                                                @if($status === 'upcoming') bg-info
                                                @elseif($status === 'ongoing') bg-primary
                                                @else bg-success
                                                @endif" 
                                                role="progressbar" 
                                                style="width: {{ $progress }}%" 
                                                aria-valuenow="{{ $progress }}" 
                                                aria-valuemin="0" 
                                                aria-valuemax="100">
                                            </div>
                                        </div>
                                        <small class="text-muted">
                                            @if($status === 'upcoming')
                                                Term starts in {{ $now->diffInDays($start) }} days
                                            @elseif($status === 'ongoing')
                                                {{ $progress }}% complete ({{ $now->diffInDays($end) }} days remaining)
                                            @else
                                                Term completed {{ $now->diffInDays($end) }} days ago
                                            @endif
                                        </small>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <!-- Quick Actions Card -->
                    <div class="card mb-3">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="bx bx-cog me-2"></i>Quick Actions
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="d-grid gap-2">
                                <a href="{{ route('manager.terms.edit', $term) }}" class="btn btn-outline-primary">
                                    <i class="bx bx-edit-alt me-1"></i> Edit Term
                                </a>
                                <button class="btn btn-outline-danger" onclick="confirmDelete('{{ $term->id }}', '{{ $term->name }}')">
                                    <i class="bx bx-trash me-1"></i> Delete Term
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Term Information Card -->
                    <div class="card mb-3">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="bx bx-info-circle me-2"></i>Term Information
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <strong>Created:</strong><br>
                                <small class="text-muted">{{ $term->created_at->format('M d, Y \a\t g:i A') }}</small>
                            </div>
                            <div class="mb-3">
                                <strong>Last Updated:</strong><br>
                                <small class="text-muted">{{ $term->updated_at->format('M d, Y \a\t g:i A') }}</small>
                            </div>
                            @if($term->schoolSession)
                                <div>
                                    <strong>Session Details:</strong><br>
                                    <small class="text-muted">{{ $term->schoolSession->sessionName }}</small>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Related Information Card -->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="bx bx-link me-2"></i>Related Information
                            </h5>
                        </div>
                        <div class="card-body">
                            <p class="text-muted small mb-2">This term is associated with:</p>
                            <ul class="list-unstyled">
                                <li class="mb-1">
                                    <i class="bx bx-calendar-alt me-1"></i>
                                    <strong>{{ $term->schoolSession->sessionName ?? 'No Session' }}</strong>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
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