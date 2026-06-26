<x-layout>
    <a href="{{ route('admin.users.index') }}" class="block mb-12 text-xs text-blue-500">&larr; Go back to your dashboard</a>

    <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow border border-gray-300">
        <h1 class="text-2xl font-bold mb-6 border-b pb-2">Edit User</h1>

        <form method="POST" action="{{ route('admin.users.update', $user) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-5">
                <label for="username" class="block mb-1 font-semibold text-gray-700">Username</label>
                <input type="text" id="username" name="username" value="{{ old('username', $user->username) }}"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <div class="mb-5">
                <label for="email" class="block mb-1 font-semibold text-gray-700">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <div class="mb-6">
                <label for="role" class="block mb-1 font-semibold text-gray-700">Role</label>
                <select id="role" name="role"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                    <option value="user" @selected($user->role == 'user')>User</option>
                    <option value="admin" @selected($user->role == 'admin')>Admin</option>
                </select>
            </div>

            {{-- Avatar upload --}}
            <div class="mb-5">
                <label for="avatar" class="block mb-1 font-semibold text-gray-700">Avatar</label>
                <input type="file" name="avatar" class="w-full border border-gray-300 rounded px-3 py-2">
                @if ($user->avatar)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" class="h-16 rounded-full">
                    </div>
                @endif
            </div>

            <button type="submit"
                class="bg-blue-600 text-white font-semibold px-6 py-2 rounded hover:bg-blue-700 transition">
                Save
            </button>
        </form>
    </div>
</x-layout>
