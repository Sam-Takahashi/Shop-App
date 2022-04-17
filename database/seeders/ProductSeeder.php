<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Womens
        for ($i = 1; $i <= 12; $i++) {
            $category = Category::find(1); // CategorySeeder.php
            Product::create([
                'name' => 'Womens ' . $i,
                'slug' => 'women-' . $i,
                'details' => 'women\'s hoodie',
                'description' => 'Lorem ' . $i . ' ipsum dolor sit amet, consectetur adipisicing elit. Ipsum temporibus iusto ipsa, asperiores voluptas unde aspernatur praesentium in? Aliquam, dolore!',
                'product_code' => $category->category_code . '-00' . $i,
                'image' => 'products/womens-' . $i . '.png',
                'price' => rand(999, 9999),
                'quantity' => rand(1, 10),
            ])->categories()->attach($category);
            // attach(): Insert related models when working with many-to-many relations

            $product = Product::find(1);
            $product->categories()->attach(4); // attaching categories: womens+homegoods
        }
        // Mens
        for ($i = 1; $i <= 12; $i++) {
            $category = Category::find(2);
            Product::create([
                'name' => 'Mens ' . $i,
                'slug' => 'men-' . $i,
                'details' => 'men\'s hoodie',
                'description' => 'Lorem ' . $i . ' ipsum dolor sit amet, consectetur adipisicing elit. Ipsum temporibus iusto ipsa, asperiores voluptas unde aspernatur praesentium in? Aliquam, dolore!',
                'product_code' => $category->category_code . '-00' . $i,
                'image' => 'products/mens-' . $i . '.png',
                'price' => rand(999, 9999),
                'quantity' => rand(1, 10),
            ])->categories()->attach($category);
        }
        // Kids
        for ($i = 1; $i <= 12; $i++) {
            $category = Category::find(3);
            Product::create([
                'name' => 'Kids ' . $i,
                'slug' => 'kid-' . $i,
                'details' => 'kid\'s hoodie',
                'description' => 'Lorem ' . $i . ' ipsum dolor sit amet, consectetur adipisicing elit. Ipsum temporibus iusto ipsa, asperiores voluptas unde aspernatur praesentium in? Aliquam, dolore!',
                'product_code' => $category->category_code . '-00' . $i,
                'image' => 'products/kids-' . $i . '.png',
                'price' => rand(999, 9999),
                'quantity' => rand(1, 10),
            ])->categories()->attach($category);
        }
        // Home Goods
        for ($i = 1; $i <= 12; $i++) {
            $category = Category::find(4);
            Product::create([
                'name' => 'Home Goods ' . $i,
                'slug' => 'homegoods-' . $i,
                'details' => 'homegoods',
                'description' => 'Lorem ' . $i . ' ipsum dolor sit amet, consectetur adipisicing elit. Ipsum temporibus iusto ipsa, asperiores voluptas unde aspernatur praesentium in? Aliquam, dolore!',
                'product_code' => $category->category_code . '-00' . $i,
                'image' => 'products/homegoods-' . $i . '.png',
                'price' => rand(999, 9999),
                'quantity' => rand(1, 10),
            ])->categories()->attach($category);
        }
    }
}
