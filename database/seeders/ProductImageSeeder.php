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
        // Fantasy books
        $theBook = Product::firstWhere('title', 'Harry Potter a Kameň mudrcov');
        $images = [
            [
                'product_id' => $theBook->id, // replace with actual UUID or get from DB
                'image_path' => 'images/products/harry-potter-1/front-cover.PNG',
            ],
            [
                'product_id' => $theBook->id,
                'image_path' => 'images/products/harry-potter-1/back-cover.PNG',
            ],
            [
                'product_id' => $theBook->id,
                'image_path' => 'images/products/harry-potter-1/book-insights.PNG',
            ],
            [
                'product_id' => $theBook->id,
                'image_path' => 'images/products/harry-potter-1/full-book.PNG',
            ],
        ];

        $theBook = Product::firstWhere('title', 'Harry Potter a Tajomná komnata');
        $images = array_merge($images,
            [
                [
                'product_id' => $theBook->id,
                'image_path' => 'images/products/harry-potter-2/front-cover.PNG',
                ],
                [
                'product_id' => $theBook->id,
                'image_path' => 'images/products/harry-potter-2/back-cover.PNG',
                ],
                [
                'product_id' => $theBook->id,
                'image_path' => 'images/products/harry-potter-2/book-insights.PNG',
                ],
                [
                'product_id' => $theBook->id,
                'image_path' => 'images/products/harry-potter-2/full-book.PNG',
                ],
            ]
        );

        $theBook = Product::firstWhere('title', 'Harry Potter a Fénixov rád');
        $images = array_merge($images,
            [
                [
                    'product_id' => $theBook->id,
                    'image_path' => 'images/products/harry-potter-5/front-cover.PNG',
                ],
                [
                    'product_id' => $theBook->id,
                    'image_path' => 'images/products/harry-potter-5/back-cover.PNG',
                ],
                [
                    'product_id' => $theBook->id,
                    'image_path' => 'images/products/harry-potter-5/book-insights.PNG',
                ],
                [
                    'product_id' => $theBook->id,
                    'image_path' => 'images/products/harry-potter-5/full-book.PNG',
                ],
            ]
        );

        // Education
        $theBook = Product::firstWhere('title', 'Myšlením k bohatství');
        $images = array_merge($images,
            [
                [
                    'product_id' => $theBook->id,
                    'image_path' => 'images/products/myslenim-k-bohatstvi/front-cover.PNG',
                ],
                [
                    'product_id' => $theBook->id,
                    'image_path' => 'images/products/myslenim-k-bohatstvi/back-cover.PNG',
                ],
                [
                    'product_id' => $theBook->id,
                    'image_path' => 'images/products/myslenim-k-bohatstvi/book-insights.PNG',
                ],
                [
                    'product_id' => $theBook->id,
                    'image_path' => 'images/products/myslenim-k-bohatstvi/full-book.PNG',
                ],
            ]
        );

        $theBook = Product::firstWhere('title', 'Ako nabrať svaly');
        $images = array_merge($images,
            [
                [
                    'product_id' => $theBook->id,
                    'image_path' => 'images/products/ako-nabrat-svaly/front-cover.PNG',
                ],
                [
                    'product_id' => $theBook->id,
                    'image_path' => 'images/products/ako-nabrat-svaly/back-cover.PNG',
                ],
                [
                    'product_id' => $theBook->id,
                    'image_path' => 'images/products/ako-nabrat-svaly/book-insights.PNG',
                ],
                [
                    'product_id' => $theBook->id,
                    'image_path' => 'images/products/ako-nabrat-svaly/full-book.PNG',
                ],
            ]
        );

        $theBook = Product::firstWhere('title', 'Cashflow kvadrant');
        $images = array_merge($images,
            [
                [
                    'product_id' => $theBook->id,
                    'image_path' => 'images/products/cashflow-kvadrant/front-cover.PNG',
                ],
                [
                    'product_id' => $theBook->id,
                    'image_path' => 'images/products/cashflow-kvadrant/back-cover.PNG',
                ],
                [
                    'product_id' => $theBook->id,
                    'image_path' => 'images/products/cashflow-kvadrant/book-insights.PNG',
                ],
                [
                    'product_id' => $theBook->id,
                    'image_path' => 'images/products/cashflow-kvadrant/full-book.PNG',
                ],
            ]
        );

        $theBook = Product::firstWhere('title', 'Inteligentní investor');
        $images = array_merge($images,
            [
                [
                    'product_id' => $theBook->id,
                    'image_path' => 'images/products/inteligentni-investor/front-cover.PNG',
                ],
                [
                    'product_id' => $theBook->id,
                    'image_path' => 'images/products/inteligentni-investor/back-cover.PNG',
                ],
                [
                    'product_id' => $theBook->id,
                    'image_path' => 'images/products/inteligentni-investor/book-insights.PNG',
                ],
                [
                    'product_id' => $theBook->id,
                    'image_path' => 'images/products/inteligentni-investor/full-book.PNG',
                ],
            ]
        );

        $theBook = Product::firstWhere('title', 'Nejbohatnější muž v Babylóně');
        $images = array_merge($images,
            [
                [
                    'product_id' => $theBook->id,
                    'image_path' => 'images/products/nejbohatsi-muz-v-babylone/front-cover.PNG',
                ],
                [
                    'product_id' => $theBook->id,
                    'image_path' => 'images/products/nejbohatsi-muz-v-babylone/back-cover.PNG',
                ],
                [
                    'product_id' => $theBook->id,
                    'image_path' => 'images/products/nejbohatsi-muz-v-babylone/book-insights.PNG',
                ],
                [
                    'product_id' => $theBook->id,
                    'image_path' => 'images/products/nejbohatsi-muz-v-babylone/full-book.PNG',
                ],
            ]
        );

        // Adults
        $theBook = Product::firstWhere('title', 'Game of Thrones - A Clash of Kings');
        $images = array_merge($images,
            [
                [
                    'product_id' => $theBook->id,
                    'image_path' => 'images/products/game-of-thrones-2/front-cover.PNG',
                ],
                [
                    'product_id' => $theBook->id,
                    'image_path' => 'images/products/game-of-thrones-2/back-cover.PNG',
                ],
                [
                    'product_id' => $theBook->id,
                    'image_path' => 'images/products/game-of-thrones-2/book-insights.PNG',
                ],
                [
                    'product_id' => $theBook->id,
                    'image_path' => 'images/products/game-of-thrones-2/full-book.PNG',
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
