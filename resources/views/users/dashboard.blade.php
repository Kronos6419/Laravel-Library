<x-layout>
    <h1 class="title">Welcome {{ auth()->user()->username }}, you have {{ $books->total() }} books</h1>

    {{-- add book form --}}
    <div class="card mb-4">
        <h2 class="font-bold mb-4">Add a new book</h2>

        {{-- session messages --}}
        @if (session('success'))
            <x-flashMsg msg=" {{ session('success') }} " />
        @elseif (session('delete'))
            <x-flashMsg msg=" {{ session('delete') }} " bg="bg-red-500" />
        @endif

        <form action="{{ route('books.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            {{-- Title --}}
            <div class="mb-4">
                <label for="title">Title</label>
                <input type="text" name="title" value="{{ old('title') }}"
                    class="input @error('title') ring-red-500 @enderror">
                @error('title')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Author --}}
            <div class="mb-4">
                <label for="author">Author</label>
                <input type="text" name="author" value="{{ old('author') }}"
                    class="input @error('author') ring-red-500 @enderror">
                @error('author')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Genre --}}
            <div class="mb-4">
                <label for="genre">Genre</label>
                <select name="genre" class="input @error('genre') ring-red-500 @enderror">
                    <option value="">Select a genre</option>
                    @foreach (\App\Models\Book::GENRES as $genre)
                        <option value="{{ $genre }}" @selected(old('genre') == $genre)>{{ $genre }}</option>
                    @endforeach
                </select>
                @error('genre')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Description --}}
            <div class="mb-4">
                <label for="description">Description</label>
                <textarea name="description" rows="5" class="input @error('description') ring-red-500 @enderror">{{ old('description') }}</textarea>
                @error('description')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Cover image --}}
            <div class="mb-4">
                <label for="cover_image">Cover image</label>
                <input type="file" name="cover_image" id="cover_image"
                    class="file:mr-4 file:py-2 file:px-4 file:text-sm file:font-semibold file:bg-gray-200 hover:file:bg-blue-100">
                @error('cover_image')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <button class="btn">Add Book</button>
        </form>
    </div>

    {{-- user books --}}
    <h2 class="font-bold mb-4">Your Books</h2>

    <div class="grid grid-cols-2 gap-6">
        @foreach ($books as $book)
            <x-bookCard :book="$book">
                {{-- update --}}
                <a href="{{ route('books.edit', $book) }}" class="bg-green-500 text-white px-2 py-1 text-xs rounded-md">Update</a>

                {{-- delete --}}
                <form action="{{ route('books.destroy', $book) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="bg-red-500 text-white px-2 py-1 text-xs rounded-md">Delete</button>
                </form>
            </x-bookCard>
        @endforeach
    </div>

    <div>
        {{ $books->links() }}
    </div>
</x-layout>
