<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Apply for Project Role</h2>
    </x-slot>

    <div class="p-6">

        <form method="POST" action="{{ route('applications.store') }}">
            @csrf

            <div class="mb-4">
                <label>Project Role</label>

                <select name="project_role_id" class="border w-full p-2">
                    @foreach($projectRoles as $projectRole)
                        <option value="{{ $projectRole->id }}">
                            {{ $projectRole->project->title }} - {{ $projectRole->role->role_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button class="bg-green-500 text-white px-4 py-2 rounded">
                Submit Application
            </button>

        </form>

    </div>
</x-app-layout>