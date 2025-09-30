<x-dashboard-layout>
    <x-slot name="title">Add New Classroom</x-slot>

    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4">
                <span class="text-muted fw-light">Classroom Management /</span> Add New Classroom
            </h4>

            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="card-title mb-0">Classroom Information</h5>
                            <a href="{{ route('manager.classrooms.index') }}" class="btn btn-outline-secondary">
                                <i class="bx bx-arrow-back me-1"></i> Back to Classrooms
                            </a>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('manager.classrooms.store') }}">
                                @csrf
                                
                                <!-- Classroom Information -->
                                <div class="mb-4">
                                    <h6 class="mb-3 text-primary">
                                        <i class="bx bx-book-open me-1"></i> Classroom Details
                                    </h6>
                                    
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <label class="form-label" for="name">Classroom Name *</label>
                                            <input 
                                                type="text" 
                                                class="form-control @error('name') is-invalid @enderror" 
                                                id="name" 
                                                name="name" 
                                                value="{{ old('name') }}" 
                                                placeholder="e.g., Primary 1A, JSS 2B, SS 3C" 
                                                required
                                            >
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <div class="form-text">Enter a unique name for the classroom</div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label" for="category_id">Class Category *</label>
                                            <select 
                                                class="form-select @error('category_id') is-invalid @enderror" 
                                                id="category_id" 
                                                name="category_id" 
                                                required
                                            >
                                                <option value="">Select a category</option>
                                                @foreach($classCategories as $category)
                                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <div class="form-text">Select the appropriate category for this classroom</div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label" for="teacher_id">Assign Teacher (Optional)</label>
                                            <select 
                                                class="form-select @error('teacher_id') is-invalid @enderror" 
                                                id="teacher_id" 
                                                name="teacher_id"
                                            >
                                                <option value="">No teacher assigned</option>
                                                @foreach($availableTeachers as $teacher)
                                                    <option value="{{ $teacher->id }}" {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>
                                                        {{ $teacher->full_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('teacher_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <div class="form-text">You can assign a teacher now or later</div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Form Actions -->
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('manager.classrooms.index') }}" class="btn btn-outline-secondary">
                                        <i class="bx bx-x me-1"></i> Cancel
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bx bx-check me-1"></i> Create Classroom
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Help Card -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="card-title mb-0">
                                <i class="bx bx-help-circle me-1"></i> Help & Tips
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <h6 class="text-primary">Classroom Naming</h6>
                                <p class="small text-muted">
                                    Use clear, descriptive names like "Primary 1A", "JSS 2B", or "SS 3 Science".
                                </p>
                            </div>
                            
                            <div class="mb-3">
                                <h6 class="text-primary">Categories</h6>
                                <p class="small text-muted">
                                    Categories help organize classrooms by level (Primary, Junior Secondary, Senior Secondary).
                                </p>
                            </div>
                            
                            <div class="mb-3">
                                <h6 class="text-primary">Teacher Assignment</h6>
                                <p class="small text-muted">
                                    You can assign a teacher during creation or later. Only teachers without assigned classrooms are shown.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- / Content -->
    </div>
    <!-- Content wrapper -->
</x-dashboard-layout>