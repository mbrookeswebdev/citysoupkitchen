<?php

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run ()
    {
        $product = new \App\Product(['imagePath' => 'images/1.jpg',
            'id' => 1,
            'title' => 'Japanese ramen soup',
            'description' => 'Tasty noodle bowl with fresh fish on the side.',
            'price' => 5.99]);
        $product->save();

        $product = new \App\Product(['imagePath' => 'images/2.jpg',
            'id' => 2,
            'title' => 'Orange squash soup',
            'description' => 'Topped with feta cheese, pumpkin seeds and herbs.',
            'price' => 5.99]);
        $product->save();

        $product = new \App\Product(['imagePath' => 'images/3.jpg',
            'id' => 3,
            'title' => 'Green gaspacho',
            'description' => 'Light cold soup with shrimps, cucumber and limes.',
            'price' => 6.99]);
        $product->save();

        $product = new \App\Product(['imagePath' => 'images/4.jpg',
            'id' => 4,
            'title' => 'Green soup',
            'description' => 'With spinach and pea.',
            'price' => 3.99]);
        $product->save();

        $product = new \App\Product(['imagePath' => 'images/5.jpg',
            'id' => 5,
            'title' => 'Vegetable soup',
            'description' => 'With tomatoes, broccolli and celery.',
            'price' => 4.99]);
        $product->save();

        $product = new \App\Product(['imagePath' => 'images/6.jpg',
            'id' => 6,
            'title' => 'Hearty tomato soup',
            'description' => 'Excellent served with warm crusty bread.',
            'price' => 5.99]);
        $product->save();

        $product = new \App\Product(['imagePath' => 'images/7.jpg',
            'id' => 7,
            'title' => 'Bread roll',
            'description' => 'Selection of plain white or brown, cheese or tomato.',
            'price' => 1.99]);
        $product->save();

        $product = new \App\Product(['imagePath' => 'images/8.jpg',
            'id' => 8,
            'title' => 'White crusty bread',
            'description' => 'Freshly made in our artisan bakery.',
            'price' => 2.49]);
        $product->save();

        $product = new \App\Product(['imagePath' => 'images/9.jpg',
            'id' => 9,
            'title' => 'Brown crusty bread',
            'description' => 'Freshly made in our artisan bakery.',
            'price' => 2.49]);
        $product->save();
    }
}
