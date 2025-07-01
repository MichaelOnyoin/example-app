<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product; // Ensure you import the Product model
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'price' => $this->faker->randomFloat(2, 1, 1000),
            'originalPrice' => $this->faker->randomFloat(2, 1, 1000),
            'discount' => $this->faker->randomFloat(2, 0, 100),
            'title' => $this->faker->unique()->word(),
            'description' => $this->faker->sentence(),
            'imageUrl' => $this->faker->imageUrl(),
            'brand' => $this->faker->word(),
            'category'=> $this->faker->word(),
            'type'=> $this->faker->word(),
            'deals'=> $this->faker->word(),

        ];
    }
}
