<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        // Predefined categories
        $categories = [
            'Food', 'Electronics', 'Fashion', 'Books', 'Home Appliances', 'Furniture', 'Sports', 'Toys'
        ];

        // Insert predefined categories into the database
        foreach ($categories as $category) {
            Category::create(['name' => $category]);
        }
    }
}

