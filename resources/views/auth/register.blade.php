<x-layout>
    {{-- Title --}}
    <h1 class="title">Register New Account</h1>

    {{-- Register Form --}}
    <div class="mx-auto max-w-screen-sm card">
        <form action="" method="POST">
            {{-- Username --}}
            <div class="mb-4">
                <label for="username">Username</label>
                <input type="text" name="username" class="input">
            </div>

            {{-- Email --}}
            <div class="mb-4">
                <label for="email">Email</label>
                <input type="email" name="email" class="input">
            </div>

            {{-- Password --}}
            <div class="mb-4">
                <label for="password">Password</label>
                <input type="password" name="password" class="input">
            </div>

            {{-- Confirm Password --}}
            <div class="mb-8">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" name="password_confirmation" class="input">
            </div>

            {{-- Submit Button --}}
            <button class="btn">Register</button>
        </form>
    </div>
</x-layout>