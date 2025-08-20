<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    // Admin: list + create form page
    public function index()
    {
        $projects = Project::with(['tasks.employee'])->orderByDesc('id')->get();
        return view('projects.index', compact('projects'));
    }

    // Admin: create
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required','string','max:255'],
            'description' => ['nullable','string']
        ]);

        Project::create([
            'name' => $request->name,
            'description' => $request->description,
            'created_by' => Auth::id(),
        ]);

        return back()->with('success','Project created');
    }
    
}
