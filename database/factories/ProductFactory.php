<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;
use App\Models\Category;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $listIdCategory = Category::pluck('id');

        return [
            'name' => $this->faker->name(),
            'thumbnail' => 'customer/img/product/new-product/n2.jpg',
            'content' => $this->faker->sentence(10, true),
            'short_description' => $this->faker->sentence(10, true),
            'quantity' => $this->faker->numberBetween(1, 100),
            'views' => $this->faker->numberBetween(1, 100),
            'price' => $this->faker->numberBetween(100000, 999999),
            'number_of_vote_submissions' => $this->faker->numberBetween(1, 30),
            'total_vote' => $this->faker->numberBetween(1, 50),
            'sold' => $this->faker->numberBetween(1, 20),
            'status' => $this->faker->randomElement([0,1]),
            'category_id' => $this->faker->randomElement($listIdCategory),
        ];
    }
}
