<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductTag;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductTagFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductTag::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $listIdTag = Tag::pluck('id');
        $listIdProduct = Product::pluck('id');

        return [
            'tag_id' => $this->faker->randomElement($listIdTag),
            'product_id' => $this->faker->randomElement($listIdProduct),
        ];
    }
}
