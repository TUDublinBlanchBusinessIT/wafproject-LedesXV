<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('user')->get();
        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable'
        ]);

        Project::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => auth()->id()
        ]);

        return redirect()->route('projects.index')
            ->with('success', 'Project created');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $project = Project::findOrFail($id);
        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable'
        ]);

        $project = Project::findOrFail($id);

        $project->update([
            'title' => $request->title,
            'description' => $request->description
        ]);

        return redirect()->route('projects.index')
            ->with('success', 'Project updated');
    }

    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();

        return redirect()->route('projects.index')
            ->with('success', 'Project deleted');
    }
}