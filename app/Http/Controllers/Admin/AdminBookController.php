<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class AdminBookController extends Controller
{
    public function index()
    {
        $books = Book::with('user')->latest()->paginate(10);
        return view('admin.books.index', compact('books'));
    }

    public function edit(Book $book)
    {
        $users = User::all();
        return view('admin.books.edit', compact('book', 'users'));
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required|max:255',
            'author' => 'required|max:255',
            'genre' => ['required', Rule::in(Book::GENRES)],
            'description' => 'required',
            'cover_image' => ['nullable', 'file', 'max:3000', 'mimes:png,jpg,webp'],
            'user_id' => 'required|exists:users,id',
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
            'user_id' => $request->user_id,
        ]);

        return redirect()->route('admin.books.index')->with('success', 'Book updated.');
    }

    public function destroy(Book $book)
    {
        if ($book->cover_image) {
            Storage::disk('public')->delete($book->cover_image);
        }

        $book->delete();
        return redirect()->route('admin.books.index')->with('success', 'Book deleted.');
    }
}
