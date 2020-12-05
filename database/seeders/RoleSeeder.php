<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $player = new Role([
            'name' => 'player'
        ]);
        $player->save();

        $coach = new Role([
            'name' => 'coach'
        ]);
        $coach->save();
    }
}
