<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Author;
use Illuminate\Support\Str;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Author::create([
            'id' => Str::uuid(),
            'name' => 'George',
            'surname' => 'Orwell',
            'birth_date' => '1903-06-25',
            'biography' => 'English novelist and essayist.',
        ]);

        Author::create([
            'id' => Str::uuid(),
            'name' => 'J.K.',
            'surname' => 'Rowling',
            'birth_date' => '1965-07-31',
            'biography' => 'British author, best known for the Harry Potter series.',
        ]);

        Author::create([
            'id' => Str::uuid(),
            'name' => 'Napoleon',
            'surname' => 'Hill',
            'birth_date' => '1883-10-26',
            'biography' => 'American self-help author.',
        ]);

        Author::create([
            'id' => Str::uuid(),
            'name' => 'Boris',
            'surname' => 'Prekop',
            'birth_date' => '1980-01-01',
            'biography' => 'Slovak author and entrepreneur.',
        ]);

        Author::create([
            'id' => Str::uuid(),
            'name' => 'Robert',
            'surname' => 'Kiyosaki',
            'birth_date' => '1947-04-08',
            'biography' => 'American businessman and author.',
        ]);

        Author::create([
            'id' => Str::uuid(),
            'name' => 'George R. R.',
            'surname' => 'Martin',
            'birth_date' => '1948-09-20',
            'biography' => 'American novelist and short story writer. Author of the world-famous series "Game of Thrones".',
        ]);

        Author::create([
            'id' => Str::uuid(),
            'name' => 'Benjamin',
            'surname' => 'Graham',
            'birth_date' => '1894-05-08',
            'biography' => 'American investor and economist. Known as the "father of value investing".',
        ]);

        Author::create([
            'id' => Str::uuid(),
            'name' => 'George S.',
            'surname' => 'Classon',
            'birth_date' => '1874-04-07',
            'biography' => 'American author, best known for his book "The Richest Man in Babylon", which offers timeless financial advice through parables set in ancient Babylon.',
        ]);
    }
}
