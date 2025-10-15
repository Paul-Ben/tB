<x-dashboard-layout>
    <x-slot name="title">My Classes</x-slot>

    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4">
                <span class="text-muted fw-light">Teaching /</span> All Classes
            </h4>

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Assigned Classes</h5>
                    <div class="text-muted">
                        Teacher: {{ $teacher->user->name }}
                    </div>
                </div>

                <!-- Filters -->
                <div class="card-body border-bottom">
                    <form method="GET" action="{{ route('teacher.classes.index') }}" class="row g-3">
                        <div class="col-md-8 col-lg-9">
                            <input type="text" class="form-control" name="search" placeholder="Search classes by name or category..." value="{{ request('search') }}">
                        </div>
                        <div class="col-md-4 col-lg-3">
                            <button type="submit" class="btn btn-outline-primary w-100">
                                <i class="bx bx-search me-1"></i> Search
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Classes Grid -->
                <div class="card-body">
                    @if($classrooms->count() > 0)
                        <div class="row">
                            @foreach($classrooms as $classroom)
                                <div class="col-md-6 col-lg-4 mb-4">
                                    <div class="card h-100">
                                        <div class="card-header d-flex align-items-center justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar avatar-sm me-3">
                                                    <span class="avatar-initial rounded-circle bg-label-primary">
                                                        <i class="bx bx-book-open"></i>
                                                    </span>
                                                </div>
                                                <h6 class="mb-0">{{ $classroom->name }}</h6>
                                            </div>
                                            @if($classroom->classCategory)
                                                <span class="badge bg-label-info">{{ $classroom->classCategory->name }}</span>
                                            @else
                                                <span class="text-muted small">No category</span>
                                            @endif
                                        </div>
                                        <div class="card-body">
                                            <div class="d-flex align-items-center mb-2">
                                                <span class="badge bg-label-secondary me-2">{{ $classroom->students->count() }}</span>
                                                <span class="text-muted">students enrolled</span>
                                            </div>
                                            <div class="text-muted small">Created: {{ $classroom->created_at?->diffForHumans() }}</div>
                                        </div>
                                        <div class="card-footer d-flex justify-content-between align-items-center">
                                            <div class="text-muted small">ID: {{ $classroom->id }}</div>
                                            <a href="{{ route('teacher.classes.show', $classroom->id) }}" class="btn btn-sm btn-outline-primary">
                                                <i class="bx bx-show-alt me-1"></i> View Class
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-5">
                            <div class="avatar mx-auto mb-3">
                                <span class="avatar-initial rounded-circle bg-label-secondary">
                                    <i class="bx bx-building bx-md"></i>
                                </span>
                            </div>
                            <h5 class="mb-1">No classes assigned</h5>
                            <p class="text-muted">You currently don't have any classes assigned to you.</p>
                        </div>
                    @endif
                </div>

                <!-- Pagination -->
                @if($classrooms->hasPages())
                    <div class="card-footer">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="text-muted">
                                Showing {{ $classrooms->firstItem() }} to {{ $classrooms->lastItem() }} of {{ $classrooms->total() }} results
                            </div>
                            {{ $classrooms->links() }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-dashboard-layout>