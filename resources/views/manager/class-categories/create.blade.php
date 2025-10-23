<x-dashboard-layout>
    <x-slot name="title">Add Class Category</x-slot>

    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Academic /</span> Add Class Category</h4>

            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="card-title mb-0">Category Information</h5>
                            <a href="{{ route('manager.class-categories.index') }}" class="btn btn-outline-secondary">
                                <i class="bx bx-arrow-back me-1"></i> Back to Categories
                            </a>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('manager.class-categories.store') }}">
                                @csrf

                                <div class="mb-3">
                                    <label class="form-label" for="name">Name *</label>
                                    <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="e.g. Primary, Junior Secondary" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="abbreviation">Abbreviation *</label>
                                    <input type="text" id="abbreviation" name="abbreviation" class="form-control @error('abbreviation') is-invalid @enderror" value="{{ old('abbreviation') }}" placeholder="e.g. PRI, JSS" required>
                                    @error('abbreviation')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="d-flex justify-content-end gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bx bx-save me-1"></i> Save Category
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