<x-app-layout>
    <x-slot name="header">
        <h2>Dashboard</h2>
    </x-slot>

    <style>
        .page-wrap { padding: 24px; background: #f3f4f6; min-height: 100vh; }
        .card { background: white; padding: 20px; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.12); transition: 0.2s; }
        .card:hover { transform: translateY(-4px); }
        .title { font-size: 18px; font-weight: bold; margin-bottom: 6px; }
        .desc { color: #6b7280; margin-bottom: 12px; }
        .btn { display: inline-block; padding: 8px 14px; border-radius: 8px; color: white; font-weight: bold; text-decoration: none; }
        .btn-blue { background: #1d4ed8; }
        .btn-green { background: #15803d; }
        .btn-purple { background: #7c3aed; }
        .btn-orange { background: #ea580c; }
    </style>

    <div class="page-wrap">

        <h3 style="font-size:20px; font-weight:bold; margin-bottom:20px;">
            Welcome to CollabForge
        </h3>

        <div style="display:grid; grid-template-columns: repeat(2, 1fr); gap:16px;">

            <!-- Roles -->
            <div class="card">
                <div class="title">Roles</div>
                <div class="desc">Manage all available roles</div>
                <a href="{{ route('roles.index') }}" class="btn btn-blue">
                    View Roles
                </a>
            </div>

            <!-- Projects -->
            <div class="card">
                <div class="title">Projects</div>
                <div class="desc">Create and manage projects</div>
                <a href="{{ route('projects.index') }}" class="btn btn-green">
                    View Projects
                </a>
            </div>

            <!-- Project Roles -->
            <div class="card">
                <div class="title">Project Roles</div>
                <div class="desc">Assign roles to projects</div>
                <a href="{{ route('projectroles.index') }}" class="btn btn-purple">
                    View Project Roles
                </a>
            </div>

            <!-- Applications -->
            <div class="card">
                <div class="title">Applications</div>
                <div class="desc">Review user applications</div>
                <a href="{{ route('applications.index') }}" class="btn btn-orange">
                    View Applications
                </a>
            </div>

        </div>

    </div>
</x-app-layout>