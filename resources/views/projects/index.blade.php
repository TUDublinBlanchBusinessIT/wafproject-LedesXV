<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Projects</h2>
    </x-slot>

    <div class="p-6">

        @if(session('success'))
            <div class="bg-green-200 p-2 mb-2">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('projects.create') }}"
           class="bg-blue-500 text-white px-4 py-2 rounded">
            Add Project
        </a>

        <table class="mt-4 w-full border">
            <thead>
                <tr>
                    <th class="p-2">Title</th>
                    <th class="p-2">Description</th>
                    <th class="p-2">Owner</th>
                    <th class="p-2">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($projects as $project)
                    <tr>
                        <td class="p-2">{{ $project->title }}</td>
                        <td class="p-2">{{ $project->description }}</td>
                        <td class="p-2">{{ $project->user->name }}</td>

                        <td class="p-2">
                            <a href="{{ route('projects.edit', $project->id) }}"
                               class="bg-yellow-500 text-white px-2 py-1 rounded">
                                Edit
                            </a>

                            <form action="{{ route('projects.destroy', $project->id) }}"
                                  method="POST"
                                  style="display:inline;">
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