<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::insert([
            ['name' => 'Womens', 'slug' => 'womens', 'category_code' => 'W', 'created_at' => now(), 'updated_at' => now()], //#1
            ['name' => 'Mens', 'slug' => 'mens', 'category_code' => 'M', 'created_at' => now(), 'updated_at' => now()], //#2
            ['name' => 'Kids', 'slug' => 'kids', 'category_code' => 'K', 'created_at' => now(), 'updated_at' => now()], //#3
            ['name' => 'Home Goods', 'slug' => 'homegoods', 'category_code' => 'HG', 'created_at' => now(), 'updated_at' => now()], //#4
        ]);
        // next we need to add it to our db seeder(DatabaseSeeder.php)
    }
}
