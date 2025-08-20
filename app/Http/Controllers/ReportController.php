<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Task;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function employeeReport()
    {
        $q = Task::where('assigned_to', Auth::id());

        $stats = [
            'total'        => (clone $q)->count(),
            'approved'     => (clone $q)->where('status','approved')->count(),
            'under_review' => (clone $q)->where('status','under_review')->count(),
            'in_progress'  => (clone $q)->where('status','in_progress')->count(),
            'pending'      => (clone $q)->where('status','pending')->count(),
            'rejected'     => (clone $q)->where('status','rejected')->count(),
        ];

        $recent = (clone $q)->latest()->limit(10)->get();

        return view('report.employee', compact('stats','recent'));
    }

    public function adminReport()
    {
        $users = User::where('role','employee')->withCount([
            'assignedTasks',
            'assignedTasks as approved_count'     => fn($q)=>$q->where('status','approved'),
            'assignedTasks as under_review_count' => fn($q)=>$q->where('status','under_review'),
            'assignedTasks as in_progress_count'  => fn($q)=>$q->where('status','in_progress'),
            'assignedTasks as pending_count'      => fn($q)=>$q->where('status','pending'),
            'assignedTasks as rejected_count'     => fn($q)=>$q->where('status','rejected'),
        ])->get();

        $projects = Project::withCount('tasks')->get();

        return view('report.admin', compact('users','projects'));
    }
}
