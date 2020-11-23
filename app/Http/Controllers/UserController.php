<?php

namespace App\Http\Controllers;

use App\Models\{ Action, Reward, User };
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show (Request $request, $id) {
        return User::with('actions')->findOrFail($id);
    }

    public function addAction(Request $request,$userId, $actionId) {
        $multiplier = $request->multiplier;
        $user = User::find($userId);
        $action = Action::find($actionId);
        $user->actions()->attach($action, ['multiplier' => $multiplier]);
        $user->load('actions');
        return $user;
    }

    public function addReward(Request $request,$userId, $rewardId) {
        $multiplier = $request->multiplier;
        $user = User::find($userId);
        $reward = Reward::find($rewardId);
        $user->rewards()->attach($reward, ['multiplier' => $multiplier]);
        $user->load(['actions', 'rewards']);
        return $user;
    }
}
