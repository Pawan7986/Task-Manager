<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class TaskController extends Controller
{   
   // Admin: Show all tasks + create form
public function index(Request $request)
{
    $status = $request->query('status');

    $tasks = $status
        ? Task::where('status', $status)->get()
        : Task::all();

    $totalTasks = Task::count();
    $completedTasks = Task::where('status','approved')->count();
    $pendingTasks = Task::where('status','pending')->count();
    $underReviewTasks = Task::where('status','under_review')->count();
    $totalProjects = Project::count();

    return view('admin.dashboard', compact(
        'tasks', 'totalTasks', 'completedTasks', 'pendingTasks', 'underReviewTasks', 'totalProjects'
    ));
}


 
public function indexByStatus($status)
    {
        $tasks = Task::where('status', $status)->get();
        $projects = Project::all();
        $users = User::where('role','employee')->get();
        $totalTasks = $tasks->count();

        return view('admin.tasks', compact('tasks','projects','users','totalTasks'));
    }

public function create()
{
    $projects = Project::all();
    $users = User::where('role','employee')->get();
    return view('admin.create_task', compact('projects','users'));
}

// Admin: Store new task
public function store(Request $request)
{
    $request->validate([
        'project_id'  => ['required','exists:projects,id'],
        'assigned_to' => ['required','exists:users,id'],
        'title'       => ['required','string','max:255'],
        'description' => ['nullable','string'],
        'due_date'    => ['nullable','date'],
    ]);

    Task::create([
        'project_id'  => $request->project_id,
        'assigned_to' => $request->assigned_to,
        'title'       => $request->title,
        'description' => $request->description,
        'due_date'    => $request->due_date,
        'status'      => 'pending',
    ]);

    return back()->with('success','Task assigned successfully!');
}


    // Employee: my tasks
    
  public function myTasks(Request $request)
{
    $user = Auth::user();
    $status = $request->query('status');

    $assignedTasks = Task::with('project')
        ->where('assigned_to', $user->id)
        ->when($status, fn($query) => $query->where('status', $status))
        ->latest()
        ->get();

    // Count tasks by status
    $totalTasks = Task::where('assigned_to', $user->id)->count();
    $completedTasks = Task::where('assigned_to', $user->id)->where('status','approved')->count();
    $pendingTasks = Task::where('assigned_to', $user->id)->where('status','pending')->count();
    $underReviewTasks = Task::where('assigned_to', $user->id)->where('status','under_review')->count();
    $rejectedTasks = Task::where('assigned_to', $user->id)->where('status','rejected')->count();

    return view('user.tasks', compact(
        'assignedTasks', 'totalTasks', 'completedTasks', 'pendingTasks', 'underReviewTasks', 'rejectedTasks'
    ));
}

   public function show(Task $task)
{
    // Ensure the logged-in employee owns the task
    if ($task->assigned_to != auth()->id()) {
        abort(403, 'Unauthorized action.');
    }

    return view('employee.task-show', compact('task'));
}



    // Employee: start
    public function start(Task $task)
    {
        if ($task->assigned_to !== Auth::id()) abort(403);
        if ($task->status !== 'pending') return back()->with('error','Not in pending state');

        $task->update(['status' => 'in_progress']);
        return back()->with('success','Task started');
    }

    // Employee: complete -> under review
    public function complete(Request $request, Task $task)
    {
        if ($task->assigned_to !== Auth::id()) abort(403);
        if (!in_array($task->status, ['pending','in_progress'], true))
            return back()->with('error','Cannot complete from current state');

        $task->update([
            'status'  => 'under_review',
            'remarks' => $request->remarks,
        ]);

        return back()->with('success','Submitted for review');
    }

    // Admin: review approve/reject
    public function review(Request $request, Task $task)
    {
        $request->validate([
            'decision' => ['required','in:approved,rejected'],
            'remarks'  => ['nullable','string']
        ]);

        if ($task->status !== 'under_review')
            return back()->with('error','Task not under review');

        $task->update([
            'status'  => $request->decision,
            'remarks' => $request->remarks ?? $task->remarks,
        ]);

        return back()->with('success','Task reviewed: '.$request->decision);
    }
      
       public function show2($id)
    {
        $task = \App\Models\Task::findOrFail($id);

        // Return a view with the task details
        return view('projects.show', compact('task'));
    }

     public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->back()->with('success', 'Task deleted successfully!');
    }
}
