<?php

namespace App\Http\Controllers;

use App\Models\{ Action, Reward, User };
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function index (Request $request) {
        $users = User::with('actions')->get()->toJson();
        $actions = Action::all()->toJson();
        $rewards = Reward::all()->toJson();
        return view('welcome',compact('users', 'actions', 'rewards'));
    }
}
