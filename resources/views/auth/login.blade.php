<x-layout>
    {{-- Title --}}
    <h1 class="title">Welcome Back</h1>

    {{-- Register Form --}}
    <div class="mx-auto max-w-screen-sm card">
        <form action="{{route('login')}}" method="POST">

            @csrf

            {{-- Username or Email --}}
            <div class="mb-4">
                <label for="login">Username or Email</label>
                <input type="text" name="login" value="{{old('login')}}" class="input @error('login') ring-red-500 @enderror">
                
                @error('login')
                    <p class="error">{{$message}}</p>
                @enderror
            </div>

            {{-- Password --}}
            <div class="mb-4">
                <label for="password">Password</label>
                <input type="password" name="password" class="input @error('password') ring-red-500 @enderror">
                
                @error('password')
                    <p class="error">{{$message}}</p>
                @enderror
            </div>
            
            {{-- Remember checkbox --}}
            <div class="mb-4">
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">Remember me</label>
            </div>

            {{-- Return Message --}}
            @error('failed')
                <p class="error">{{$message}}</p>
            @enderror

            {{-- Submit Button --}}
            <button class="btn">Login</button>
        </form>
    </div>
</x-layout>