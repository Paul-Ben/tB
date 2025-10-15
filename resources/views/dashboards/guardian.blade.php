<x-dashboard-layout>
    <x-slot name="title">Guardian Dashboard</x-slot>

    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> Guardian Overview</h4>

            <!-- Welcome Banner -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card bg-success">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="avatar me-3">
                                    <img src="{{ asset('assets/img/avatars/1.png') }}" alt="Avatar" class="rounded-circle">
                                </div>
                                <div>
                                    <h5 class="card-title text-white mb-1">Welcome, {{ $user->name }}!</h5>
                                    <p class="card-text text-white opacity-75 mb-0">Stay connected with your child's education journey.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="row">
                <div class="col-lg-4 col-md-4 col-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <img src="{{ asset('assets/img/icons/unicons/chart-success.png') }}" alt="Children" class="rounded">
                                </div>
                                <div class="dropdown">
                                    <button class="btn p-0" type="button" id="cardOpt1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt1">
                                        <a class="dropdown-item" href="javascript:void(0);">View All Children</a>
                                        <a class="dropdown-item" href="javascript:void(0);">Child Profiles</a>
                                    </div>
                                </div>
                            </div>
                            <span class="fw-semibold d-block mb-1">My Children</span>
                            <h3 class="card-title mb-2">{{ $childrenCount }}</h3>
                            <small class="text-success fw-semibold"><i class="bx bx-user"></i> Enrolled children</small>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-4 col-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <img src="{{ asset('assets/img/icons/unicons/wallet-info.png') }}" alt="Tasks" class="rounded">
                                </div>
                                <div class="dropdown">
                                    <button class="btn p-0" type="button" id="cardOpt2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt2">
                                        <a class="dropdown-item" href="javascript:void(0);">View All Tasks</a>
                                        <a class="dropdown-item" href="javascript:void(0);">Mark Complete</a>
                                    </div>
                                </div>
                            </div>
                            <span class="fw-semibold d-block mb-1">Pending Tasks</span>
                            <h3 class="card-title mb-2">3</h3>
                            <small class="text-warning fw-semibold"><i class="bx bx-time"></i> Requires attention</small>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4 col-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <img src="{{ asset('assets/img/icons/unicons/paypal.png') }}" alt="Grades" class="rounded">
                                </div>
                                <div class="dropdown">
                                    <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                        <a class="dropdown-item" href="javascript:void(0);">View Grade Report</a>
                                        <a class="dropdown-item" href="javascript:void(0);">Grade History</a>
                                    </div>
                                </div>
                            </div>
                            <span class="fw-semibold d-block mb-1">This Week's Grades</span>
                            <h3 class="card-title mb-2 text-success">A-</h3>
                            <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> Excellent performance</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="row">
                <div class="col-lg-4 col-md-6 col-12 mb-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <div class="avatar mx-auto mb-3">
                                <span class="avatar-initial rounded-circle bg-label-primary">
                                    <i class="bx bx-bar-chart-alt-2 bx-md"></i>
                                </span>
                            </div>
                            <h5 class="card-title">View Grades</h5>
                            <p class="card-text">Check your child's academic progress</p>
                            <a href="#" class="btn btn-primary">View Grades</a>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6 col-12 mb-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <div class="avatar mx-auto mb-3">
                                <span class="avatar-initial rounded-circle bg-label-success">
                                    <i class="bx bx-calendar-check bx-md"></i>
                                </span>
                            </div>
                            <h5 class="card-title">Attendance</h5>
                            <p class="card-text">Track attendance records</p>
                            <a href="#" class="btn btn-success">View Attendance</a>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6 col-12 mb-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <div class="avatar mx-auto mb-3">
                                <span class="avatar-initial rounded-circle bg-label-info">
                                    <i class="bx bx-message-dots bx-md"></i>
                                </span>
                            </div>
                            <h5 class="card-title">Messages</h5>
                            <p class="card-text">Communicate with teachers</p>
                            <a href="#" class="btn btn-info">View Messages</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Upcoming Events & Recent Updates -->
            <!-- My Children Table -->
            <div class="row">
                <div class="col-12 mb-4">
                    <div class="card h-100">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="card-title m-0">My Children</h5>
                            <small class="text-muted">Total: {{ $children->total() }}</small>
                        </div>
                        <div class="card-body p-0">
                            @if ($children->count())
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead>
                                            <tr>
                                                <th>Student</th>
                                                <th>Class</th>
                                                <th>Gender</th>
                                                <th>Student No.</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($children as $child)
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            @if ($child->image)
                                                                <img src="{{ asset($child->image) }}" alt="{{ $child->full_name }}" class="rounded-circle me-2" width="36" height="36">
                                                            @else
                                                                <span class="avatar-initial rounded-circle bg-label-secondary me-2" style="width:36px;height:36px;display:inline-flex;align-items:center;justify-content:center;">
                                                                    {{ strtoupper(substr($child->first_name, 0, 1)) }}
                                                                </span>
                                                            @endif
                                                            <div>
                                                                <div class="fw-semibold">{{ $child->full_name }}</div>
                                                                <small class="text-muted">DOB: {{ optional($child->date_of_birth)->format('M j, Y') }}</small>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>{{ optional($child->classroom)->name ?? '—' }}</td>
                                                    <td>{{ ucfirst($child->gender ?? '') }}</td>
                                                    <td>{{ $child->std_number }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="p-4 text-center text-muted">
                                    You have no children linked to your account yet.
                                </div>
                            @endif
                        </div>
                        @if ($children->count())
                            <div class="card-footer">
                                {{ $children->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            
            <!-- Upcoming Events & Recent Updates -->
            <div class="row">
                <!-- Upcoming Events -->
                <div class="col-lg-6 col-12 mb-4">
                    <div class="card h-100">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="card-title m-0">Upcoming Events</h5>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="eventsDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="eventsDropdown">
                                    <a class="dropdown-item" href="javascript:void(0);">View All Events</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Calendar View</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="timeline">
                                <div class="timeline-item">
                                    <div class="timeline-point timeline-point-primary"></div>
                                    <div class="timeline-event">
                                        <div class="timeline-header mb-1">
                                            <h6 class="mb-0">Parent-Teacher Conference</h6>
                                            <small class="text-muted">Tomorrow at 3:00 PM</small>
                                        </div>
                                        <p class="text-muted mb-0">Room 205 with Ms. Johnson</p>
                                    </div>
                                </div>
                                <div class="timeline-item">
                                    <div class="timeline-point timeline-point-success"></div>
                                    <div class="timeline-event">
                                        <div class="timeline-header mb-1">
                                            <h6 class="mb-0">School Science Fair</h6>
                                            <small class="text-muted">Friday, Oct 15th</small>
                                        </div>
                                        <p class="text-muted mb-0">Gym Hall - 10:00 AM to 3:00 PM</p>
                                    </div>
                                </div>
                                <div class="timeline-item">
                                    <div class="timeline-point timeline-point-warning"></div>
                                    <div class="timeline-event">
                                        <div class="timeline-header mb-1">
                                            <h6 class="mb-0">Field Trip Permission</h6>
                                            <small class="text-muted">Due: Oct 20th</small>
                                        </div>
                                        <p class="text-muted mb-0">Natural History Museum visit</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Updates -->
                <div class="col-lg-6 col-12 mb-4">
                    <div class="card h-100">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="card-title m-0">Recent Updates</h5>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="updatesDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="updatesDropdown">
                                    <a class="dropdown-item" href="javascript:void(0);">View All Updates</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Mark as Read</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled">
                                <li class="d-flex mb-4 pb-1">
                                    <div class="avatar flex-shrink-0 me-3">
                                        <span class="avatar-initial rounded bg-label-success">
                                            <i class="bx bx-check"></i>
                                        </span>
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <h6 class="mb-0">Math Assignment Graded</h6>
                                            <small class="text-muted">Sarah received an A on her algebra homework</small>
                                        </div>
                                        <div class="user-progress">
                                            <small class="fw-semibold">2h ago</small>
                                        </div>
                                    </div>
                                </li>
                                <li class="d-flex mb-4 pb-1">
                                    <div class="avatar flex-shrink-0 me-3">
                                        <span class="avatar-initial rounded bg-label-primary">
                                            <i class="bx bx-message"></i>
                                        </span>
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <h6 class="mb-0">Teacher Message</h6>
                                            <small class="text-muted">Ms. Johnson: "Great participation in class today!"</small>
                                        </div>
                                        <div class="user-progress">
                                            <small class="fw-semibold">1d ago</small>
                                        </div>
                                    </div>
                                </li>
                                <li class="d-flex mb-4 pb-1">
                                    <div class="avatar flex-shrink-0 me-3">
                                        <span class="avatar-initial rounded bg-label-warning">
                                            <i class="bx bx-error"></i>
                                        </span>
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <h6 class="mb-0">Reminder</h6>
                                            <small class="text-muted">Library book is due tomorrow</small>
                                        </div>
                                        <div class="user-progress">
                                            <small class="fw-semibold">2d ago</small>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- / Content -->
    </div>
    <!-- Content wrapper -->
</x-dashboard-layout>