<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class BookController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('auth', except: ['index', 'show']),
        ];
    }

    public function index()
    {
        $books = Book::latest()->paginate(6);
        return view('books.index', ['books' => $books]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'max:255'],
            'author' => ['required', 'max:255'],
            'genre' => ['required', Rule::in(Book::GENRES)],
            'description' => ['required'],
            'cover_image' => ['nullable', 'file', 'max:3000', 'mimes:png,jpg,webp'],
        ]);

        $path = null;
        if ($request->hasFile('cover_image')) {
            $path = Storage::disk('public')->put('book_covers', $request->cover_image);
        }

        Auth::user()->books()->create([
            'title' => $request->title,
            'author' => $request->author,
            'genre' => $request->genre,
            'description' => $request->description,
            'cover_image' => $path,
        ]);

        return back()->with('success', 'Your book was added');
    }

    public function show(Book $book)
    {
        return view('books.show', ['book' => $book]);
    }

    public function edit(Book $book)
    {
        Gate::authorize('modify', $book);

        return view('books.edit', ['book' => $book]);
    }

    public function update(Request $request, Book $book)
    {
        Gate::authorize('modify', $book);

        $request->validate([
            'title' => ['required', 'max:255'],
            'author' => ['required', 'max:255'],
            'genre' => ['required', Rule::in(Book::GENRES)],
            'description' => ['required'],
            'cover_image' => ['nullable', 'file', 'max:3000', 'mimes:png,jpg,webp'],
        ]);

        $path = $book->cover_image ?? null;
        if ($request->hasFile('cover_image')) {
            if ($book->cover_image) {
                Storage::disk('public')->delete($book->cover_image);
            }
            $path = Storage::disk('public')->put('book_covers', $request->cover_image);
        }

        $book->update([
            'title' => $request->title,
            'author' => $request->author,
            'genre' => $request->genre,
            'description' => $request->description,
            'cover_image' => $path,
        ]);

        return redirect()->route('dashboard')->with('success', 'Your book was updated.');
    }

    public function destroy(Book $book)
    {
        Gate::authorize('modify', $book);

        if ($book->cover_image) {
            Storage::disk('public')->delete($book->cover_image);
        }

        $book->delete();
        return back()->with('delete', 'Your book was deleted');
    }
}
