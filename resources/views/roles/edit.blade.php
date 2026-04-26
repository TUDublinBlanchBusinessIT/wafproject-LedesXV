<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Edit Role</h2>
    </x-slot>

    <div class="p-6">

        <form method="POST" action="{{ route('roles.update', $role->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label>Role Name</label>
                <input type="text" name="role_name"
                       value="{{ $role->role_name }}"
                       class="border w-full p-2">
            </div>

            <div class="mb-4">
                <label>Description</label>
                <textarea name="description"
                          class="border w-full p-2">{{ $role->description }}</textarea>
            </div>

            <button class="bg-blue-500 text-white px-4 py-2 rounded">
                Update
            </button>

        </form>

    </div>
</x-app-layout>
