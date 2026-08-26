<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $cats = ['Electronics', 'Books', 'Clothing'];

        foreach ($cats as $name) {
            Category::updateOrCreate(['name' => $name], ['name' => $name]);
        }
    }
}
