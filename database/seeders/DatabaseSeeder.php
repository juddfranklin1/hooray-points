<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\{ UserSeeder, ActionSeeder, RewardSeeder, TeamSeeder, PermissionSeeder, RoleSeeder };

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
            RoleSeeder::class,
            PermissionSeeder::class,
            UserSeeder::class,
            ActionSeeder::class,
            RewardSeeder::class,
            TeamSeeder::class,
        ]);
    }
}
