<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Create Project</h2>
    </x-slot>

    <div class="p-6">

        <form method="POST" action="{{ route('projects.store') }}">
            @csrf

            <div class="mb-4">
                <label>Title</label>
                <input type="text" name="title" class="border w-full p-2">
            </div>

            <div class="mb-4">
                <label>Description</label>
                <textarea name="description" class="border w-full p-2"></textarea>
            </div>

            <button class="bg-green-500 text-white px-4 py-2 rounded">
                Save
            </button>

        </form>

    </div>
</x-app-layout>