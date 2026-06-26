<x-layout>
    <h1 class="title">Library Catalogue</h1>

    <div class="grid grid-cols-2 gap-6">
        @foreach ($books as $book)
            <x-bookCard :book="$book" />
        @endforeach
    </div>

    <div>
        {{ $books->links() }}
    </div>
</x-layout>
