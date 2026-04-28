<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\ProjectRole;

class ApplicationController extends Controller
{
    public function index()
    {
        $applications = Application::with(['user', 'projectRole.project', 'projectRole.role'])->get();

        return view('applications.index', compact('applications'));
    }

    public function create()
    {
        $projectRoles = ProjectRole::with(['project', 'role'])->get();

        return view('applications.create', compact('projectRoles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'project_role_id' => 'required|exists:project_roles,id',
        ]);

        // Prevent duplicate applications
        $exists = Application::where('user_id', auth()->id())
            ->where('project_role_id', $request->project_role_id)
            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'You already applied for this role');
        }

        Application::create([
            'user_id' => auth()->id(),
            'project_role_id' => $request->project_role_id,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Application submitted');
    }

    public function destroy($id)
    {
        $application = Application::findOrFail($id);
        $application->delete();

        return redirect()->route('applications.index')
            ->with('success', 'Application deleted');
    }
}