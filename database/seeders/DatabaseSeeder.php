<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AdminUserSeeder::class,
            BooksSeeder::class,
            ServicesSeeder::class,
            SiteSettingsSeeder::class,
            BlogPostSeeder::class,
        ]);
    }
}
