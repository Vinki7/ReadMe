<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Str;
use App\Models\Author;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'id' => Str::uuid(),
            'title' => '1984',
            'description' => 'Dystopian novel.',
            'price' => 19.99,
            'stock' => 50,
            'category' => 'sci-fi',
            'language' => 'English',
            'publisher' => 'Secker & Warburg',
            'publication_date' => '1949-06-08',
            'isbn' => '978-0-451-52493-5',
        ])->authors()->attach(Author::where('surname', 'Orwell')->first()->id);

        // Fantasy books
        $author = Author::where('surname', 'Rowling')->first();
        Product::create([
            'id' => Str::uuid(),
            'title' => 'Harry Potter a Kameň mudrcov',
            'description' => 'The first book in the Harry Potter series, introducing the young wizard Harry Potter and his adventures at Hogwarts School of Witchcraft and Wizardry.',
            'price' => 12.99,
            'stock' => 20,
            'category' => 'fantasy',
            'language' => 'Slovak',
            'publisher' => 'Ikar',
            'publication_date' => '2000-01-01',
            'isbn' => '978-80-8085-200-0',
        ])->authors()->attach($author->id);

        Product::create([
            'id' => Str::uuid(),
            'title' => 'Harry Potter a Tajomná komnata',
            'description' => 'The second book in the Harry Potter series, where Harry returns to Hogwarts and uncovers the mystery of the Chamber of Secrets.',
            'price' => 14.99,
            'stock' => 30,
            'category' => 'fantasy',
            'language' => 'Slovak',
            'publisher' => 'Ikar',
            'publication_date' => '2000-01-01',
            'isbn' => '978-80-8085-201-7',
        ])->authors()->attach($author->id);

        Product::create([
            'id' => Str::uuid(),
            'title' => 'Harry Potter a Fénixov rád',
            'description' => 'The fifth book in the Harry Potter series, where Harry and his friends form Dumbledore\'s Army to fight against the oppressive regime at Hogwarts.',
            'price' => 18.99,
            'stock' => 25,
            'category' => 'fantasy',
            'language' => 'Slovak',
            'publisher' => 'Ikar',
            'publication_date' => '2003-01-01',
            'isbn' => '978-80-8085-205-5',
        ])->authors()->attach($author->id);

        // Education books
        Product::create([
            'id' => Str::uuid(),
            'title' => 'Myšlením k bohatství',
            'description' => 'A classic self-help book that teaches the principles of success and wealth creation.',
            'price' => 15.99,
            'stock' => 40,
            'category' => 'education',
            'language' => 'Czech',
            'publisher' => 'Pragma',
            'publication_date' => '1937-01-01',
            'isbn' => '978-80-87128-00-8',
        ])->authors()->attach(Author::where('surname', 'Hill')->first()->id);

        Product::create([
            'id' => Str::uuid(),
            'title' => 'Ako nabrať svaly',
            'description' => 'A comprehensive guide to building muscle and improving physical fitness.',
            'price' => 22.99,
            'stock' => 15,
            'category' => 'education',
            'language' => 'Slovak',
            'publisher' => 'Fitness Academy',
            'publication_date' => '2015-01-01',
            'isbn' => '978-80-971540-0-1',
        ])->authors()->attach(Author::where('surname', 'Prekop')->first()->id);

        Product::create([
            'id' => Str::uuid(),
            'title' => 'Cashflow kvadrant',
            'description' => 'A book that explains the different types of income and how to achieve financial independence.',
            'price' => 17.99,
            'stock' => 10,
            'category' => 'education',
            'language' => 'Czech',
            'publisher' => 'Pragma',
            'publication_date' => '1998-01-01',
            'isbn' => '978-80-87128-01-5',
        ])->authors()->attach(Author::where('surname', 'Kiyosaki')->first()->id);

        Product::create([
            'id' => Str::uuid(),
            'title' => 'Inteligentní investor',
            'description' => 'A classic book on value investing that teaches the principles of sound investment.',
            'price' => 55.99,
            'stock' => 5,
            'category' => 'education',
            'language' => 'Czech',
            'publisher' => 'Grada',
            'publication_date' => '1949-01-01',
            'isbn' => '978-80-87128-02-2',
        ])->authors()->attach(Author::where('surname', 'Graham')->first()->id);

        Product::create([
            'id' => Str::uuid(),
            'title' => 'Nejbohatnější muž v Babylóně',
            'description' => 'A book that offers timeless financial advice through parables set in ancient Babylon.',
            'price' => 12.99,
            'stock' => 20,
            'category' => 'education',
            'language' => 'Czech',
            'publisher' => 'Pragma',
            'publication_date' => '1926-01-01',
            'isbn' => '978-80-87128-03-9',
        ])->authors()->attach(Author::where('surname', 'Classon')->first()->id);

        // Adult books
        Product::create([
            'id' => Str::uuid(),
            'title' => 'Game of Thrones - A Clash of Kings',
            'description' => 'The second book in the A Song of Ice and Fire series, continuing the epic tale of power struggles and intrigue in the Seven Kingdoms.',
            'price' => 29.99,
            'stock' => 12,
            'category' => 'adults',
            'language' => 'English',
            'publisher' => 'Bantam Books',
            'publication_date' => '1998-11-16',
            'isbn' => '978-0-553-10803-3',
        ])->authors()->attach(Author::where('surname', 'Martin')->first()->id);
    }
}
