<x-dashboard-layout>
    <div class="content-wrapper">
        <!-- Content Header -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Edit School Session</h5>
                            <a href="{{ route('manager.school-sessions.index') }}" class="btn btn-secondary">
                                <i class="bx bx-arrow-back me-1"></i>Back to Sessions
                            </a>
                        </div>

                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="card-body">
                            <form action="{{ route('manager.school-sessions.update', $schoolSession) }}" method="POST">
                                @csrf
                                @method('PUT')
                                
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="mb-3">
                                            <label for="sessionName" class="form-label">Session Name <span class="text-danger">*</span></label>
                                            <input type="text" 
                                                   class="form-control @error('sessionName') is-invalid @enderror" 
                                                   id="sessionName" 
                                                   name="sessionName" 
                                                   value="{{ old('sessionName', $schoolSession->sessionName) }}" 
                                                   placeholder="e.g., 2024/2025 Academic Session"
                                                   required>
                                            @error('sessionName')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <div class="form-text">Enter a descriptive name for the school session</div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                            <select class="form-select @error('status') is-invalid @enderror" 
                                                    id="status" 
                                                    name="status" 
                                                    required>
                                                <option value="">Select Status</option>
                                                <option value="active" {{ old('status', $schoolSession->status) === 'active' ? 'selected' : '' }}>Active</option>
                                                <option value="inactive" {{ old('status', $schoolSession->status) === 'inactive' ? 'selected' : '' }}>Inactive</option>
                                            </select>
                                            @error('status')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <div class="form-text">Only one session can be active at a time</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="alert alert-info">
                                    <i class="bx bx-info-circle me-2"></i>
                                    <strong>Note:</strong> If you set this session as active, all other sessions will be automatically deactivated.
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Created Date</label>
                                            <input type="text" class="form-control" value="{{ $schoolSession->created_at->format('M j, Y \a\t g:i A') }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Last Updated</label>
                                            <input type="text" class="form-control" value="{{ $schoolSession->updated_at->format('M j, Y \a\t g:i A') }}" readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('manager.school-sessions.index') }}" class="btn btn-secondary">
                                        <i class="bx bx-x me-1"></i>Cancel
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bx bx-save me-1"></i>Update Session
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>