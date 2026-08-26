<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $electronics = Category::where('name', 'Electronics')->first();
        $books = Category::where('name', 'Books')->first();
        $clothing = Category::where('name', 'Clothing')->first();

        $items = [
            ['name' => 'Smartphone', 'description' => 'A modern smartphone', 'price' => 399.99, 'category_id' => $electronics?->id],
            ['name' => 'Laptop', 'description' => 'Lightweight laptop', 'price' => 899.00, 'category_id' => $electronics?->id],
            ['name' => 'Novel', 'description' => 'Fiction book', 'price' => 14.99, 'category_id' => $books?->id],
            ['name' => 'T-Shirt', 'description' => 'Cotton t-shirt', 'price' => 9.99, 'category_id' => $clothing?->id],
        ];

        foreach ($items as $p) {
            Product::updateOrCreate(['name' => $p['name']], $p);
        }
    }
}
