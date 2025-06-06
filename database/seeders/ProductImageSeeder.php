<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProductImage; // Ensure this path matches the actual location of your ProductImage model
use App\Models\Product; // Ensure this path matches the actual location of your Product model
use Illuminate\Support\Str;

class ProductImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Sci-Fi books
        $theBook = Product::firstWhere('title', '1984');
        $images = [
            [
                'product_id' => $theBook->id,
                'image_path' => 'images/products/1984/front-cover.png',
            ],
            [
                'product_id' => $theBook->id,
                'image_path' => 'images/products/1984/book-insights.png',
            ],
        ];

        $theBook = Product::firstWhere('title', 'Animal Farm');
        $images = array_merge($images,
            [
                [
                    'product_id' => $theBook->id,
                    'image_path' => 'images/products/animal-farm/front-cover.png',
                ],
                [
                    'product_id' => $theBook->id,
                    'image_path' => 'images/products/animal-farm/book-insights.png',
                ],
            ]
        );

        // Fantasy books
        $theBook = Product::firstWhere('title', 'Harry Potter a Kameň mudrcov');
        $images = array_merge($images,
            [
                [
                    'product_id' => $theBook->id,
                    'image_path' => 'images/products/harry-potter-a-kamen-mudrcov/front-cover.png',
                ],
                [
                    'product_id' => $theBook->id,
                    'image_path' => 'images/products/harry-potter-a-kamen-mudrcov/back-cover.png',
                ],
                [
                    'product_id' => $theBook->id,
                    'image_path' => 'images/products/harry-potter-a-kamen-mudrcov/book-insights.png',
                ],
                [
                    'product_id' => $theBook->id,
                    'image_path' => 'images/products/harry-potter-a-kamen-mudrcov/full-book.png',
                ],
            ]
        );

        $theBook = Product::firstWhere('title', 'Harry Potter a Tajomná komnata');
        $images = array_merge($images,
            [
                [
                'product_id' => $theBook->id,
                'image_path' => 'images/products/harry-potter-a-tajomna-komnata/front-cover.png',
                ],
                [
                'product_id' => $theBook->id,
                'image_path' => 'images/products/harry-potter-a-tajomna-komnata/back-cover.png',
                ],
                [
                'product_id' => $theBook->id,
                'image_path' => 'images/products/harry-potter-a-tajomna-komnata/book-insights.png',
                ],
            ]
        );

        $theBook = Product::firstWhere('title', 'Harry Potter a Fénixov rád');
        $images = array_merge($images,
            [
                [
                    'product_id' => $theBook->id,
                    'image_path' => 'images/products/harry-potter-a-fenixov-rad/front-cover.png',
                ],
                [
                    'product_id' => $theBook->id,
                    'image_path' => 'images/products/harry-potter-a-fenixov-rad/back-cover.png',
                ],
                [
                    'product_id' => $theBook->id,
                    'image_path' => 'images/products/harry-potter-a-fenixov-rad/book-insights.png',
                ],
            ]
        );

        // Education
        $theBook = Product::firstWhere('title', 'Myšlením k bohatství');
        $images = array_merge($images,
            [
                [
                    'product_id' => $theBook->id,
                    'image_path' => 'images/products/myslenim-k-bohatstvi/front-cover.png',
                ],
                [
                    'product_id' => $theBook->id,
                    'image_path' => 'images/products/myslenim-k-bohatstvi/back-cover.png',
                ],
                [
                    'product_id' => $theBook->id,
                    'image_path' => 'images/products/myslenim-k-bohatstvi/book-insights.png',
                ],
            ]
        );

        $theBook = Product::firstWhere('title', 'Ako nabrať svaly');
        $images = array_merge($images,
            [
                [
                    'product_id' => $theBook->id,
                    'image_path' => 'images/products/ako-nabrat-svaly/front-cover.png',
                ],
                [
                    'product_id' => $theBook->id,
                    'image_path' => 'images/products/ako-nabrat-svaly/back-cover.png',
                ],
                [
                    'product_id' => $theBook->id,
                    'image_path' => 'images/products/ako-nabrat-svaly/book-insights.png',
                ],
            ]
        );

        $theBook = Product::firstWhere('title', 'Bohatý otec, chudobný otec');
        $images = array_merge($images,
            [
                [
                    'product_id' => $theBook->id,
                    'image_path' => 'images/products/bohaty-otec-chudobny-otec/front-cover.png',
                ],
                [
                    'product_id' => $theBook->id,
                    'image_path' => 'images/products/bohaty-otec-chudobny-otec/book-insights.png',
                ],
            ]
        );

        $theBook = Product::firstWhere('title', 'Cashflow kvadrant');
        $images = array_merge($images,
            [
                [
                    'product_id' => $theBook->id,
                    'image_path' => 'images/products/cashflow-kvadrant/front-cover.png',
                ],
                [
                    'product_id' => $theBook->id,
                    'image_path' => 'images/products/cashflow-kvadrant/back-cover.png',
                ],
                [
                    'product_id' => $theBook->id,
                    'image_path' => 'images/products/cashflow-kvadrant/book-insights.png',
                ],
            ]
        );

        $theBook = Product::firstWhere('title', 'Inteligentní investor');
        $images = array_merge($images,
            [
                [
                    'product_id' => $theBook->id,
                    'image_path' => 'images/products/inteligentni-investor/front-cover.png',
                ],
                [
                    'product_id' => $theBook->id,
                    'image_path' => 'images/products/inteligentni-investor/back-cover.png',
                ],
                [
                    'product_id' => $theBook->id,
                    'image_path' => 'images/products/inteligentni-investor/book-insights.png',
                ],
            ]
        );

        $theBook = Product::firstWhere('title', 'Security Analysis');
        $images = array_merge($images,
            [
                [
                    'product_id' => $theBook->id,
                    'image_path' => 'images/products/security-analysis/front-cover.png',
                ],
                [
                    'product_id' => $theBook->id,
                    'image_path' => 'images/products/security-analysis/book-insights.png',
                ],
            ]
        );

        $theBook = Product::firstWhere('title', 'Nejbohatší muž v Babylóně');
        $images = array_merge($images,
            [
                [
                    'product_id' => $theBook->id,
                    'image_path' => 'images/products/nejbohatsi-muz-v-babylone/front-cover.png',
                ],
                [
                    'product_id' => $theBook->id,
                    'image_path' => 'images/products/nejbohatsi-muz-v-babylone/back-cover.png',
                ],
                [
                    'product_id' => $theBook->id,
                    'image_path' => 'images/products/nejbohatsi-muz-v-babylone/book-insights.png',
                ],
            ]
        );

        // Adults
        $theBook = Product::firstWhere('title', 'Game of Thrones - A Game of Thrones');
        $images = array_merge($images,
            [
                [
                    'product_id' => $theBook->id,
                    'image_path' => 'images/products/game-of-thrones-a-game-of-thrones/front-cover.png',
                ],
                [
                    'product_id' => $theBook->id,
                    'image_path' => 'images/products/game-of-thrones-a-game-of-thrones/book-insights.png',
                ],
            ]
        );

        $theBook = Product::firstWhere('title', 'Game of Thrones - A Clash of Kings');
        $images = array_merge($images,
            [
                [
                    'product_id' => $theBook->id,
                    'image_path' => 'images/products/game-of-thrones-a-clash-of-kings/front-cover.png',
                ],
                [
                    'product_id' => $theBook->id,
                    'image_path' => 'images/products/game-of-thrones-a-clash-of-kings/back-cover.png',
                ],
                [
                    'product_id' => $theBook->id,
                    'image_path' => 'images/products/game-of-thrones-a-clash-of-kings/book-insights.png',
                ],
            ]
        );

        $theBook = Product::firstWhere('title', 'Game of Thrones - A Storm of Swords (Part 1: Steel and Snow)');
        $images = array_merge($images,
            [
                [
                    'product_id' => $theBook->id,
                    'image_path' => 'images/products/game-of-thrones-a-storm-of-swords-part-1-steel-and-snow/front-cover.png',
                ],
                [
                    'product_id' => $theBook->id,
                    'image_path' => 'images/products/game-of-thrones-a-storm-of-swords-part-1-steel-and-snow/book-insights.png',
                ],
            ]
        );

        $theBook = Product::firstWhere('title', 'Mercedes: Pod kapotou');
        $images = array_merge($images,
            [
                [
                    'product_id' => $theBook->id,
                    'image_path' => 'images/products/mercedes-pod-kapotou/front-cover.png',
                ],
                [
                    'product_id' => $theBook->id,
                    'image_path' => 'images/products/mercedes-pod-kapotou/book-insights.png',
                ],
            ]
        );

        $theBook = Product::firstWhere('title', 'Škola biznisu');
        $images = array_merge($images,
            [
                [
                    'product_id' => $theBook->id,
                    'image_path' => 'images/products/skola-biznisu/front-cover.png',
                ],
                [
                    'product_id' => $theBook->id,
                    'image_path' => 'images/products/skola-biznisu/book-insights.png',
                ],
            ]
        );

        $theBook = Product::firstWhere('title', 'Programování v C#');
        $images = array_merge($images,
            [
                [
                    'product_id' => $theBook->id,
                    'image_path' => 'images/products/programovani-v-c/front-cover.png',
                ],
                [
                    'product_id' => $theBook->id,
                    'image_path' => 'images/products/programovani-v-c/book-insights.png',
                ],
            ]
        );

        foreach ($images as $image) {
            ProductImage::create([
                'id' => Str::uuid(),
                'product_id' => $image['product_id'],
                'image_path' => $image['image_path'],
            ]);
        }
    }
}
