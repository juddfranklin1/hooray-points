<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{ ActionController, AuthenticationController, RewardController, UserController };

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Login
Route::post('/login', [AuthenticationController::class, 'login']);

// Model Paths
Route::get('/actions', [ActionController::class, 'index' ]);
Route::post('/actions', [ActionController::class, 'store' ]);
Route::get('/actions/{id}', [ActionController::class, 'show' ]);
Route::delete('/actions/{id}', [ActionController::class, 'destroy' ]);
Route::post('/actions/{id}', [ActionController::class, 'update' ]);

Route::get('/rewards', [RewardController::class, 'index' ]);
Route::post('/rewards', [RewardController::class, 'store' ]);
Route::get('/rewards/{id}', [RewardController::class, 'show' ]);
Route::delete('/rewards/{id}', [RewardController::class, 'destroy' ]);
Route::post('/rewards/{id}', [RewardController::class, 'update' ]);

Route::get('/users', [UserController::class, 'index' ]);
Route::post('/user', [UserController::class, 'store' ]);
Route::get('/user/{id}', [UserController::class, 'show' ]);

/**
 * Goals
 */

/**
 * Plans - complex actions
 * Post - Initial creation
 * Put - Construction
 * Get
 * Delete
*/

// Relations
Route::put('/user/{user_id}/addAction/{action_id}', [UserController::class, 'addAction' ]);
Route::put('/user/{user_id}/addReward/{reward_id}', [UserController::class, 'addReward' ]);
