<x-dashboard-layout>
    <x-slot name="title">Class Categories</x-slot>

    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Academic /</span> Class Categories</h4>

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

            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title mb-0">Categories ({{ $categories->total() }})</h5>
                    <div class="d-flex gap-2">
                        <a href="{{ route('manager.class-categories.create') }}" class="btn btn-primary">
                            <i class="bx bx-plus me-1"></i> New Category
                        </a>
                    </div>
                </div>
                <div class="card-body border-bottom">
                    <form method="GET" action="{{ route('manager.class-categories.index') }}" class="row g-3">
                        <div class="col-md-8 col-lg-9">
                            <input type="text" class="form-control" name="search" placeholder="Search by name or abbreviation..." value="{{ request('search') }}">
                        </div>
                        <div class="col-md-4 col-lg-3">
                            <button type="submit" class="btn btn-outline-primary w-100">
                                <i class="bx bx-search me-1"></i> Search
                            </button>
                        </div>
                    </form>
                </div>

                <div class="table-responsive text-nowrap">
                    @if($categories->count() > 0)
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Name</th>
                                    <th>Abbreviation</th>
                                    <th>Classrooms</th>
                                    <th>Created</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $category)
                                    <tr>
                                        <td>{{ $category->name }}</td>
                                        <td><span class="badge bg-label-info">{{ $category->abbreviation }}</span></td>
                                        <td>{{ $category->classrooms_count }}</td>
                                        <td>{{ $category->created_at?->format('M d, Y') }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="{{ route('manager.class-categories.show', $category) }}">
                                                        <i class="bx bx-show-alt me-1"></i> View
                                                    </a>
                                                    <a class="dropdown-item" href="{{ route('manager.class-categories.edit', $category) }}">
                                                        <i class="bx bx-edit-alt me-1"></i> Edit
                                                    </a>
                                                    <div class="dropdown-divider"></div>
                                                    <button type="button" class="dropdown-item text-danger" onclick="showDeleteModal('{{ $category->id }}', '{{ $category->name }}')">
                                                        <i class="bx bx-trash me-1"></i> Delete
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="p-4">
                            <div class="text-center text-muted">
                                <i class="bx bx-info-circle me-1"></i> No categories found.
                            </div>
                        </div>
                    @endif
                </div>

                <div class="card-footer">
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete <strong id="deleteItemName"></strong>? This action cannot be undone.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form id="deleteForm" method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="bx bx-trash me-1"></i> Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showDeleteModal(id, name) {
            document.getElementById('deleteItemName').textContent = name;
            const deleteUrl = `{{ url('/manager/class-categories') }}/${id}`;
            document.getElementById('deleteForm').action = deleteUrl;
            new bootstrap.Modal(document.getElementById('deleteModal')).show();
        }
    </script>
</x-dashboard-layout>