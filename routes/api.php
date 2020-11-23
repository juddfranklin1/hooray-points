<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{ ActionController, UserController };

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::put('/user/{user_id}/addAction/{action_id}', [UserController::class, 'addAction' ]);
Route::put('/user/{user_id}/addReward/{reward_id}', [UserController::class, 'addReward' ]);
Route::post('/action', [ActionController::class, 'store' ]);
Route::get('/action/{id}', [ActionController::class, 'show' ]);
Route::post('/action/{id}', [ActionController::class, 'update' ]);
Route::get('/user/{id}', [UserController::class, 'show' ]);
