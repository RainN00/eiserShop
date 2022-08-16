<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Nation;

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
        $listIdBrand = Brand::pluck('id');
        $listIdNation = Nation::pluck('id');

        return [
            'name' => $this->faker->name(),
            'thumbnail' => $this->faker->randomElement(['customer/img/product/new-product/n1.jpg','customer/img/product/new-product/n2.jpg','customer/img/product/new-product/n3.jpg','customer/img/product/new-product/n4.jpg','customer/img/product/new-product/n5.png']),
            'content' => $this->faker->sentence(10, true),
            'short_description' => $this->faker->sentence(10, true),
            'quantity' => $this->faker->numberBetween(1, 100),
            'price' => $this->faker->numberBetween(100000, 999999),
            'status' => $this->faker->randomElement([0,1]),
            'category_id' => $this->faker->randomElement($listIdCategory),
            'brand_id' => $this->faker->randomElement($listIdBrand),
            'nation_id' => $this->faker->randomElement($listIdNation),
        ];
    }
}
