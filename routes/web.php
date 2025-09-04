<?php

use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;



// 1. Verify Notice Page (jab user register hote hi redirect hoga yaha)
Route::get('/email/verify', function () {
    return view('auth.verify-email'); // is view me "Please verify your email" message hoga
})->middleware('auth')->name('verification.notice');

// 2. Verify Callback (jab user email ke link par click karega)
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill(); // email verified mark ho jayega

    return redirect('/dashboard'); // successfully verified hone ke baad
})->middleware(['auth', 'signed'])->name('verification.verify');

// 3. Resend Verification Link (agar user phirse link bhejna chahe)
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('status', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


Route::middleware('auth','verified')->group(function () {

    // Dashboard
    Route::get('/dashboard', function() {
        return auth()->user()->role == 'admin'
            ? redirect()->route('admin.dashboard')
            : redirect()->route('employee.dashboard');
    })->name('dashboard');

    Route::get('/admin/dashboard', [DashboardController::class, 'adminDashboard'])
        ->name('admin.dashboard')->middleware('role:admin');

    Route::get('/employee/dashboard', [DashboardController::class, 'employeeDashboard'])
        ->name('employee.dashboard')->middleware('role:employee');

    // Admin-only routes
    Route::middleware('role:admin')->group(function () {
        Route::get('/projects', [ProjectController::class,'index'])->name('projects.index');
        Route::post('/projects', [ProjectController::class,'store'])->name('projects.store');
        Route::get('/tasks/status/{status}', [TaskController::class, 'indexByStatus'])->name('tasks.status');

        Route::get('/tasks', [TaskController::class,'index'])->name('tasks.index');
        Route::get('/tasks/create', [TaskController::class,'create'])->name('tasks.create');
        Route::post('/tasks', [TaskController::class,'store'])->name('tasks.store');

        Route::post('/tasks/{task}/review', [TaskController::class,'review'])->name('tasks.review');

        Route::get('/admin/reports', [ReportController::class,'adminReport'])->name('admin.report');
        Route::delete('tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
        Route::get('tasks/{id}', [App\Http\Controllers\TaskController::class, 'show2'])->name('tasks.show2');

         Route::get('/admin/users', [AuthController::class, 'index'])->name('admin.users.index');
    Route::post('/admin/users/{id}/status', [AuthController::class, 'updateStatus'])->name('admin.users.updateStatus');
    Route::get('/admin/users/{id}', [AuthController::class, 'show'])->name('admin.users.show');





    });

    // Employee-only routes
    Route::middleware('role:employee')->group(function () {
        Route::get('/my-tasks', [TaskController::class,'myTasks'])->name('tasks.my');
        Route::post('/tasks/{task}/start', [TaskController::class,'start'])->name('tasks.start');
        Route::post('/tasks/{task}/complete', [TaskController::class,'complete'])->name('tasks.complete');
        Route::get('/employee/tasks/{task}', [TaskController::class,'show'])->name('employee.tasks.show');
        Route::get('/my-report', [ReportController::class,'employeeReport'])->name('employee.report');
    });

});
Route::get('forgot-password', [ForgotPasswordController::class, 'showForgotForm'])->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLink'])->name('password.email');

Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [ResetPasswordController::class, 'resetPassword'])->name('password.update');

// Route::middleware(['auth', 'can:isAdmin'])->group(function () {
//     Route::get('/admin/users', [AuthController::class, 'index'])->name('admin.users.index');
//     Route::post('/admin/users/{id}/status', [AuthController::class, 'updateStatus'])->name('admin.users.updateStatus');
// });

