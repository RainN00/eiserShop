<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $listIdUser = User::pluck('id');
        $listIdProduct = Product::pluck('id');

        return [
            'user_id' => $this->faker->randomElement($listIdUser),
            'product_id' => $this->faker->randomElement($listIdProduct),
            'content' => $this->faker->sentence(10, true),
            'status' => $this->faker->randomElement([0,1])
        ];
    }
}
