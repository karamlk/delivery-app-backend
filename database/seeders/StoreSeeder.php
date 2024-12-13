<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Store;
use App\Models\Category;

class StoreSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $stores = [
            'Food' => ['Pizza Hut', 'McDonald\'s', 'Starbucks', 'Subway'],
            'Electronics' => ['Best Buy', 'Apple Store', 'Samsung', 'GameStop'],
            'Fashion' => ['Zara', 'H&M', 'Nike', 'Adidas'],
            'Books' => ['Barnes & Noble', 'Books-A-Million', 'Waterstones'],
            'Home Appliances' => ['Home Depot', 'Lowe\'s', 'Target'],
            'Furniture' => ['IKEA', 'Ashley Furniture', 'Wayfair'],
            'Sports' => ['Sports Authority'],
            'Toys' => ['Toys R Us', 'Target', 'Walmart'],
        ];

        foreach ($stores as $categoryName => $storeNames) {
            $category = Category::where('name', $categoryName)->first();

            foreach ($storeNames as $storeName) {
                Store::create([
                    'name' => $storeName,
                    'category_id' => $category->id, 
                ]);
            }
        }
    }
}
