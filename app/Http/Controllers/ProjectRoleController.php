<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectRoleController extends Controller
{
    public function index()
    {
        $projectRoles = \App\Models\ProjectRole::with(['project', 'role', 'applications'])->get();

        return view('projectroles.index', compact('projectRoles'));
    }

    public function create()
    {
        $projects = \App\Models\Project::where('user_id', auth()->id())->get();
        $roles = \App\Models\Role::all();

        return view('projectroles.create', compact('projects', 'roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'role_id' => 'required|exists:roles,id',
            'slots' => 'required|integer|min:1'
        ]);

        $project = \App\Models\Project::findOrFail($request->project_id);

        if ($project->user_id !== auth()->id()) {
            abort(403);
        }

        \App\Models\ProjectRole::create([
            'project_id' => $request->project_id,
            'role_id' => $request->role_id,
            'slots' => $request->slots
        ]);

        return redirect()->route('projectroles.index')
            ->with('success', 'Project role created');
    }

    public function edit($id)
    {
        $projectRole = \App\Models\ProjectRole::with('project')->findOrFail($id);

        if ($projectRole->project->user_id !== auth()->id()) {
            abort(403);
        }

        $projects = \App\Models\Project::where('user_id', auth()->id())->get();
        $roles = \App\Models\Role::all();

        return view('projectroles.edit', compact('projectRole', 'projects', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'role_id' => 'required|exists:roles,id',
            'slots' => 'required|integer|min:1'
        ]);

        $projectRole = \App\Models\ProjectRole::with('project')->findOrFail($id);

        if ($projectRole->project->user_id !== auth()->id()) {
            abort(403);
        }

        $newProject = \App\Models\Project::findOrFail($request->project_id);

        if ($newProject->user_id !== auth()->id()) {
            abort(403);
        }

        $projectRole->update([
            'project_id' => $request->project_id,
            'role_id' => $request->role_id,
            'slots' => $request->slots
        ]);

        return redirect()->route('projectroles.index')
            ->with('success', 'Project role updated');
    }
    public function destroy($id)
    {
        $projectRole = \App\Models\ProjectRole::with('project')->findOrFail($id);

        if ($projectRole->project->user_id !== auth()->id()) {
            abort(403);
        }

        $projectRole->delete();

        return redirect()->route('projectroles.index')
            ->with('success', 'Project role deleted');
    }
}