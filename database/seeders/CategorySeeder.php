<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mainCategory = Category::factory()->count(5)->create();

        $mainCategory->each(function ($category) {
            Category::factory()
                ->count(fake()->numberBetween(3, 5))
                ->withSpecificParent($category->id)->create();
        });
    }
}
