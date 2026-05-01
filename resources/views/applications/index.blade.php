<x-app-layout>
    <x-slot name="header">
        <h2>Applications</h2>
    </x-slot>

    <style>
        .page-wrap { padding: 24px; background: #f3f4f6; min-height: 100vh; }
        .card { background: white; padding: 24px; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.12); margin-top: 16px; }
        .btn { color: white; font-weight: bold; padding: 8px 14px; border-radius: 8px; border: none; cursor: pointer; text-decoration: none; display: inline-block; margin-right: 6px; }
        .btn-blue { background: #1d4ed8; }
        .btn-green { background: #15803d; }
        .btn-orange { background: #ea580c; }
        .btn-red { background: #b91c1c; }
        table { width: 100%; border-collapse: collapse; }
        th { background: #e5e7eb; color: #111827; text-align: left; padding: 12px; }
        td { padding: 12px; border-top: 1px solid #d1d5db; color: #111827; }
        .status { font-weight: bold; padding: 5px 10px; border-radius: 999px; display: inline-block; }
        .accepted { background: #bbf7d0; color: #166534; }
        .rejected { background: #fecaca; color: #991b1b; }
        .pending { background: #fef3c7; color: #92400e; }
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

        <a href="{{ route('applications.create') }}" class="btn btn-blue">
            New Application
        </a>

        <div class="card">
            <table>
                <thead>
                    <tr>
                        <th>Applicant</th>
                        <th>Project</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($applications as $application)
                        <tr>
                            <td>{{ $application->user->name }}</td>
                            <td>{{ $application->projectRole->project->title }}</td>
                            <td>{{ $application->projectRole->role->role_name }}</td>

                            <td>
                                @if($application->status == 'accepted')
                                    <span class="status accepted">Accepted</span>
                                @elseif($application->status == 'rejected')
                                    <span class="status rejected">Rejected</span>
                                @else
                                    <span class="status pending">Pending</span>
                                @endif
                            </td>

                            <td>
                                <form method="POST" action="{{ route('applications.accept', $application->id) }}" style="display:inline;">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-green">Accept</button>
                                </form>

                                <form method="POST" action="{{ route('applications.reject', $application->id) }}" style="display:inline;">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-orange">Reject</button>
                                </form>

                                <form method="POST" action="{{ route('applications.destroy', $application->id) }}" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-red">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</x-app-layout>