<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\{ UserSeeder, ActionSeeder, RewardSeeder };

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            ActionSeeder::class,
            RewardSeeder::class
        ]);
        // \App\Models\User::factory(10)->create();
    }
}
