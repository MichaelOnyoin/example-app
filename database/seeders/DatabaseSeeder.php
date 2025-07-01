<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product; // Ensure you import the Product model
use Database\Seeders\ProductSeeder; // Ensure you import the ProductSeeder

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Mickey Mouse',
        //     'email' => 'mickey@disney.com',
        //     'password' => bcrypt('password'), // Ensure the password is hashed
        // ]);
        // You can call other seeders here
        Product::factory()->create([
            'price' => 19.99,
            'originalPrice' => 29.99,
            'discount' => 10.00,
            'title' => 'Sample Product',
            'description' => 'This is a sample product description.',
            'imageUrl' => 'https://example.com/sample-product.jpg',
            'brand' => 'Sample Brand',
            'category' => 'Sample Category',
            'type' => 'Sample Type',
            'deals' => 'Sample Deals',
        ]);
    }
}
