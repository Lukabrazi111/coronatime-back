<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CountryStatisticsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'code' => $this->faker->realTextBetween(1, 10),
            'confirmed' => $this->faker->numberBetween(1, 5000),
            'recovered' => $this->faker->numberBetween(1, 3000),
            'critical' => $this->faker->numberBetween(1, 2000),
            'deaths' => $this->faker->numberBetween(1, 4000),
        ];
    }
}
