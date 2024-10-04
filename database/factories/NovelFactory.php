<?php

namespace Database\Factories;

use App\Models\Novel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class NovelFactory extends Factory
{
    // Define the corresponding model
    protected $model = Novel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(3),
            'author' => $this->faker->name,
            'synopsis' => $this->faker->paragraph,
            'published_at' => $this->faker->dateTimeBetween('-5 years', 'now'),
        ];
    }
}
