<x-layout>
    <a href="{{ route('admin.dashboard') }}" class="block mb-2 text-xs text-blue-500">&larr; Go back to your dashboard</a>

    <h1 class="title">Manage Books</h1>

    @if (session('success'))
        <x-flashMsg msg="{{ session('success') }}" />
    @endif

    <div class="card overflow-x-auto">
        <table class="min-w-full text-sm">
            <thead>
                <tr class="bg-slate-100 text-left">
                    <th class="p-2">ID</th>
                    <th class="p-2">Title</th>
                    <th class="p-2">Author</th>
                    <th class="p-2">Genre</th>
                    <th class="p-2">Owner</th>
                    <th class="p-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($books as $book)
                    <tr class="border-t">
                        <td class="p-2">{{ $book->id }}</td>
                        <td class="p-2">{{ $book->title }}</td>
                        <td class="p-2">{{ $book->author }}</td>
                        <td class="p-2">{{ $book->genre }}</td>
                        <td class="p-2">{{ $book->user->username }}</td>
                        <td class="p-2 flex gap-2">
                            <a href="{{ route('admin.books.edit', $book) }}" class="text-blue-600 hover:underline">Edit</a>
                            <form action="{{ route('admin.books.destroy', $book) }}" method="POST" onsubmit="return confirm('Delete this book?')">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $books->links() }}
    </div>
</x-layout>
