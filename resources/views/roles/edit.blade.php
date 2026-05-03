<x-app-layout>
    <x-slot name="header">
        <h2>Edit Role</h2>
    </x-slot>

    <style>
        .page-wrap { padding: 24px; background: #f3f4f6; min-height: 100vh; }
        .card { background: white; padding: 24px; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.12); max-width: 700px; }
        label { font-weight: bold; display: block; margin-bottom: 6px; color: #111827; }
        input, textarea { width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 8px; margin-bottom: 16px; color: #111827; }
        textarea { min-height: 120px; }
        .btn { color: white; font-weight: bold; padding: 10px 16px; border-radius: 8px; border: none; cursor: pointer; text-decoration: none; display: inline-block; margin-right: 6px; }
        .btn-blue { background: #1d4ed8; }
        .btn-gray { background: #4b5563; }
        .hint { color: #6b7280; margin-bottom: 18px; }
    </style>

    <div class="page-wrap">
        <div class="card">

            <p class="hint">
                Update the role name or description.
            </p>

            <form method="POST" action="{{ route('roles.update', $role->id) }}">
                @csrf
                @method('PUT')

                <label>Role Name</label>
                <input type="text" name="role_name" value="{{ $role->role_name }}">

                <label>Description</label>
                <textarea name="description">{{ $role->description }}</textarea>

                <button class="btn btn-blue">
                    Update Role
                </button>

                <a href="{{ route('roles.index') }}" class="btn btn-gray">
                    Cancel
                </a>
            </form>

        </div>
    </div>
</x-app-layout>