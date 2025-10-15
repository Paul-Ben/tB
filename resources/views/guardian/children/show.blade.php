<x-dashboard-layout>
    <x-slot name="title">Student Profile</x-slot>

    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold">Student Profile</h4>
                <div>
                    <a href="{{ route('guardian.children.index') }}" class="btn btn-outline-secondary">
                        <i class="bx bx-arrow-back"></i> All Children
                    </a>
                </div>
            </div>

            <!-- Basic Information -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Basic Information</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 text-center">
                            @if ($student->image)
                                <img src="{{ asset($student->image) }}" alt="{{ $student->full_name }}" class="rounded" style="width:160px;height:160px;object-fit:cover;">
                            @else
                                <div class="avatar mx-auto mb-3">
                                    <span class="avatar-initial rounded-circle bg-label-primary" style="width:160px;height:160px;display:inline-flex;align-items:center;justify-content:center;font-size:56px;">
                                        {{ strtoupper(substr($student->first_name, 0, 1)) }}
                                    </span>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <small class="text-muted">Full Name</small>
                                    <div class="fw-semibold">{{ $student->full_name }}</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <small class="text-muted">Student Number</small>
                                    <div class="fw-semibold">{{ $student->std_number }}</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <small class="text-muted">Date of Birth</small>
                                    <div class="fw-semibold">{{ optional($student->date_of_birth)->format('M j, Y') ?: '—' }}</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <small class="text-muted">Gender</small>
                                    <div class="fw-semibold">{{ ucfirst($student->gender ?? '') }}</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <small class="text-muted">Class</small>
                                    <div class="fw-semibold">{{ optional($student->classroom)->name ?? '—' }}</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <small class="text-muted">Session</small>
                                    <div class="fw-semibold">{{ optional($student->schoolSession)->name ?? '—' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Guardian Information -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Guardian</h5>
                </div>
                <div class="card-body">
                    @if ($student->guardian)
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <small class="text-muted">Name</small>
                                <div class="fw-semibold">{{ $student->guardian->guardian_name }}</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <small class="text-muted">Phone</small>
                                <div class="fw-semibold">{{ $student->guardian->guardian_phone ?? '—' }}</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <small class="text-muted">Email</small>
                                <div class="fw-semibold">{{ $student->guardian->guardian_email ?? '—' }}</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <small class="text-muted">Address</small>
                                <div class="fw-semibold">{{ $student->guardian->address ?? '—' }}</div>
                            </div>
                        </div>
                    @else
                        <div class="text-muted">No guardian information available.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>