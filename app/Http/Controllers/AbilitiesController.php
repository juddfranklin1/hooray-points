<?php

use App\Http\Resources\AbilitiesResource;

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;

class AbilitiesController extends Controller
{
    public function index()
    {
        $permissions = auth()->user()->roles()->with('permissions')->get();
        dd($permissions);
    }
}
