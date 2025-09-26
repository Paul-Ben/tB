<?php

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

Route::get('/', function () {
    return view('welcome');
});

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
});

Route::middleware(['auth', 'verified', 'role:manager'])->group(function () {
    Route::get('/manager/dashboard', [App\Http\Controllers\ManagerDashboardController::class, 'index'])
        ->name('manager.dashboard');
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
