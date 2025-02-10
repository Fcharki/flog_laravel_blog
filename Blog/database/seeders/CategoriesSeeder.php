<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
// use App\Models\Category; 
use Illuminate\Support\Facades\DB;

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
            'Finance', 'Health', 'Science', 'Travel', 'Lifestyle'
        ];

        // Insert categories into the database
        foreach ($categories as $category) {
            DB::table('categories')->insert([
                'category_name' => $category,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
