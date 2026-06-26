<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Book>
 */
class BookFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => 1,
            'title' => fake()->sentence(3),
            'author' => fake()->name(),
            'genre' => fake()->randomElement(Book::GENRES),
            'description' => fake()->paragraph(5),
            'cover_image' => null,
        ];
    }
}
