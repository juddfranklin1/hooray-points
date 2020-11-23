<?php

namespace Database\Factories;

use App\Models\Reward;
use Illuminate\Database\Eloquent\Factories\Factory;

class RewardFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Reward::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'         => implode(' ', $this->faker->words()),
            'description'   => $this->faker->text(),
            'cost'          => $this->faker->numberBetween(2, 300),
        ];
    }
}
