<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Athenaeum</title>

        {{-- Fonts: Lora (serif headings) + Inter (sans body) --}}
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Lora:wght@500;600;700&display=swap" rel="stylesheet">

        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        @vite(['resources/css/app.css', 'resources/scss/main.scss', 'resources/js/app.js'])
    </head>
    <body>
        <header class="site-header">
            <nav>
                <a href="{{ route('books.index') }}" class="brand">The Reading Room</a>

                <div class="nav-right">
                    <a href="{{ route('books.index') }}" class="nav-link">Browse</a>

                    @auth
                        <div class="relative grid place-items-center" x-data={open:false}>
                            <button @click="open = !open" @click.outside ='open=false' class="round-btn">
                                <img src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : asset('img/Death.png') }}" class="w-8 h-8 rounded-full object-cover" alt="profile picture">
                            </button>

                            <div x-show="open" class="bg-white shadow-lg absolute top-10 right-0 rounded-lg overflow-hidden font-light min-w-[180px]">
                                <p class="username">{{ auth()->user()->username }}</p>
                                <a href="{{ route('dashboard') }}" class="block hover:bg-slate-100 px-4 py-2">Dashboard</a>
                                <a href="{{ route('profile.edit') }}" class="block hover:bg-slate-100 px-4 py-2">Edit Profile</a>
                                @if (auth()->user()->role === 'admin')
                                    <a href="{{ route('admin.dashboard') }}" class="block hover:bg-slate-100 px-4 py-2">Admin Panel</a>
                                @endif

                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button class="block w-full text-left hover:bg-slate-100 pl-4 pr-8 py-2">Logout</button>
                                </form>
                            </div>
                        </div>
                    @endauth

                    @guest
                        <a href="{{ route('login') }}" class="nav-link">Login</a>
                        <a href="{{ route('register') }}" class="nav-link">Register</a>
                    @endguest
                </div>
            </nav>
        </header>

        <main class="py-8 px-4 mx-auto max-w-screen-lg">
            {{ $slot }}
        </main>
    </body>
</html>