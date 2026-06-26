<?php

namespace App\Policies;

use App\Models\Book;
use App\Models\User;

class BookPolicy
{
    public function modify(User $user, Book $book): bool
    {
        return $user->id === $book->user_id || $user->role === 'admin';
    }
}
