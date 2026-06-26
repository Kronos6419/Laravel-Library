<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class BookApiController extends Controller
{
    /**
     * GET /api/books
     * Public — returns paginated list of books as JSON.
     */
    public function index(Request $request)
    {
        $query = Book::with('user')->latest();

        // Optional genre filter: GET /api/books?genre=Mystery
        if ($request->filled('genre')) {
            $query->where('genre', $request->genre);
        }

        // Optional search: GET /api/books?search=dune
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('author', 'like', "%{$search}%");
            });
        }

        $books = $query->paginate(6)->withQueryString();

        return BookResource::collection($books);
    }

    /**
     * GET /api/books/{book}
     * Public — returns a single book as JSON.
     */
    public function show(Book $book)
    {
        $book->load('user');
        return new BookResource($book);
    }

    /**
     * POST /api/books
     * Auth required — creates a book for the logged-in user.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'       => ['required', 'max:255'],
            'author'      => ['required', 'max:255'],
            'genre'       => ['required', Rule::in(Book::GENRES)],
            'description' => ['required'],
            'cover_image' => ['nullable', 'file', 'max:3000', 'mimes:png,jpg,webp'],
        ]);

        $path = null;
        if ($request->hasFile('cover_image')) {
            $path = Storage::disk('public')->put('book_covers', $request->cover_image);
        }

        $book = Auth::user()->books()->create([
            'title'       => $request->title,
            'author'      => $request->author,
            'genre'       => $request->genre,
            'description' => $request->description,
            'cover_image' => $path,
        ]);

        $book->load('user');

        return (new BookResource($book))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * PUT /api/books/{book}
     * Auth + ownership required — updates a book.
     */
    public function update(Request $request, Book $book)
    {
        Gate::authorize('modify', $book);

        $request->validate([
            'title'       => ['required', 'max:255'],
            'author'      => ['required', 'max:255'],
            'genre'       => ['required', Rule::in(Book::GENRES)],
            'description' => ['required'],
            'cover_image' => ['nullable', 'file', 'max:3000', 'mimes:png,jpg,webp'],
        ]);

        // Keep existing cover unless a new file was uploaded
        $path = $book->cover_image ?? null;
        if ($request->hasFile('cover_image')) {
            if ($book->cover_image) {
                Storage::disk('public')->delete($book->cover_image);
            }
            $path = Storage::disk('public')->put('book_covers', $request->cover_image);
        }

        $book->update([
            'title'       => $request->title,
            'author'      => $request->author,
            'genre'       => $request->genre,
            'description' => $request->description,
            'cover_image' => $path,
        ]);

        $book->load('user');

        return new BookResource($book);
    }

    /**
     * DELETE /api/books/{book}
     * Auth + ownership required — deletes a book and its cover.
     */
    public function destroy(Book $book)
    {
        Gate::authorize('modify', $book);

        if ($book->cover_image) {
            Storage::disk('public')->delete($book->cover_image);
        }

        $book->delete();

        return response()->json(['message' => 'Book deleted successfully.']);
    }
}
