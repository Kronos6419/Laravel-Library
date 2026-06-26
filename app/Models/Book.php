<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Book extends Model
{
    /** @use HasFactory<\Database\Factories\BookFactory> */
    use HasFactory;

    /**
     * The genres a book can belong to.
     */
    public const GENRES = [
        'Fantasy',
        'Science Fiction',
        'Mystery',
        'Romance',
        'Horror',
        'Non-Fiction',
        'Biography',
        'Poetry',
    ];

    protected $fillable = [
        'title',
        'author',
        'genre',
        'description',
        'cover_image',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
