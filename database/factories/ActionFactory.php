<?php

namespace Database\Factories;

use App\Models\Action;
use Illuminate\Database\Eloquent\Factories\Factory;

class ActionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Action::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'          => implode(' ', $this->faker->words()),
            'description'   => $this->faker->text(),
            'value'         => $this->faker->numberBetween(-10, 100),
            'assignee_id'   => $this->faker->numberBetween(1,4)
        ];
    }
}
