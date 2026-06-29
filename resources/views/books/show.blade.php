<x-layout>
    <a href="{{ route('books.index') }}" class="block mb-6 text-sm text-gold-dark">&larr; Back to catalogue</a>

    <div class="card max-w-2xl mx-auto">
        {{-- Full size cover --}}
        @if ($book->cover_image)
            <img src="{{ asset('storage/' . $book->cover_image) }}"
                    alt="Cover of {{ $book->title }}"
                    class="w-full rounded-md mb-6 object-contain">
        @else
            <img src="{{ asset('storage/book_covers/default.jpg') }}"
                    alt="Default cover"
                    class="w-full rounded-md mb-6 object-contain">
        @endif

        {{-- Title --}}
        <h1 class="title mb-1">{{ $book->title }}</h1>

        {{-- Author and genre --}}
        <div class="flex items-center gap-2 mb-4">
            <span class="book-author">By {{ $book->author }}</span>
            <span class="genre-badge">{{ $book->genre }}</span>
        </div>

        {{-- Added by --}}
        <div class="text-xs mb-6">
            Added {{ $book->created_at->diffForHumans() }} by
            <a href="{{ route('books.user', $book->user) }}">{{ $book->user->username }}</a>
        </div>

        {{-- Full description --}}
        <p class="text-sm leading-relaxed">{{ $book->description }}</p>
    </div>
</x-layout>