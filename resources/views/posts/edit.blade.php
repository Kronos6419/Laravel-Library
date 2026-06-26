<x-layout>
    <a href="{{ route('dashboard') }}" class="block mb-2 text-xs text-blue-500">
        &larr; Go back to your dashboard</a>

    {{-- edit post form --}}
    <div class="card">
        <h2 class="font-bold mb-4">
            Update your post
        </h2>

        <form action="{{ route('posts.update', $post) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Post Title --}}
            <div class="mb-4">
                <label for="title">Post Title</label>
                <input type="text" name="title" value="{{ $post->title }}"
                    class="input @error('title') ring-red-500 @enderror">
                @error('title')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Post Body --}}
            <div class="mb-4">
                <label for="body">Post Content</label>
                <textarea name="body" rows="5" class="input @error('body') ring-red-500 @enderror">{{ $post->body }}</textarea>
                @error('body')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Current Featured photo --}}
            <div class="h-64 rounded-md mb-4 w-full object-cover overflow-hidden">
                @if ($post->image)
                    <label for="">Current featured photo</label>
                    <img src="{{ asset('storage/' . $post->image) }}" alt="">
                @endif
            </div>

            {{-- post image --}}
            <div class="mb-4">
                <label for="image">Featured image</label>
                <input type="file" name="image" id="image"
                    class="file:mr-4 file:py-2 file:px-4 file:text-sm file:font-semibold file:bg-gray-200 hover:file:bg-blue-100">
                @error('image')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <button class="btn">Update</button>
        </form>
    </div>
</x-layout>
