<x-app-layout>
    <x-slot name="header">
        <h2>Roles</h2>
    </x-slot>

    <style>
        .page-wrap { padding: 24px; background: #f3f4f6; min-height: 100vh; }
        .card { background: white; padding: 24px; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.12); margin-top: 16px; }
        .btn { color: white; font-weight: bold; padding: 8px 14px; border-radius: 8px; border: none; cursor: pointer; text-decoration: none; display: inline-block; margin-right: 6px; }
        .btn-blue { background: #1d4ed8; }
        .btn-yellow { background: #eab308; color: #111; }
        .btn-red { background: #b91c1c; }
        table { width: 100%; border-collapse: collapse; }
        th { background: #e5e7eb; color: #111827; text-align: left; padding: 12px; }
        td { padding: 12px; border-top: 1px solid #d1d5db; color: #111827; }
    </style>

    <div class="page-wrap">

        <a href="{{ route('roles.create') }}" class="btn btn-blue">
            Add Role
        </a>

        <div class="card">
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($roles as $role)
                        <tr>
                            <td>{{ $role->role_name }}</td>
                            <td>{{ $role->description }}</td>

                            <td>
                                <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-yellow">
                                    Edit
                                </a>

                                <form action="{{ route('roles.destroy', $role->id) }}"
                                      method="POST"
                                      style="display:inline;">
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-red">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</x-app-layout>