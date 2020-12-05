<?php

namespace Database\Seeders;

use App\Models\{ Team, User };
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // We will start with just my family as an example
        $franklins = Team::factory()->make([
            'name'          => 'Franklin Family',
            'type'          => 'family',
            'description'   => 'My family!'
        ]);
        $franklins->save();
        // I will just pull in the users I seeded before.
        $franklins->users()->sync(User::all());
    }
}
