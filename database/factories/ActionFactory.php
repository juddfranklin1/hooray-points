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
        $value = $this->faker->numberBetween(-10, 100);
        if($value === 0) {// Force all items to have a positive or negative value
            $value = -10;
        } elseif ($value > 0 && $value % 3 === 0) {// move some items into the negative in order to have more penalties
            $value = -($value);
        }
        return [
            'name'          => implode(' ', $this->faker->words()),
            'description'   => $this->faker->text(),
            'value'         => $value,
            'assignee_id'   => $this->faker->numberBetween(1,4)
        ];
    }
}
