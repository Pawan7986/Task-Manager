<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;

class DashboardController extends Controller
{
    // Admin Dashboard
  public function adminDashboard()
{
    $totalProjects = Project::count();
    $totalTasks = Task::count();
    $completedTasks = Task::where('status','approved')->count();
    $pendingTasks = Task::where('status','pending')->count();
    $underReviewTasks = Task::where('status','under_review')->count(); // add this
    $totalEmployees = User::where('role','employee')->count();

    $tasks = Task::with(['project','employee'])->latest()->take(5)->get(); // recent tasks

    return view('admin.dashboard', compact(
        'totalProjects',
        'totalTasks',
        'completedTasks',
        'pendingTasks',
        'underReviewTasks', // make sure this is passed to view
        'totalEmployees',
        'tasks'
    ));
}



    // Employee Dashboard
   // DashboardController.php
public function employeeDashboard()
{
    $user = auth()->user();

    // Employee ke tasks
    $assignedTasks = Task::with('project')
        ->where('assigned_to', $user->id)
        ->latest()
        ->get();

    // Count of tasks by status
    $totalTasks = $assignedTasks->count();
    $completedTasks = $assignedTasks->where('status', 'approved')->count();
    $pendingTasks = $assignedTasks->where('status', 'pending')->count();
    $underReviewTasks = $assignedTasks->where('status', 'under_review')->count();
    $rejectedTasks = $assignedTasks->where('status', 'rejected')->count(); // new

    return view('employee.dashboard', compact(
        'assignedTasks',
        'totalTasks',
        'completedTasks',
        'pendingTasks',
        'underReviewTasks',
        'rejectedTasks' // new
    ));
}


}
