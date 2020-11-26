<?php

namespace App\Http\Controllers;

use App\Models\{ Action, Reward, User };
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function index (Request $request) {
        $users = User::with('actions')->get()->toJson();
        $actions = Action::with('assignee')->get()->toJson();
        $rewards = Reward::with('assignee')->get()->toJson();
        return view('index',compact('users', 'actions', 'rewards'));
    }
}
