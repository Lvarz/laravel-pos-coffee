<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            // Coffee
            ['name' => 'Espresso', 'category' => 'Coffee', 'price' => 60, 'description' => 'Strong black coffee'],
            ['name' => 'Americano', 'category' => 'Coffee', 'price' => 70, 'description' => 'Espresso with hot water'],
            ['name' => 'Cappuccino', 'category' => 'Coffee', 'price' => 90, 'description' => 'Espresso with steamed milk foam'],
            ['name' => 'Latte', 'category' => 'Coffee', 'price' => 90, 'description' => 'Espresso with steamed milk'],
            ['name' => 'Flat White', 'category' => 'Coffee', 'price' => 95, 'description' => 'Espresso with velvety milk'],
            ['name' => 'Mocha', 'category' => 'Coffee', 'price' => 100, 'description' => 'Espresso with chocolate and milk'],

            // Tea
            ['name' => 'Green Tea', 'category' => 'Tea', 'price' => 50, 'description' => 'Fresh green tea'],
            ['name' => 'Black Tea', 'category' => 'Tea', 'price' => 50, 'description' => 'Premium black tea'],
            ['name' => 'Oolong Tea', 'category' => 'Tea', 'price' => 60, 'description' => 'Traditional oolong tea'],

            // Cold Drinks
            ['name' => 'Iced Coffee', 'category' => 'Cold', 'price' => 75, 'description' => 'Cold brewed coffee'],
            ['name' => 'Iced Latte', 'category' => 'Cold', 'price' => 85, 'description' => 'Cold espresso with milk'],
            ['name' => 'Iced Cappuccino', 'category' => 'Cold', 'price' => 85, 'description' => 'Cold espresso with foam'],

            // Pastries & Food
            ['name' => 'Croissant', 'category' => 'Pastry', 'price' => 40, 'description' => 'Buttery croissant'],
            ['name' => 'Chocolate Cake', 'category' => 'Pastry', 'price' => 60, 'description' => 'Rich chocolate cake'],
            ['name' => 'Muffin', 'category' => 'Pastry', 'price' => 45, 'description' => 'Chocolate muffin'],
            ['name' => 'Sandwich', 'category' => 'Food', 'price' => 80, 'description' => 'Delicious sandwich'],
        ];

        foreach ($products as $product) {
            Product::create(array_merge($product, ['image_url' => null, 'is_available' => true]));
        }
    }
}
