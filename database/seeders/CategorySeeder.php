<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        
        $categories = [
            'Food', 'Electronics', 'Fashion', 'Books', 'Home Appliances', 'Furniture', 'Sports', 'Toys'
        ];


        foreach ($categories as $category) {
            Category::create(['name' => $category]);
        }
    }
}

