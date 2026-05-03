<x-app-layout>
    <x-slot name="header">
        <h2>Apply for Project Role</h2>
    </x-slot>

    <style>
        .page-wrap { padding: 24px; background: #f3f4f6; min-height: 100vh; }
        .card { background: white; padding: 24px; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.12); max-width: 700px; }
        label { font-weight: bold; display: block; margin-bottom: 6px; color: #111827; }
        select { width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 8px; margin-bottom: 16px; color: #111827; }
        .btn { color: white; font-weight: bold; padding: 10px 16px; border-radius: 8px; border: none; cursor: pointer; text-decoration: none; display: inline-block; margin-right: 6px; }
        .btn-green { background: #15803d; }
        .btn-gray { background: #4b5563; }
        .hint { color: #6b7280; margin-bottom: 18px; }
    </style>

    <div class="page-wrap">

        <div class="card">
            <p class="hint">
                Select a project role and submit your application.
            </p>

            <form method="POST" action="{{ route('applications.store') }}">
                @csrf

                <label>Project Role</label>
                <select name="project_role_id">
                    @foreach($projectRoles as $projectRole)
                        <option value="{{ $projectRole->id }}">
                            {{ $projectRole->project->title }} - {{ $projectRole->role->role_name }}
                        </option>
                    @endforeach
                </select>

                <button class="btn btn-green">
                    Submit Application
                </button>

                <a href="{{ route('applications.index') }}" class="btn btn-gray">
                    Cancel
                </a>
            </form>
        </div>

    </div>
</x-app-layout>