<x-dashboard-layout>
    <x-slot name="title">{{ $classCategory->name }} - Category Details</x-slot>

    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Academic /</span> {{ $classCategory->name }}</h4>

            <div class="row">
                <div class="col-md-8">
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="card-title mb-0"><i class="bx bx-category me-2"></i>Category Details</h5>
                            <div class="d-flex gap-2">
                                <a href="{{ route('manager.class-categories.edit', $classCategory) }}" class="btn btn-outline-primary">
                                    <i class="bx bx-edit-alt me-1"></i> Edit
                                </a>
                                <a href="{{ route('manager.class-categories.index') }}" class="btn btn-outline-secondary">
                                    <i class="bx bx-arrow-back me-1"></i> Back to Categories
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <dl class="row mb-0">
                                <dt class="col-sm-3">Name</dt>
                                <dd class="col-sm-9">{{ $classCategory->name }}</dd>
                                <dt class="col-sm-3">Abbreviation</dt>
                                <dd class="col-sm-9"><span class="badge bg-label-info">{{ $classCategory->abbreviation }}</span></dd>
                                <dt class="col-sm-3">Classrooms</dt>
                                <dd class="col-sm-9">{{ $classCategory->classrooms_count }}</dd>
                                <dt class="col-sm-3">Created</dt>
                                <dd class="col-sm-9">{{ $classCategory->created_at?->format('M d, Y') }}</dd>
                            </dl>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Classrooms in this Category</h5>
                        </div>
                        <div class="table-responsive text-nowrap">
                            @if($classrooms->count() > 0)
                                <table class="table table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Name</th>
                                            <th>Teacher</th>
                                            <th>Students</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($classrooms as $classroom)
                                            <tr>
                                                <td>{{ $classroom->name }}</td>
                                                <td>
                                                    @if($classroom->teacher)
                                                        {{ $classroom->teacher->first_name }} {{ $classroom->teacher->last_name }}
                                                    @else
                                                        <span class="text-muted">Unassigned</span>
                                                    @endif
                                                </td>
                                                <td>{{ $classroom->students()->count() }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="p-4">
                                    <div class="text-center text-muted">
                                        <i class="bx bx-info-circle me-1"></i> No classrooms found for this category.
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="card-footer">
                            {{ $classrooms->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>