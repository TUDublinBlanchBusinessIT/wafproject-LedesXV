<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Roles</h2>
    </x-slot>

    <div class="p-6">

        <a href="{{ route('roles.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">
            Add Role
        </a>

    <table class="mt-4 w-full border">
        <thead>
            <tr class="bg-gray-100">
                <th class="p-2">Name</th>
                <th class="p-2">Description</th>
                <th class="p-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($roles as $role)
                <tr>
                    <td class="p-2">{{ $role->role_name }}</td>
                    <td class="p-2">{{ $role->description }}</td>
                    <td class="p-2">

                        <a href="{{ route('roles.edit', $role->id) }}"
                        class="bg-yellow-500 text-white px-2 py-1 rounded">
                            Edit
                        </a>

                        <form action="{{ route('roles.destroy', $role->id) }}"
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