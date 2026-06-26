<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Book;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin account required by the assignment brief (admin / admin)
        $admin = User::create([
            'username' => 'admin',
            'email' => 'admin@library.test',
            'password' => bcrypt('admin'),
            'role' => 'admin',
        ]);

        // A few author accounts to populate the catalogue
        $authors = User::factory(4)->create();

        // Give the admin and each author a handful of books
        foreach ($authors->push($admin) as $user) {
            Book::factory(rand(3, 6))->create(['user_id' => $user->id]);
        }
    }
}
