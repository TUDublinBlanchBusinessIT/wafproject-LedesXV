<x-app-layout>
    <x-slot name="header">
        <h2>Edit Project Role</h2>
    </x-slot>

    <style>
        .page-wrap { padding: 24px; background: #f3f4f6; min-height: 100vh; }
        .card { background: white; padding: 24px; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.12); max-width: 700px; }
        label { font-weight: bold; display: block; margin-bottom: 6px; color: #111827; }
        select, input { width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 8px; margin-bottom: 16px; color: #111827; }
        .btn { color: white; font-weight: bold; padding: 10px 16px; border-radius: 8px; border: none; cursor: pointer; text-decoration: none; display: inline-block; margin-right: 6px; }
        .btn-blue { background: #1d4ed8; }
        .btn-gray { background: #4b5563; }
        .hint { color: #6b7280; margin-bottom: 18px; }
    </style>

    <div class="page-wrap">
        <div class="card">

            <p class="hint">
                Update the project, role, or number of available slots.
            </p>

            <form method="POST" action="{{ route('projectroles.update', $projectRole->id) }}">
                @csrf
                @method('PUT')

                <label>Project</label>
                <select name="project_id">
                    @foreach($projects as $project)
                        <option value="{{ $project->id }}"
                            @if($projectRole->project_id == $project->id) selected @endif>
                            {{ $project->title }}
                        </option>
                    @endforeach
                </select>

                <label>Role</label>
                <select name="role_id">
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}"
                            @if($projectRole->role_id == $role->id) selected @endif>
                            {{ $role->role_name }}
                        </option>
                    @endforeach
                </select>

                <label>Slots</label>
                <input type="number" name="slots" value="{{ $projectRole->slots }}" min="1">

                <button class="btn btn-blue">
                    Update Project Role
                </button>

                <a href="{{ route('projectroles.index') }}" class="btn btn-gray">
                    Cancel
                </a>
            </form>

        </div>
    </div>
</x-app-layout>