<x-layout page="dashboard">
    <h1 class="title">Welcome {{ auth()->user()->username }}, you have {{ $books->total() }} books</h1>

    {{-- Flash message area: populated by dashboard.js --}}
    <div id="dashboard-flash"></div>

    {{-- add book form --}}
    <div class="card mb-4">
        <h2 class="font-bold mb-4">Add a new book</h2>

        <form id="create-book-form" enctype="multipart/form-data">

            {{-- Title --}}
            <div class="mb-4">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="input">
            </div>

            {{-- Author --}}
            <div class="mb-4">
                <label for="author">Author</label>
                <input type="text" name="author" id="author" class="input">
            </div>

            {{-- Genre --}}
            <div class="mb-4">
                <label for="genre">Genre</label>
                <select name="genre" id="genre" class="input">
                    <option value="">Select a genre</option>
                    @foreach (\App\Models\Book::GENRES as $genre)
                        <option value="{{ $genre }}">{{ $genre }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Description --}}
            <div class="mb-4">
                <label for="description">Description</label>
                <textarea name="description" id="description" rows="5" class="input"></textarea>
            </div>

            {{-- Cover image --}}
            <div class="mb-4">
                <label for="cover_image">Cover image</label>
                <input type="file" name="cover_image" id="cover_image"
                    class="file:mr-4 file:py-2 file:px-4 file:text-sm file:font-semibold file:bg-gray-200 hover:file:bg-blue-100">
            </div>

            <button type="submit" class="btn">Add Book</button>
        </form>
    </div>

    {{-- user books --}}
    <h2 class="font-bold mb-4">Your Books</h2>

    <div id="dashboard-books" class="grid grid-cols-2 gap-6">
        @foreach ($books as $book)
            <div class="card book-dashboard-card" data-book-id="{{ $book->id }}">
                <h2 class="font-bold text-xl">{{ $book->title }}</h2>

                <div class="book-cover">
                    @if ($book->cover_image)
                        <img src="{{ asset('storage/' . $book->cover_image) }}" alt="">
                    @else
                        <img src="{{ asset('storage/book_covers/default.jpg') }}" alt="">
                    @endif
                </div>

                <div class="text-xs">
                    <span class="book-author">By {{ $book->author }}</span>
                    <span class="genre-badge">{{ $book->genre }}</span>
                </div>

                <div class="text-sm mt-2">
                    {{ Str::words($book->description, 15) }}
                </div>

                <div class="flex items-center justify-end gap-4 mt-6">
                    {{-- Update goes to Blade edit page --}}
                    <a href="{{ route('books.edit', $book) }}"
                        class="bg-green-500 text-white px-2 py-1 text-xs rounded-md">Update</a>

                    {{-- Delete via JS --}}
                    <button class="js-delete-btn bg-red-500 text-white px-2 py-1 text-xs rounded-md"
                        data-book-id="{{ $book->id }}">Delete</button>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-4">
        {{ $books->links() }}
    </div>
</x-layout>
