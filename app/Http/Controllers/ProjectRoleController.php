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
        $projects = \App\Models\Project::all();
        $roles = \App\Models\Role::all();

        return view('projectroles.create', compact('projects', 'roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'project_id' => 'required',
            'role_id' => 'required',
            'slots' => 'required|integer|min:1'
        ]);

        \App\Models\ProjectRole::create([
            'project_id' => $request->project_id,
            'role_id' => $request->role_id,
            'slots' => $request->slots
        ]);

        return redirect()->route('projectroles.index')
            ->with('success', 'Project role created');
    }
}