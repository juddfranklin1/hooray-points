<?php

namespace Database\Seeders;

use App\Models\User;
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
        $judd = User::factory()->make([
            'name'  => 'Judd',
            'email' => 'juddfranklin@gmail.com',
        ])->save();
        $tybe = User::factory()->make([
            'name'  => 'Tybe',
            'email' => 'tybefranklin@gmail.com',
        ])->save();
        $adena = User::factory()->make([
            'name'  => 'Adena',
            'email' => 'juddfranklin+adena@gmail.com',
        ])->save();
        $mac = User::factory()->make([
            'name'  => 'Maccabee',
            'email' => 'juddfranklin+mac@gmail.com',
        ])->save();
    }
}
