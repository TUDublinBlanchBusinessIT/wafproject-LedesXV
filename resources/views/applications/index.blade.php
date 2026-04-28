<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Applications</h2>
    </x-slot>

    <div class="p-6">

        <a href="{{ route('applications.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">
            New Application
        </a>

        <table class="mt-4 w-full border">
            <thead>
                <tr>
                    <th class="p-2">Applicant</th>
                    <th class="p-2">Project</th>
                    <th class="p-2">Role</th>
                    <th class="p-2">Status</th>
                    <th class="p-2">Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach($applications as $application)
                    <tr>
                        <td class="p-2">{{ $application->user->name }}</td>
                        <td class="p-2">{{ $application->projectRole->project->title }}</td>
                        <td class="p-2">{{ $application->projectRole->role->role_name }}</td>
                        <td class="p-2">{{ ucfirst($application->status) }}</td>
                        <td class="p-2">
                            <form method="POST" action="{{ route('applications.destroy', $application->id) }}">
                                @csrf
                                @method('DELETE')

                                <button class="bg-red-500 text-white px-2 py-1 rounded">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</x-app-layout>