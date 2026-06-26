@props(['book', 'full' => false])

<div class="card">
    {{-- title --}}
    <h2 class="font-bold text-xl">{{ $book->title }}</h2>

    {{-- cover --}}
    <div class="h-52 rounded-md mb-4 w-full object-cover overflow-hidden">
        @if ($book->cover_image)
            <img src="{{ asset('storage/' . $book->cover_image) }}" alt="">
        @else
            <img src="{{ asset('storage/book_covers/default.jpg') }}" alt="">
        @endif
    </div>

    {{-- author and genre --}}
    <div class="text-xs">
        <span>By {{ $book->author }} &middot; {{ $book->genre }}</span>
    </div>

    {{-- added by and date --}}
    <div class="text-xs">
        <span>Added {{ $book->created_at->diffForHumans() }} by</span>
        <a href="{{ route('books.user', $book->user) }}" class="text-blue-500 font-medium">
            {{ $book->user->username }}
        </a>
    </div>

    {{-- description --}}
    @if ($full)
        <div class="text-sm">
            <span>{{ $book->description }}</span>
        </div>
    @else
        <div class="text-sm">
            <span>{{ Str::words($book->description, 15) }}</span>
            <a href="{{ route('books.show', $book) }}" class="text-blue-500">Read more &rarr;</a>
        </div>
    @endif

    <div class="flex items-center justify-end gap-4 mt-6">
        {{ $slot }}
    </div>
</div>
