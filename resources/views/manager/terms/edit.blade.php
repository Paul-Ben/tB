<x-dashboard-layout>
    <x-slot name="title">Edit Term</x-slot>

    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4">
                <span class="text-muted fw-light">Term Management /</span> Edit Term
            </h4>

            <!-- Alert Messages -->
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row">
                <div class="col-md-8">
                    <!-- Edit Term Form -->
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">Edit Term: {{ $term->name }}</h5>
                            <div class="d-flex gap-2">
                                <a href="{{ route('manager.terms.show', $term) }}" class="btn btn-outline-info">
                                    <i class="bx bx-show me-1"></i> View
                                </a>
                                <a href="{{ route('manager.terms.index') }}" class="btn btn-outline-secondary">
                                    <i class="bx bx-arrow-back me-1"></i> Back to Terms
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('manager.terms.update', $term) }}" method="POST">
                                @csrf
                                @method('PUT')
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="session_id" class="form-label">School Session <span class="text-danger">*</span></label>
                                        <select class="form-select @error('session_id') is-invalid @enderror" id="session_id" name="session_id" required>
                                            <option value="">Select School Session</option>
                                            @foreach($schoolSessions as $session)
                                                <option value="{{ $session->id }}" 
                                                    {{ (old('session_id', $term->session_id) == $session->id) ? 'selected' : '' }}>
                                                    {{ $session->sessionName }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('session_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="name" class="form-label">Term Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                               id="name" name="name" value="{{ old('name', $term->name) }}" 
                                               placeholder="e.g., First Term, Second Term" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="startDate" class="form-label">Start Date</label>
                                        <input type="date" class="form-control @error('startDate') is-invalid @enderror" 
                                               id="startDate" name="startDate" value="{{ old('startDate', $term->startDate) }}">
                                        @error('startDate')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="endDate" class="form-label">End Date</label>
                                        <input type="date" class="form-control @error('endDate') is-invalid @enderror" 
                                               id="endDate" name="endDate" value="{{ old('endDate', $term->endDate) }}">
                                        @error('endDate')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                            <option value="">Select Status</option>
                                            <option value="active" {{ old('status', $term->status) == 'active' ? 'selected' : '' }}>Active</option>
                                            <option value="inactive" {{ old('status', $term->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                        @error('status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('manager.terms.index') }}" class="btn btn-outline-secondary">
                                        Cancel
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bx bx-save me-1"></i> Update Term
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <!-- Term Info Card -->
                    <div class="card mb-3">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="bx bx-info-circle me-2"></i>Term Information
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-2">
                                <strong>Current Session:</strong><br>
                                <span class="badge bg-label-info">{{ $term->schoolSession->sessionName ?? 'N/A' }}</span>
                            </div>
                            <div class="mb-2">
                                <strong>Current Status:</strong><br>
                                @if($term->status === 'active')
                                    <span class="badge bg-label-success">Active</span>
                                @else
                                    <span class="badge bg-label-secondary">Inactive</span>
                                @endif
                            </div>
                            <div class="mb-2">
                                <strong>Created:</strong><br>
                                <small class="text-muted">{{ $term->created_at->format('M d, Y \a\t g:i A') }}</small>
                            </div>
                            <div>
                                <strong>Last Updated:</strong><br>
                                <small class="text-muted">{{ $term->updated_at->format('M d, Y \a\t g:i A') }}</small>
                            </div>
                        </div>
                    </div>

                    <!-- Help Card -->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="bx bx-help-circle me-2"></i>Help
                            </h5>
                        </div>
                        <div class="card-body">
                            <h6>Editing a Term</h6>
                            <ul class="list-unstyled">
                                <li class="mb-2">
                                    <strong>School Session:</strong> You can change the session this term belongs to.
                                </li>
                                <li class="mb-2">
                                    <strong>Term Name:</strong> Update the term name as needed.
                                </li>
                                <li class="mb-2">
                                    <strong>Dates:</strong> Adjust the start and end dates for the term period.
                                </li>
                                <li class="mb-2">
                                    <strong>Status:</strong> Change between "Active" and "Inactive" status.
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Ensure end date is after start date
        document.getElementById('startDate').addEventListener('change', function() {
            const startDate = this.value;
            const endDateInput = document.getElementById('endDate');
            if (startDate) {
                endDateInput.min = startDate;
            }
        });

        document.getElementById('endDate').addEventListener('change', function() {
            const endDate = this.value;
            const startDate = document.getElementById('startDate').value;
            if (startDate && endDate && endDate < startDate) {
                alert('End date must be after start date');
                this.value = '';
            }
        });

        // Set initial min date for end date
        document.addEventListener('DOMContentLoaded', function() {
            const startDate = document.getElementById('startDate').value;
            if (startDate) {
                document.getElementById('endDate').min = startDate;
            }
        });
    </script>
</x-dashboard-layout>