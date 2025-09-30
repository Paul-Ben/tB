<x-dashboard-layout>
    <x-slot name="title">Create Term</x-slot>

    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4">
                <span class="text-muted fw-light">Term Management /</span> Create Term
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
                    <!-- Create Term Form -->
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">Term Information</h5>
                            <a href="{{ route('manager.terms.index') }}" class="btn btn-outline-secondary">
                                <i class="bx bx-arrow-back me-1"></i> Back to Terms
                            </a>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('manager.terms.store') }}" method="POST">
                                @csrf
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="session_id" class="form-label">School Session <span class="text-danger">*</span></label>
                                        <select class="form-select @error('session_id') is-invalid @enderror" id="session_id" name="session_id" required>
                                            <option value="">Select School Session</option>
                                            @foreach($schoolSessions as $session)
                                                <option value="{{ $session->id }}" {{ old('session_id') == $session->id ? 'selected' : '' }}>
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
                                               id="name" name="name" value="{{ old('name') }}" 
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
                                               id="startDate" name="startDate" value="{{ old('startDate') }}">
                                        @error('startDate')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="endDate" class="form-label">End Date</label>
                                        <input type="date" class="form-control @error('endDate') is-invalid @enderror" 
                                               id="endDate" name="endDate" value="{{ old('endDate') }}">
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
                                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
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
                                        <i class="bx bx-save me-1"></i> Create Term
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <!-- Help Card -->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="bx bx-help-circle me-2"></i>Help
                            </h5>
                        </div>
                        <div class="card-body">
                            <h6>Creating a Term</h6>
                            <ul class="list-unstyled">
                                <li class="mb-2">
                                    <strong>School Session:</strong> Select the academic session this term belongs to.
                                </li>
                                <li class="mb-2">
                                    <strong>Term Name:</strong> Enter a descriptive name for the term (e.g., "First Term", "Second Term").
                                </li>
                                <li class="mb-2">
                                    <strong>Dates:</strong> Set the start and end dates for the term period.
                                </li>
                                <li class="mb-2">
                                    <strong>Status:</strong> Set to "Active" for the current term or "Inactive" for future/past terms.
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
    </script>
</x-dashboard-layout>