<x-layout>
    <a href="{{ route('admin.dashboard') }}" class="block mb-2 text-xs text-blue-500">&larr; Go back to your dashboard</a>

    <div class="card">
        <h2 class="font-bold mb-4">Update book</h2>

        <form action="{{ route('admin.books.update', $book) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="title">Title</label>
                <input type="text" name="title" value="{{ old('title', $book->title) }}"
                    class="input @error('title') ring-red-500 @enderror">
                @error('title')
                    <p class="error"> {{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="author">Author</label>
                <input type="text" name="author" value="{{ old('author', $book->author) }}"
                    class="input @error('author') ring-red-500 @enderror">
                @error('author')
                    <p class="error"> {{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="genre">Genre</label>
                <select name="genre" class="input @error('genre') ring-red-500 @enderror">
                    @foreach (\App\Models\Book::GENRES as $genre)
                        <option value="{{ $genre }}" @selected(old('genre', $book->genre) == $genre)>{{ $genre }}</option>
                    @endforeach
                </select>
                @error('genre')
                    <p class="error"> {{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="description">Description</label>
                <textarea name="description" rows="5" class="input @error('description') ring-red-500 @enderror">{{ old('description', $book->description) }}</textarea>
                @error('description')
                    <p class="error"> {{ $message }}</p>
                @enderror
            </div>

            {{-- current cover --}}
            <div class="h-52 rounded-md mb-4 object-cover overflow-hidden">
                <label class="block mb-1">Current cover</label>
                @if ($book->cover_image)
                    <img src="{{ asset('storage/' . $book->cover_image) }}" alt="" class="h-full object-contain">
                @else
                    <img src="{{ asset('storage/book_covers/default.jpg') }}" alt="" class="h-full object-contain">
                @endif
            </div>

            {{-- upload new cover --}}
            <div class="mb-4">
                <label for="cover_image">Cover image</label>
                <input type="file" name="cover_image" id="cover_image"
                    class="file:mr-4 file:py-2 file:px-4 file:text-sm file:font-semibold file:bg-gray-200 hover:file:bg-blue-100">
                @error('cover_image')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- owner --}}
            <div class="mb-4">
                <label for="user_id">Owner</label>
                <select name="user_id" id="user_id" class="input @error('user_id') ring-red-500 @enderror">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" @selected(old('user_id', $book->user_id) == $user->id)>{{ $user->username }}</option>
                    @endforeach
                </select>
                @error('user_id')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <button class="btn">Update</button>
        </form>
    </div>
</x-layout>
