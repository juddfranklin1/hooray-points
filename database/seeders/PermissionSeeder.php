<?php

namespace Database\Seeders;

use App\Models\{ Permission, Role };
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
            'name'          => 'action_create',
            'description'   => 'can create actions',
        ]);
        $canCreateRewards = new Permission([
            'name'          => 'reward_create',
            'description'   => 'can create rewards',
        ]);
        $canAssignActions = new Permission([
            'name'          => 'action_assign',
            'description'   => 'can assign actions',
        ]);
        $canAssignRewards = new Permission([
            'name'          => 'reward_assign',
            'description'   => 'can assign rewards',
        ]);
        $canViewRewards = new Permission([
            'name'          => 'reward_view',
            'description'   => 'can view rewards',
        ]);

        $canCreateActions->save();
        $canAssignActions->save();
        $canCreateRewards->save();
        $canAssignRewards->save();
        $canViewRewards->save();

        $coach = Role::where('name', 'coach')->first();
        $coach->permissions()->sync([$canCreateActions->id, $canAssignActions->id, $canCreateRewards->id, $canAssignRewards->id]);
        $player = Role::where('name', 'player')->first();
        $player->permissions()->sync([$canViewRewards->id]);
    }
}
