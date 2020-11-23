<?php

namespace Database\Seeders;

use App\Models\Action;
use Illuminate\Database\Seeder;

class ActionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cleaning = Action::factory()->make([
            'name'          => 'Cleaning',
            'description'   => 'Making a surface clear without clutterinfg a different surface.',
            'value'         => 4
        ])->save();
        $cello = Action::factory()->make([
            'name'          => 'Cello',
            'description'   => 'Cello completed before 4PM.',
            'value'         => 6
        ])->save();
        Action::factory()
            ->times(20)
            ->create();
    }
}
