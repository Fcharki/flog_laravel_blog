<?php

namespace Database\Seeders;

use App\Support\AccountCleanupWindow;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        AccountCleanupWindow::start();

        $this->call([
            CategoriesSeeder::class,
            UsersSeeder::class,
            PostsSeeder::class,
        ]);
    }
}
