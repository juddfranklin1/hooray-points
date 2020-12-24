<?php

namespace Database\Seeders;

use App\Models\{ Goal, Role, User };
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $coachRole = Role::firstWhere('name', 'coach');
        $playerRole = Role::firstWhere('name', 'player');
        $judd = User::factory()->has(Goal::factory()->count(2))->create([
            'name'  => 'Judd',
            'email' => 'juddfranklin@gmail.com',
        ]);
        $tybe = User::factory()->has(Goal::factory()->count(2))->create([
            'name'  => 'Tybe',
            'email' => 'tybefranklin@gmail.com',
        ]);
        $judd->roles()->sync([$coachRole->id]);
        $tybe->roles()->sync([$coachRole->id]);

        $adena = User::factory()->has(Goal::factory()->count(2))->create([
            'name'  => 'Adena',
            'email' => 'juddfranklin+adena@gmail.com',
        ]);
        $mac = User::factory()->has(Goal::factory()->count(2))->create([
            'name'  => 'Maccabee',
            'email' => 'juddfranklin+mac@gmail.com',
        ]);
        $adena->roles()->sync([$playerRole->id]);
        $mac->roles()->sync([$playerRole->id]);
    }
}
