<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CouponSeeder::class, // comment out already run seeders before re-seeding db with new seed
            CategorySeeder::class, // CategorySeeder must be called FIRST: products are children of categories(category->products).
            ProductSeeder::class,
        ]);
    }
}
