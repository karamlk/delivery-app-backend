<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Product;
use App\Models\Store;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

       
        $products = [
            'Pizza Hut' => [
                ['name' => 'Neapolitan Pizza', 'price' => 10.99],
                ['name' => 'Cheese Pizza', 'price' => 8.99],
                ['name' => 'Garlic Bread', 'price' => 4.99]
            ],
            'Best Buy' => [
                ['name' => 'Samsung Galaxy S21', 'price' => 799.99],
                ['name' => 'Sony TV 55 inch', 'price' => 499.99],
                ['name' => 'Apple MacBook Pro', 'price' => 1299.99]
            ],
            'Nike' => [
                ['name' => 'Air Max Sneakers', 'price' => 129.99],
                ['name' => 'Nike Hoodie', 'price' => 49.99],
                ['name' => 'Nike Running Shorts', 'price' => 29.99]
            ],
           
        ];

      
        foreach ($products as $storeName => $productList) {
            $store = Store::where('name', $storeName)->first();

            foreach ($productList as $product) {
                Product::create([
                    'name' => $product['name'],
                    'price' => $product['price'],
                    'description' => $faker->sentence,  
                    'store_id' => $store->id, 
                ]);
            }
        }
    }
}
