<?php

namespace App\Http\Controllers;

use App\Models\{ Action, Goal, Reward, User };
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index (Request $request) {
        return User::with(['rewards','actions','goals'])->get();
    }

    public function store (Request $request) {
        //
    }

    public function show (Request $request, $id) {
        return User::with(['rewards','actions','goals'])->findOrFail($id);
    }

    public function addGoal(Request $request,$userId, $goalId) {
        $multiplier = $request->multiplier;
        $user = User::find($userId);
        $goal = Goal::find($goalId);
        $user->actions()->attach($goal, ['multiplier' => $multiplier]);
        $user->load('goals');
        return $user;
    }

    public function attachAction(Request $request,$userId, $actionId) {
        $multiplier = $request->multiplier;
        $user = User::find($userId);
        $action = Action::find($actionId);
        $user->actions()->attach($action, ['multiplier' => $multiplier]);
        $user->load('actions');
        return $user;
    }

    public function attachReward(Request $request,$userId, $rewardId) {
        $multiplier = $request->multiplier;
        $user = User::find($userId);
        $reward = Reward::find($rewardId);
        $user->rewards()->attach($reward, ['multiplier' => $multiplier]);
        $user->load(['actions', 'rewards']);
        return $user;
    }

    public function attachGoal(Request $request,$userId, $goalId) {
        $user = User::find($userId);
        $goal = Goal::find($goalId);
        $user->goals()->attach($goal);
        $user->load(['actions', 'goals']);
        return $user;
    }
}
