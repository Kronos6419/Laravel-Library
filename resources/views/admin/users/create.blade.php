<x-layout>
    <a href="{{ route('admin.users.index') }}" class="text-sm text-blue-500">&larr; Back to users</a>

    <h1 class="title">Add New User</h1>

    <form action="{{ route('admin.users.store') }}" method="POST" class="card max-w-md mx-auto" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label for="username">Username</label>
            <input name="username" class="input" value="{{ old('username') }}">
            @error('username')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="email">Email</label>
            <input name="email" type="email" class="input" value="{{ old('email') }}">
            @error('email')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="password">Password</label>
            <input name="password" type="password" class="input">
            @error('password')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="password_confirmation">Confirm Password</label>
            <input name="password_confirmation" type="password" class="input">
        </div>

        <div class="mb-4">
            <label for="role">Role</label>
            <select name="role" class="input">
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
        </div>

        {{-- Avatar upload --}}
        <div class="mb-4">
            <label for="avatar" class="block mb-1 font-semibold text-gray-700">Avatar</label>
            <input type="file" name="avatar" class="w-full border border-gray-300 rounded px-3 py-2">
        </div>

        <button class="btn">Create User</button>
    </form>
</x-layout>
