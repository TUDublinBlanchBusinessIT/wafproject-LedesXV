<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Add Project Role</h2>
    </x-slot>

    <div class="p-6">

        <form method="POST" action="{{ route('projectroles.store') }}">
            @csrf

            <div class="mb-4">
                <label>Project</label>
                <select name="project_id" class="border w-full p-2">
                    @foreach($projects as $project)
                        <option value="{{ $project->id }}">
                            {{ $project->title }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label>Role</label>
                <select name="role_id" class="border w-full p-2">
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}">
                            {{ $role->role_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label>Slots</label>
                <input type="number" name="slots" class="border w-full p-2">
            </div>

            <button class="bg-green-500 text-white px-4 py-2 rounded">
                Save
            </button>

        </form>

    </div>
</x-app-layout>