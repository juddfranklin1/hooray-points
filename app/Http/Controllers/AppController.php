<?php

namespace App\Http\Controllers;

use App\Models\{ Action, Reward, User, ActionUser, GoalUser, RewardUser };
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function index (Request $request) {
        $users = User::with('actions')->get()->toJson();
        $actions = Action::with('assignee')->orderBy('id')->get()->toJson();
        $rewards = Reward::with('assignee')->get()->toJson();
        $userActions = ActionUser::with(['user', 'action'])->get()->toJson();
        $userGoals = GoalUser::with(['user', 'goal'])->get()->toJson();
        $userRewards = RewardUser::with(['user', 'reward'])->get()->toJson();
        return view('index',compact('users', 'actions', 'rewards', 'userActions', 'userGoals', 'userRewards'));
    }
}
