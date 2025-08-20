<?php

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



Route::middleware('auth')->group(function () {

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
