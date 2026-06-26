<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $books = Auth::user()->books()->latest()->paginate(6);
        return view('users.dashboard', ['books' => $books]);
    }

    public function userBooks(User $user)
    {
        $userBooks = $user->books()->latest()->paginate(6);
        return view('users.books', [
            'books' => $userBooks,
            'user' => $user,
        ]);
    }
}
