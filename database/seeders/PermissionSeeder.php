<?php

namespace Database\Seeders;

USE App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $canCreateActions = new Permission([
            'name' => 'can create actions',
        ]);
        $canCreateRewards = new Permission([
            'name' => 'can create rewards',
        ]);
        $canAssignActions = new Permission([
            'name' => 'can assign actions',
        ]);
        $canAssignRewards = new Permission([
            'name' => 'can assign rewards',
        ]);

        $canCreateActions->save();
        $canAssignActions->save();
        $canCreateRewards->save();
        $canAssignRewards->save();

    }
}
