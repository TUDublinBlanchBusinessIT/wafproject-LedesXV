<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projectRoles = \App\Models\ProjectRole::with(['project', 'role'])->get();

        return view('projectroles.index', compact('projectRoles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable'
        ]);

        \App\Models\Project::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => auth()->id()
        ]);

        return redirect()->route('projects.index')
            ->with('success', 'Project created');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $project = \App\Models\Project::findOrFail($id);
        return view('projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable'
        ]);

        $project = \App\Models\Project::findOrFail($id);

        $project->update([
            'title' => $request->title,
            'description' => $request->description
        ]);

        return redirect()->route('projects.index')
            ->with('success', 'Project updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $project = \App\Models\Project::findOrFail($id);
        $project->delete();

        return redirect()->route('projects.index')
            ->with('success', 'Project deleted');
    }
}
