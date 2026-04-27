<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Edit Project</h2>
    </x-slot>

    <div class="p-6">

        <form method="POST" action="{{ route('projects.update', $project->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label>Title</label>
                <input type="text" name="title"
                       value="{{ $project->title }}"
                       class="border w-full p-2">
            </div>

            <div class="mb-4">
                <label>Description</label>
                <textarea name="description"
                          class="border w-full p-2">{{ $project->description }}</textarea>
            </div>

            <button class="bg-blue-500 text-white px-4 py-2 rounded">
                Update
            </button>

        </form>

    </div>
</x-app-layout>