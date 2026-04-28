<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Project Roles</h2>
    </x-slot>

    <div class="p-6">

        @if(session('success'))
            <div class="bg-green-200 p-2 mb-2">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="bg-red-200 p-2 mb-2">{{ session('error') }}</div>
        @endif

        <a href="{{ route('projectroles.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">
            Add Project Role
        </a>

        <table class="mt-4 w-full border">
            <thead>
                <tr>
                    <th class="p-2">Project</th>
                    <th class="p-2">Role</th>
                    <th class="p-2">Slots</th>
                    <th class="p-2">Apply</th>
                </tr>
            </thead>

            <tbody>
                @foreach($projectRoles as $pr)
                    <tr>
                        <td class="p-2">{{ $pr->project->title }}</td>
                        <td class="p-2">{{ $pr->role->role_name }}</td>
                        <td class="p-2">{{ $pr->slots }}</td>

                        <td class="p-2">
                            <form method="POST" action="{{ route('applications.store') }}">
                                @csrf
                                <input type="hidden" name="project_role_id" value="{{ $pr->id }}">

                                <button class="bg-green-500 text-white px-2 py-1 rounded">
                                    Apply
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</x-app-layout>