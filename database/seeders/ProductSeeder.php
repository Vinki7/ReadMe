<?php

namespace Database\Seeders;

use App\Enums\Category;
use GuzzleHttp\Promise\Create;
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
        $author = Author::where('surname', 'Orwell')->first()->id;
        Product::create([
            'id' => Str::uuid(),
            'title' => '1984',
            'description' => '"1984" is a seminal dystopian novel that explores the dangers of totalitarianism,
                surveillance, and the suppression of individuality. Set in a grim future where the world is
                divided into three superstates perpetually at war, the story follows Winston Smith, a low-ranking
                member of the Party in the superstate of Oceania. The Party, led by the enigmatic Big Brother,
                exercises absolute control over every aspect of life, including thought, language, and even history.',
            'price' => 19.99,
            'category' => Category::SciFi->value,
            'language' => 'English',
            'publisher' => 'Secker & Warburg',
            'publication_date' => '1949-06-08',
            'isbn' => '978-0-451-52493-5',
            'directory' => Str::slug('1984'),
        ])->authors()->attach($author);

        Product::create([
            'id' => Str::uuid(),
            'title' => 'Animal Farm',
            'description' => '"Animal Farm" is a satirical allegory of the Russian Revolution and the rise of
                totalitarianism, told through the story of a group of farm animals who overthrow their human
                owner in hopes of creating a society where all animals are equal. However, as the pigs
                take control, they become increasingly corrupt and oppressive, ultimately leading to a regime
                that is indistinguishable from the one they replaced. The novel serves as a powerful critique
                of power, propaganda, and the betrayal of revolutionary ideals.',
            'price' => 15.99,
            'category' => Category::SciFi->value,
            'language' => 'English',
            'publisher' => 'Secker & Warburg',
            'publication_date' => '1945-08-17',
            'isbn' => '978-0-452-28424-1',
            'directory' => Str::slug('Animal Farm'),
        ])->authors()->attach($author);

        // Fantasy books
        $author = Author::where('surname', 'Rowling')->first();
        Product::create([
            'id' => Str::uuid(),
            'title' => 'Harry Potter a Kameň mudrcov',
            'description' => "When a letter arrives for unhappy but ordinary Harry Potter, a decade-old secret is
                revealed to him that apparently he's the last to know. His parents were wizards,
                killed by a Dark Lord's curse when Harry was just a baby, and which he somehow survived.
                Leaving his unsympathetic aunt and uncle for Hogwarts, a wizarding school brimming with
                ghosts and enchantments, Harry stumbles upon a sinister mystery when he finds a three-headed
                dog guarding a room on the third floor. Then he hears of a missing stone with astonishing
                powers which could be valuable, dangerous - or both.",
            'price' => 12.99,
            'category' => Category::Fantasy->value,
            'language' => 'Slovak',
            'publisher' => 'Ikar',
            'publication_date' => '2000-01-01',
            'isbn' => '978-80-8085-200-0',
            'directory' => Str::slug('Harry Potter a Kameň mudrcov'),
        ])->authors()->attach($author->id);

        Product::create([
            'id' => Str::uuid(),
            'title' => 'Harry Potter a Tajomná komnata',
            'description' => 'The second book in the Harry Potter series, where Harry returns to Hogwarts and uncovers the mystery of the Chamber of Secrets.',
            'price' => 14.99,
            'category' => Category::Fantasy->value,
            'language' => 'Slovak',
            'publisher' => 'Ikar',
            'publication_date' => '2000-01-01',
            'isbn' => '978-80-8085-201-7',
            'directory' => Str::slug('Harry Potter a Tajomná Komnata'),
        ])->authors()->attach($author->id);

        Product::create([
            'id' => Str::uuid(),
            'title' => 'Harry Potter a Fénixov rád',
            'description' => 'The fifth book in the Harry Potter series, where Harry and his friends form Dumbledore\'s Army to fight against the oppressive regime at Hogwarts.',
            'price' => 18.99,
            'category' => Category::Fantasy->value,
            'language' => 'Slovak',
            'publisher' => 'Ikar',
            'publication_date' => '2003-01-01',
            'isbn' => '978-80-8085-205-5',
            'directory' => Str::slug('Harry Potter a Fénixov rád'),
        ])->authors()->attach($author->id);

        // Education books
        Product::create([
            'id' => Str::uuid(),
            'title' => 'Myšlením k bohatství',
            'description' => 'A classic self-help book that teaches the principles of success and wealth creation.',
            'price' => 15.99,
            'category' => Category::Education->value,
            'language' => 'Czech',
            'publisher' => 'Pragma',
            'publication_date' => '1937-01-01',
            'isbn' => '978-80-87128-00-8',
            'directory' => Str::slug('Myšlením k bohatství'),
        ])->authors()->attach(Author::where('surname', 'Hill')->first()->id);

        Product::create([
            'id' => Str::uuid(),
            'title' => 'Ako nabrať svaly',
            'description' => 'A comprehensive guide to building muscle and improving physical fitness.',
            'price' => 22.99,
            'category' => Category::Education->value,
            'language' => 'Slovak',
            'publisher' => 'Fitness Academy',
            'publication_date' => '2015-01-01',
            'isbn' => '978-80-971540-0-1',
            'directory' => Str::slug('Ako nabrať svaly'),
        ])->authors()->attach(Author::where('surname', 'Prekop')->first()->id);

        $author = Author::where('surname', 'Kiyosaki')->first()->id;
        Product::create([
            'id' => Str::uuid(),
            'title' => 'Cashflow kvadrant',
            'description' => 'A book that explains the different types of income and how to achieve financial independence.',
            'price' => 17.99,
            'category' => Category::Education->value,
            'language' => 'Czech',
            'publisher' => 'Pragma',
            'publication_date' => '1998-01-01',
            'isbn' => '978-80-87128-01-5',
            'directory' => Str::slug('Cashflow kvadrant'),
        ])->authors()->attach($author);

        Product::create([
            'id' => Str::uuid(),
            'title' => 'Bohatý otec, chudobný otec',
            'description' => 'A personal finance book that contrasts the financial philosophies of the author\'s two "fathers".',
            'price' => 19.99,
            'category' => Category::Education->value,
            'language' => 'Slovak',
            'publisher' => 'Pragma',
            'publication_date' => '1997-01-01',
            'isbn' => '978-80-87128-04-6',
            'directory' => Str::slug('Bohatý otec, chudobný otec'),
        ])->authors()->attach($author);

        Product::create([
            'id' => Str::uuid(),
            'title' => 'Inteligentní investor',
            'description' => 'A classic book on value investing that teaches the principles of sound investment.',
            'price' => 55.99,
            'category' => Category::Education->value,
            'language' => 'Czech',
            'publisher' => 'Grada',
            'publication_date' => '1949-01-01',
            'isbn' => '978-80-87128-02-2',
            'directory' => Str::slug('Inteligentní investor'),
        ])->authors()->attach(Author::where('surname', 'Graham')->first()->id);

        Product::create([
            'id' => Str::uuid(),
            'title' => 'Security Analysis',
            'description' => 'A comprehensive guide to analyzing stocks and bonds, focusing on value investing principles.',
            'price' => 102.99,
            'category' => Category::Education->value,
            'language' => 'English',
            'publisher' => 'McGraw-Hill',
            'publication_date' => '1934-01-01',
            'isbn' => '978-0-07-024496-2',
            'directory' => Str::slug('Security Analysis'),
        ])->authors()->attach(Author::where('surname', 'Graham')->first()->id);

        Product::create([
            'id' => Str::uuid(),
            'title' => 'Nejbohatší muž v Babylóně',
            'description' => 'A book that offers timeless financial advice through parables set in ancient Babylon.',
            'price' => 12.99,
            'category' => Category::Education->value,
            'language' => 'Czech',
            'publisher' => 'Pragma',
            'publication_date' => '1926-01-01',
            'isbn' => '978-80-87128-03-9',
            'directory' => Str::slug('Nejbohatší muž v Babylóně'),
        ])->authors()->attach(Author::where('surname', 'Classon')->first()->id);

        // Adult books
        Product::create([
            'id' => Str::uuid(),
            'title' => 'Game of Thrones - A Game of Thrones',
            'description' => 'The first book in the A Song of Ice and Fire series, introducing the epic tale of power, betrayal, and survival in the Seven Kingdoms.',
            'price' => 24.99,
            'category' => Category::Adults->value,
            'language' => 'English',
            'publisher' => 'Bantam Books',
            'publication_date' => '1996-08-06',
            'isbn' => '978-0-553-10354-0',
            'directory' => Str::slug('Game of Thrones - A Game of Thrones'),
        ])->authors()->attach(Author::where('surname', 'Martin')->first()->id);

        Product::create([
            'id' => Str::uuid(),
            'title' => 'Game of Thrones - A Clash of Kings',
            'description' => 'The second book in the A Song of Ice and Fire series, continuing the epic tale of power struggles and intrigue in the Seven Kingdoms.',
            'price' => 29.99,
            'category' => Category::Adults->value,
            'language' => 'English',
            'publisher' => 'Bantam Books',
            'publication_date' => '1998-11-16',
            'isbn' => '978-0-553-10803-3',
            'directory' => Str::slug('Game of Thrones - A Clash of Kings'),
        ])->authors()->attach(Author::where('surname', 'Martin')->first()->id);

        Product::create([
            'id' => Str::uuid(),
            'title' => 'Game of Thrones - A Storm of Swords (Part 1: Steel and Snow)',
            'description' => 'The third book in the A Song of Ice and Fire series, where the war for the Iron Throne escalates and alliances shift.',
            'price' => 32.99,
            'category' => Category::Adults->value,
            'language' => 'English',
            'publisher' => 'Bantam Books',
            'publication_date' => '2000-03-21',
            'isbn' => '978-0-553-10804-0',
            'directory' => Str::slug('Game of Thrones - A Storm of Swords (Part 1: Steel and Snow)'),
        ])->authors()->attach(Author::where('surname', 'Martin')->first()->id);

        Product::create([
            'id' => Str::uuid(),
            'title' => 'Mercedes: Pod kapotou',
            'description' => 'Packed with fascinating details, secrets of team strategy, and never-before-seen photos,
                this book immerses readers in the heart of the world\'s fastest sport. It\'s a story of resilience, innovation,
                and the hunger for victory that will captivate F1 fans and anyone inspired by peak team performance.',
            'price' => 17.77,
            'category' => Category::Biography->value,
            'language' => 'Slovak',
            'publisher' => 'Motýľ',
            'publication_date' => '2025-05-19',
            'isbn' => '978-8-081-64404-7',
            'directory' => Str::slug('Mercedes: Pod kapotou'),
        ])->authors()->attach(Author::where('surname', 'Martin')->first()->id);

        Product::create([
            'id' => Str::uuid(),
            'title' => 'Škola biznisu',
            'description' => 'Packed with fascinating details, secrets of team strategy, and never-before-seen photos,
                this book immerses readers in the heart of the world\'s fastest sport. It\'s a story of resilience, innovation,
                and the hunger for victory that will captivate F1 fans and anyone inspired by peak team performance.',
            'price' => 6.00,
            'category' => Category::Education->value,
            'language' => 'Slovak',
            'publisher' => 'Motýľ',
            'publication_date' => '2007-01-01',
            'isbn' => '123-4-456-78951-8',
            'directory' => Str::slug('Škola biznisu'),
        ])->authors()->attach(Author::where('surname', 'Kiyosaki')->first()->id);
    }
}
