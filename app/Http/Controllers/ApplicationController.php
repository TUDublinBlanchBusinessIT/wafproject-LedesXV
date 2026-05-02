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

        $projectRole = ProjectRole::findOrFail($request->project_role_id);

        $acceptedCount = Application::where('project_role_id', $projectRole->id)
            ->where('status', 'accepted')
            ->count();

        if ($acceptedCount >= $projectRole->slots) {
            return redirect()->back()->with('error', 'No slots available for this role');
        }

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
        $application = Application::with('projectRole.project')->findOrFail($id);

        if ($application->projectRole->project->user_id !== auth()->id()) {
            abort(403);
        }

        $application->delete();

        return redirect()->route('applications.index')
            ->with('success', 'Application deleted');
    }

    public function accept($id)
    {
        $application = Application::with('projectRole.project')->findOrFail($id);

        if ($application->projectRole->project->user_id !== auth()->id()) {
            abort(403);
        }

        $application->status = 'accepted';
        $application->save();

        return redirect()->back()->with('success', 'Application accepted');
    }

    public function reject($id)
    {
        $application = Application::with('projectRole.project')->findOrFail($id);

        if ($application->projectRole->project->user_id !== auth()->id()) {
            abort(403);
        }

        $application->status = 'rejected';
        $application->save();

        return redirect()->back()->with('success', 'Application rejected');
    }
}