<x-app-layout>
    <x-slot name="header">
        <h2>Project Roles</h2>
    </x-slot>

    <style>
        .page-wrap { padding: 24px; background: #f3f4f6; min-height: 100vh; }
        .card { background: white; padding: 24px; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.12); margin-top: 16px; }
        .btn { color: white; font-weight: bold; padding: 8px 14px; border-radius: 8px; border: none; cursor: pointer; text-decoration: none; display: inline-block; }
        .btn-blue { background: #1d4ed8; }
        .btn-green { background: #15803d; }
        .btn-red { background: #b91c1c; }
        table { width: 100%; border-collapse: collapse; }
        th { background: #e5e7eb; color: #111827; text-align: left; padding: 12px; }
        td { padding: 12px; border-top: 1px solid #d1d5db; color: #111827; }
        .status-full { background: #fecaca; color: #991b1b; padding: 5px 10px; border-radius: 999px; font-weight: bold; }
        .status-open { background: #bbf7d0; color: #166534; padding: 5px 10px; border-radius: 999px; font-weight: bold; }
    </style>

    <div class="page-wrap">

        @if(session('success'))
            <div style="background:#dcfce7; color:#166534; padding:12px; border-radius:8px; margin-bottom:12px;">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div style="background:#fee2e2; color:#991b1b; padding:12px; border-radius:8px; margin-bottom:12px;">
                {{ session('error') }}
            </div>
        @endif

        <a href="{{ route('projectroles.create') }}" class="btn btn-blue">
            Add Project Role
        </a>

        <div class="card">
            <table>
                <thead>
                    <tr>
                        <th>Project</th>
                        <th>Role</th>
                        <th>Slots</th>
                        <th>Apply</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($projectRoles as $pr)
                        @php
                            $accepted = $pr->applications->where('status', 'accepted')->count();
                            $remaining = $pr->slots - $accepted;
                        @endphp

                        <tr>
                            <td>{{ $pr->project->title }}</td>
                            <td>{{ $pr->role->role_name }}</td>

                            <td>
                                @if($remaining > 0)
                                    <span class="status-open">
                                        {{ $remaining }} / {{ $pr->slots }} left
                                    </span>
                                @else
                                    <span class="status-full">
                                        Full
                                    </span>
                                @endif
                            </td>

                            <td>
                                @if($remaining > 0)
                                    <form method="POST" action="{{ route('applications.store') }}">
                                        @csrf
                                        <input type="hidden" name="project_role_id" value="{{ $pr->id }}">

                                        <button class="btn btn-green">
                                            Apply
                                        </button>
                                    </form>
                                @else
                                    <span class="status-full">Closed</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</x-app-layout>