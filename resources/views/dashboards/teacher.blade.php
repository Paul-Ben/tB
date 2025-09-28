<x-dashboard-layout>
    <x-slot name="title">Teacher Dashboard</x-slot>

    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> Teacher Overview</h4>

            <!-- Welcome Banner -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card bg-primary">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="avatar me-3">
                                    <img src="{{ asset('assets/img/avatars/1.png') }}" alt="Avatar" class="rounded-circle">
                                </div>
                                <div>
                                    <h5 class="card-title text-white mb-1">Welcome back, {{ $user->name }}!</h5>
                                    <p class="card-text text-white opacity-75 mb-0">Ready to inspire and educate today?</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="row">
                <div class="col-lg-6 col-md-6 col-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <img src="{{ asset('assets/img/icons/unicons/chart-success.png') }}" alt="Students" class="rounded">
                                </div>
                                <div class="dropdown">
                                    <button class="btn p-0" type="button" id="cardOpt1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt1">
                                        <a class="dropdown-item" href="javascript:void(0);">View All Students</a>
                                        <a class="dropdown-item" href="javascript:void(0);">Attendance</a>
                                    </div>
                                </div>
                            </div>
                            <span class="fw-semibold d-block mb-1">My Students</span>
                            <h3 class="card-title mb-2">{{ $studentCount }}</h3>
                            <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> Active students</small>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6 col-md-6 col-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <img src="{{ asset('assets/img/icons/unicons/wallet-info.png') }}" alt="Classes" class="rounded">
                                </div>
                                <div class="dropdown">
                                    <button class="btn p-0" type="button" id="cardOpt2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt2">
                                        <a class="dropdown-item" href="javascript:void(0);">View All Classes</a>
                                        <a class="dropdown-item" href="javascript:void(0);">Schedule</a>
                                    </div>
                                </div>
                            </div>
                            <span class="fw-semibold d-block mb-1">My Classes</span>
                            <h3 class="card-title mb-2">{{ $classCount }}</h3>
                            <small class="text-info fw-semibold"><i class="bx bx-book"></i> Active classes</small>
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
                                    <i class="bx bx-book-open bx-md"></i>
                                </span>
                            </div>
                            <h5 class="card-title">Manage Classes</h5>
                            <p class="card-text">View and organize your classes</p>
                            <a href="#" class="btn btn-primary">Manage Classes</a>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6 col-12 mb-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <div class="avatar mx-auto mb-3">
                                <span class="avatar-initial rounded-circle bg-label-success">
                                    <i class="bx bx-user-check bx-md"></i>
                                </span>
                            </div>
                            <h5 class="card-title">View Students</h5>
                            <p class="card-text">Access student information</p>
                            <a href="#" class="btn btn-success">View Students</a>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6 col-12 mb-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <div class="avatar mx-auto mb-3">
                                <span class="avatar-initial rounded-circle bg-label-info">
                                    <i class="bx bx-task bx-md"></i>
                                </span>
                            </div>
                            <h5 class="card-title">Assignments</h5>
                            <p class="card-text">Create and manage assignments</p>
                            <a href="#" class="btn btn-info">Assignments</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Today's Schedule & Recent Activity -->
            <div class="row">
                <!-- Today's Schedule -->
                <div class="col-lg-6 col-12 mb-4">
                    <div class="card h-100">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="card-title m-0">Today's Schedule</h5>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="scheduleDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="scheduleDropdown">
                                    <a class="dropdown-item" href="javascript:void(0);">View Full Schedule</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Add Event</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="timeline">
                                <div class="timeline-item">
                                    <div class="timeline-point timeline-point-primary"></div>
                                    <div class="timeline-event">
                                        <div class="timeline-header mb-1">
                                            <h6 class="mb-0">Math Class - Grade 5</h6>
                                            <small class="text-muted">9:00 AM - 10:00 AM</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="timeline-item">
                                    <div class="timeline-point timeline-point-success"></div>
                                    <div class="timeline-event">
                                        <div class="timeline-header mb-1">
                                            <h6 class="mb-0">Science Lab - Grade 5</h6>
                                            <small class="text-muted">11:00 AM - 12:00 PM</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="timeline-item">
                                    <div class="timeline-point timeline-point-info"></div>
                                    <div class="timeline-event">
                                        <div class="timeline-header mb-1">
                                            <h6 class="mb-0">English Literature - Grade 6</h6>
                                            <small class="text-muted">2:00 PM - 3:00 PM</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="col-lg-6 col-12 mb-4">
                    <div class="card h-100">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="card-title m-0">Recent Activity</h5>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="activityDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="activityDropdown">
                                    <a class="dropdown-item" href="javascript:void(0);">View All</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Clear History</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled">
                                <li class="d-flex mb-4 pb-1">
                                    <div class="avatar flex-shrink-0 me-3">
                                        <span class="avatar-initial rounded bg-label-primary">
                                            <i class="bx bx-task"></i>
                                        </span>
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <h6 class="mb-0">Assignment created</h6>
                                            <small class="text-muted">Math homework for Grade 5</small>
                                        </div>
                                        <div class="user-progress">
                                            <small class="fw-semibold">2h ago</small>
                                        </div>
                                    </div>
                                </li>
                                <li class="d-flex mb-4 pb-1">
                                    <div class="avatar flex-shrink-0 me-3">
                                        <span class="avatar-initial rounded bg-label-success">
                                            <i class="bx bx-check"></i>
                                        </span>
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <h6 class="mb-0">Grade submitted</h6>
                                            <small class="text-muted">Science test results uploaded</small>
                                        </div>
                                        <div class="user-progress">
                                            <small class="fw-semibold">1d ago</small>
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