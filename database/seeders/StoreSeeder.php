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

        // Predefined stores for each category
        $stores = [
            'Food' => ['Pizza Hut', 'McDonald\'s', 'Starbucks', 'Subway'],
            'Electronics' => ['Best Buy', 'Apple Store', 'Samsung', 'GameStop'],
            'Fashion' => ['Zara', 'H&M', 'Nike', 'Adidas'],
            'Books' => ['Barnes & Noble', 'Books-A-Million', 'Waterstones'],
            'Home Appliances' => ['Home Depot', 'Lowe\'s', 'Target'],
            'Furniture' => ['IKEA', 'Ashley Furniture', 'Wayfair'],
            'Sports' => ['Dick\'s Sporting Goods', 'Sports Authority'],
            'Toys' => ['Toys R Us', 'Target', 'Walmart'],
        ];

        // Create stores for each category
        foreach ($stores as $categoryName => $storeNames) {
            $category = Category::where('name', $categoryName)->first();

            foreach ($storeNames as $storeName) {
                Store::create([
                    'name' => $storeName,
                    'category_id' => $category->id,  // Link to category
                ]);
            }
        }
    }
}
