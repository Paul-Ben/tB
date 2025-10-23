<x-dashboard-layout>
    <x-slot name="title">Edit Class Category</x-slot>

    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Academic /</span> Edit Class Category</h4>

            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="card-title mb-0">Edit {{ $classCategory->name }}</h5>
                            <div class="d-flex gap-2">
                                <a href="{{ route('manager.class-categories.show', $classCategory) }}" class="btn btn-outline-info">
                                    <i class="bx bx-show-alt me-1"></i> View
                                </a>
                                <a href="{{ route('manager.class-categories.index') }}" class="btn btn-outline-secondary">
                                    <i class="bx bx-arrow-back me-1"></i> Back to Categories
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('manager.class-categories.update', $classCategory) }}">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label class="form-label" for="name">Name *</label>
                                    <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $classCategory->name) }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="abbreviation">Abbreviation *</label>
                                    <input type="text" id="abbreviation" name="abbreviation" class="form-control @error('abbreviation') is-invalid @enderror" value="{{ old('abbreviation', $classCategory->abbreviation) }}" required>
                                    @error('abbreviation')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="d-flex justify-content-end gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bx bx-save me-1"></i> Update Category
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