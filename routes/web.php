<?php

use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('/about-us', [FrontendController::class, 'about'])->name('about');
Route::get('/contact-us', [FrontendController::class, 'contact'])->name('contact');

Route::get('/dashboard', function () {
    $user = auth()->user();
    $role = $user->getPrimaryRole();
    
    return match ($role) {
        'admin' => redirect()->route('admin.dashboard'),
        'manager' => redirect()->route('manager.dashboard'),
        'teacher' => redirect()->route('teacher.dashboard'),
        'guardian' => redirect()->route('guardian.dashboard'),
        default => view('dashboard')
    };
})->middleware(['auth', 'verified'])->name('dashboard');

// Role-specific dashboard routes
Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [App\Http\Controllers\AdminDashboardController::class, 'index'])
        ->name('admin.dashboard');
    
    // User Management Routes
    Route::resource('admin/users', App\Http\Controllers\AdminUserController::class, [
        'names' => [
            'index' => 'admin.users.index',
            'create' => 'admin.users.create',
            'store' => 'admin.users.store',
            'show' => 'admin.users.show',
            'edit' => 'admin.users.edit',
            'update' => 'admin.users.update',
            'destroy' => 'admin.users.destroy',
        ]
    ]);
    
    // Additional user management routes
    Route::post('/admin/users/{user}/toggle-verification', [App\Http\Controllers\AdminUserController::class, 'toggleVerification'])
        ->name('admin.users.toggle-verification');
    Route::post('/admin/users/bulk-action', [App\Http\Controllers\AdminUserController::class, 'bulkAction'])
        ->name('admin.users.bulk-action');
    
    // Teacher Management Routes
    Route::resource('admin/teachers', App\Http\Controllers\AdminTeacherController::class, [
        'names' => [
            'index' => 'admin.teachers.index',
            'create' => 'admin.teachers.create',
            'store' => 'admin.teachers.store',
            'show' => 'admin.teachers.show',
            'edit' => 'admin.teachers.edit',
            'update' => 'admin.teachers.update',
            'destroy' => 'admin.teachers.destroy',
        ]
    ]);
    
    // Additional teacher management routes
    Route::post('/admin/teachers/{teacher}/toggle-verification', [App\Http\Controllers\AdminTeacherController::class, 'toggleVerification'])
        ->name('admin.teachers.toggle-verification');
    Route::post('/admin/teachers/bulk-action', [App\Http\Controllers\AdminTeacherController::class, 'bulkAction'])
        ->name('admin.teachers.bulk-action');
    Route::post('/admin/teachers/{teacher}/resend-welcome-email', [App\Http\Controllers\AdminTeacherController::class, 'resendWelcomeEmail'])
        ->name('admin.teachers.resend-welcome-email');
});

Route::middleware(['auth', 'verified', 'role:manager'])->group(function () {
    Route::get('/manager/dashboard', [App\Http\Controllers\ManagerDashboardController::class, 'index'])
        ->name('manager.dashboard');
    
    // School Session Management Routes
    Route::resource('manager/school-sessions', App\Http\Controllers\ManagerSchoolSessionController::class, [
        'names' => [
            'index' => 'manager.school-sessions.index',
            'create' => 'manager.school-sessions.create',
            'store' => 'manager.school-sessions.store',
            'show' => 'manager.school-sessions.show',
            'edit' => 'manager.school-sessions.edit',
            'update' => 'manager.school-sessions.update',
            'destroy' => 'manager.school-sessions.destroy',
        ]
    ]);
    
    // Additional school session routes
    Route::post('/manager/school-sessions/{schoolSession}/toggle-status', [App\Http\Controllers\ManagerSchoolSessionController::class, 'toggleStatus'])
        ->name('manager.school-sessions.toggle-status');
    
    // Teacher Management Routes
    Route::resource('manager/teachers', App\Http\Controllers\ManagerTeacherController::class, [
        'names' => [
            'index' => 'manager.teachers.index',
            'create' => 'manager.teachers.create',
            'store' => 'manager.teachers.store',
            'show' => 'manager.teachers.show',
            'edit' => 'manager.teachers.edit',
            'update' => 'manager.teachers.update',
            'destroy' => 'manager.teachers.destroy',
        ]
    ]);
    
    // Additional teacher management routes
    Route::post('/manager/teachers/{teacher}/toggle-verification', [App\Http\Controllers\ManagerTeacherController::class, 'toggleVerification'])
        ->name('manager.teachers.toggle-verification');
    Route::post('/manager/teachers/bulk-action', [App\Http\Controllers\ManagerTeacherController::class, 'bulkAction'])
        ->name('manager.teachers.bulk-action');
    Route::post('/manager/teachers/{teacher}/resend-welcome-email', [App\Http\Controllers\ManagerTeacherController::class, 'resendWelcomeEmail'])
        ->name('manager.teachers.resend-welcome-email');
    
    // Classroom Management Routes
    Route::resource('manager/classrooms', App\Http\Controllers\ManagerClassroomController::class, [
        'names' => [
            'index' => 'manager.classrooms.index',
            'create' => 'manager.classrooms.create',
            'store' => 'manager.classrooms.store',
            'show' => 'manager.classrooms.show',
            'edit' => 'manager.classrooms.edit',
            'update' => 'manager.classrooms.update',
            'destroy' => 'manager.classrooms.destroy',
        ]
    ]);
    
    // Additional classroom management routes
    Route::post('/manager/classrooms/{classroom}/assign-teacher', [App\Http\Controllers\ManagerClassroomController::class, 'assignTeacher'])
        ->name('manager.classrooms.assign-teacher');
    
    // Term Management Routes
    Route::resource('manager/terms', App\Http\Controllers\ManagerTermController::class, [
        'names' => [
            'index' => 'manager.terms.index',
            'create' => 'manager.terms.create',
            'store' => 'manager.terms.store',
            'show' => 'manager.terms.show',
            'edit' => 'manager.terms.edit',
            'update' => 'manager.terms.update',
            'destroy' => 'manager.terms.destroy',
        ]
    ]);
    
    // Subject Management Routes
    Route::resource('manager/subjects', App\Http\Controllers\ManagerSubjectController::class, [
        'names' => [
            'index' => 'manager.subjects.index',
            'create' => 'manager.subjects.create',
            'store' => 'manager.subjects.store',
            'show' => 'manager.subjects.show',
            'edit' => 'manager.subjects.edit',
            'update' => 'manager.subjects.update',
            'destroy' => 'manager.subjects.destroy',
        ]
    ]);
});

Route::middleware(['auth', 'verified', 'role:teacher'])->group(function () {
    Route::get('/teacher/dashboard', [App\Http\Controllers\TeacherDashboardController::class, 'index'])
        ->name('teacher.dashboard');
});

Route::middleware(['auth', 'verified', 'role:guardian'])->group(function () {
    Route::get('/guardian/dashboard', [App\Http\Controllers\GuardianDashboardController::class, 'index'])
        ->name('guardian.dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
