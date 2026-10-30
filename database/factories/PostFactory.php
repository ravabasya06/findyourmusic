<?php

namespace Database\Factories;

use App\Models\Genre;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'genre_id' => Genre::factory(),
            'title' => Str::title(fake()->words(fake()->numberBetween(1, 4), true)),
            'artist' => fake()->boolean(60)
                ? Str::title(fake()->words(2, true))
                : fake()->name(),
            'link' => 'https://www.youtube.com/watch?v=' . Str::random(11),
            'description' => fake()->boolean(80) ? fake()->paragraph(3) : null,
            'cover_image' => null,
        ];
    }
}
