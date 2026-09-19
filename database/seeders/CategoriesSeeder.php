<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define the categories to be inserted
        $categories = [
            'Technology', 'Artificial Intelligence', 'Web Development', 'Programming',
            'Psychology', 'Culture', 'DIY & Crafts', 'Environment', 'Food',
            'Education', 'Arts', 'Sports', 'Fashion', 'Business', 'Entertainment',
            'Finance', 'Health', 'Science', 'Travel', 'Lifestyle',
        ];

        // Insert categories into the database (skip any that already exist)
        foreach ($categories as $category) {
            Category::firstOrCreate(['category_name' => $category]);
        }
    }
}