<?php

namespace Database\Factories;

use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class CouponFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Coupon::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $year = rand(2009, 2022);
        $month = rand(1, 12);
        $day = rand(1, 28);

        $date = Carbon::create($year, $month, $day, 0, 0, 0);

        return [
            'name' => $this->faker->name(),
            'start_date' => $date->format('Y-m-d H:i:s'),
            'end_date' => $date->addWeeks(rand(1, 52))->format('Y-m-d H:i:s'),
            'percent_discount' => $this->faker->numberBetween(1, 100),
            'quantity' => $this->faker->numberBetween(1, 100),
            'content' => $this->faker->sentence(10, true)
        ];
    }
}
