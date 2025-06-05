<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->unique()->words(
            $this->faker->numberBetween(1, 3),
            true
        );

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => $this->faker->boolean(70) ? $this->faker->paragraph() : null,
            'parent_id' => null
        ];
    }
    public function withoutParent()
    {
        return $this->state(
            function (array $attributes) {
                return [
                    'parent_id' => Category::inRandomOrder()->first()->id ?? Category::factory()->create()->id,
                ];
            }
        );
    }

    public function withSpecificParent($parent_id)
    {
        return $this->state([
            'parent_id' => $parent_id,
        ]);
    }
}
