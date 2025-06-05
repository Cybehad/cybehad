<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use App\PostStatusEnum;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->unique()->words(
            $this->faker->numberBetween(3, 8),
            true
        );
        $status = fake()->randomElement(array_column(PostStatusEnum::cases(), 'value'));
        return [
            'user_id' => User::inRandomOrder()->first()->id
                ?? User::factory()->create()->id,
            'category_id' => Category::inRandomOrder()->first()->id
                ?? Category::factory()->create()->id,
            'title' => $title,
            'slug' => Str::slug($title),
            'excerpt' => $this->faker->boolean(80)
                ? $this->faker->paragraph($this->faker->numberBetween(1, 3))
                : null,
            'content' => fake()->paragraph(),
            'image' => 'https://picsum.photos/seed/picsum/200/300',
            'status' => $status,
            'published_at' => $status === PostStatusEnum::Published->value ? fake()->dateTimeBetween(startDate: '-2 years', endDate: now()) : null,
        ];
    }
}
