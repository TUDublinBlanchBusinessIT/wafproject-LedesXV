<x-app-layout>
    <x-slot name="header">
        <h2>Projects</h2>
    </x-slot>

    <style>
        .page-wrap { padding: 24px; background: #f3f4f6; min-height: 100vh; }
        .card { background: white; padding: 24px; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.12); margin-top: 16px; }
        .btn { color: white; font-weight: bold; padding: 8px 14px; border-radius: 8px; border: none; cursor: pointer; text-decoration: none; display: inline-block; margin-right: 6px; }
        .btn-blue { background: #1d4ed8; }
        .btn-yellow { background: #eab308; color: #111; }
        .btn-red { background: #b91c1c; }
        .owner-only { color: #6b7280; font-weight: bold; }
        table { width: 100%; border-collapse: collapse; }
        th { background: #e5e7eb; color: #111827; text-align: left; padding: 12px; }
        td { padding: 12px; border-top: 1px solid #d1d5db; color: #111827; }
    </style>

    <div class="page-wrap">

        @if(session('success'))
            <div style="background:#dcfce7; color:#166534; padding:12px; border-radius:8px; margin-bottom:12px;">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('projects.create') }}" class="btn btn-blue">
            Add Project
        </a>

        <div class="card">
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Owner</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($projects as $project)
                        <tr>
                            <td>{{ $project->title }}</td>
                            <td>{{ $project->description }}</td>
                            <td>{{ $project->user->name }}</td>

                            <td>
                                @if(auth()->id() === $project->user_id)

                                    <a href="{{ route('projects.edit', $project->id) }}"
                                       class="btn btn-yellow">
                                        Edit
                                    </a>

                                    <form action="{{ route('projects.destroy', $project->id) }}"
                                          method="POST"
                                          style="display:inline;">
                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-red">
                                            Delete
                                        </button>
                                    </form>

                                @else
                                    <span class="owner-only">Owner only</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</x-app-layout>