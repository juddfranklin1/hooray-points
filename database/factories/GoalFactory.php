<?php

namespace Database\Factories;

use App\Models\Goal;
use Illuminate\Database\Eloquent\Factories\Factory;

class GoalFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Goal::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $types = [
            [
                'type'          => 'point total',
                'point_total'   => $this->faker->randomElement([40, 60,100,150, 200,300]),
            ],
            [
                'type'        => 'reward',
            ],
            [
                'type'                      => 'point total by date',
                'point_total'               => $this->faker->randomElement([40, 60,100,150, 200,300]),
                'expected_completion_at'    => $this->faker->dateTimeBetween('now', '+2 months')
            ],
        ];

        $data = [
            'name'          => implode(' ', $this->faker->words()),
            'description'   => $this->faker->text(),
        ];

        array_merge($data, $this->faker->randomElement($types));
        return $data;
    }
}
