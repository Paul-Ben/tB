<x-dashboard-layout>
    <x-slot name="title">My Children</x-slot>

    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Children /</span> All Children</h4>

            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title mb-0">All Children</h5>
                    <form method="GET" action="{{ route('guardian.children.index') }}" class="d-flex" style="gap:.5rem;">
                        <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search by name or ID" />
                        <button type="submit" class="btn btn-primary">Search</button>
                    </form>
                </div>
                <div class="card-body p-0">
                    @if ($students->count())
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Student</th>
                                        <th>Class</th>
                                        <th>Gender</th>
                                        <th>Student No.</th>
                                        <th class="text-end">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($students as $student)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    @if ($student->image)
                                                        <img src="{{ asset($student->image) }}" alt="{{ $student->full_name }}" class="rounded-circle me-2" width="36" height="36">
                                                    @else
                                                        <span class="avatar-initial rounded-circle bg-label-secondary me-2" style="width:36px;height:36px;display:inline-flex;align-items:center;justify-content:center;">
                                                            {{ strtoupper(substr($student->first_name, 0, 1)) }}
                                                        </span>
                                                    @endif
                                                    <div>
                                                        <div class="fw-semibold">{{ $student->full_name }}</div>
                                                        <small class="text-muted">DOB: {{ optional($student->date_of_birth)->format('M j, Y') }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ optional($student->classroom)->name ?? '—' }}</td>
                                            <td>{{ ucfirst($student->gender ?? '') }}</td>
                                            <td>{{ $student->std_number }}</td>
                                            <td class="text-end">
                                                <a href="{{ route('guardian.children.show', $student) }}" class="btn btn-sm btn-outline-primary">
                                                    <i class="bx bx-user"></i> View Profile
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="p-4 text-center text-muted">No children found.</div>
                    @endif
                </div>
                @if ($students->count())
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <small class="text-muted">Showing {{ $students->firstItem() }} to {{ $students->lastItem() }} of {{ $students->total() }} children</small>
                        {{ $students->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-dashboard-layout>